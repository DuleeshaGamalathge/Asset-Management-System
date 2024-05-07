@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row justify-content-between">
        <div class="col-6">
            <h1 class="g-col-6">Asset Category Table</h1>
        </div>
        <div class="col-4">
            <a class="btn btn-success" href="javascript:void(0)" id="createNewAssetCategory"> Create New Asset Category</a>
        </div>
    </div>
    <table class="table table-bordered data-table mt-5" id="asset_category_table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Status</th>
                {{-- <th>Business</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="asset_categoryForm" name="asset_categoryForm" class="form-horizontal">
                   <input type="hidden" name="asset_category_id" id="asset_category_id">

                    <div class="form-group">
                        <label for="name" class="col control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="status">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" checked role="switch" id="status">
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label class="form-label" for="business_id">Business</label>
                        <select name="business_id" class="form-control">
                            <option value="">Select Business</option>
                            @foreach ($businesses as $business)
                                <option value="{{ $business->id }}">{{ $business->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(function () {

    /*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    /*------------------------------------------
    --------------------------------------------
    Render DataTable
    --------------------------------------------
    --------------------------------------------*/
    var table = $('#asset_category_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('asset_category.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            // {data: 'business_id', name: 'business_id'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewAssetCategory').click(function () {
        $('#saveBtn').val("create-asset_category");
        $('#asset_category_id').val('');
        $('#asset_categoryForm').trigger("reset");
        $('#modelHeading').html("Create New AssetCategory");
        $('#ajaxModel').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editAssetCategory', function () {
      var asset_category_id = $(this).data('id');
      $.get("{{ route('asset_category.index') }}" +'/' + asset_category_id +'/edit', function (data) {
          $('#modelHeading').html("Edit AssetCategory");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#asset_category_id').val(data.id);
          $('#name').val(data.name);
          $('#status').val(data.status);
          $('#business_id').val(data.business_id);
      })
    });

    /*------------------------------------------
    --------------------------------------------
    Create AssetCategory Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#asset_categoryForm').serialize(),
          url: "{{ route('asset_category.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#asset_categoryForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
        });
    });

    /*------------------------------------------
    --------------------------------------------
    Delete AssetCategory Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteAssetCategory', function () {

        var asset_category_id = $(this).data("id");
        var confirmDelete = confirm("Are You sure want to delete !");

        if(confirmDelete){
            $.ajax({
                type: "DELETE",
                url: "{{ route('asset_category.store') }}"+'/'+asset_category_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }else{
            console.log("canceled");
        }

    });

  });
</script>

@endsection
