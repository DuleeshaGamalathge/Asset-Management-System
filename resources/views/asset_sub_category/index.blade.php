@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-between">
        <div class="col-6">
            <h1 class="g-col-6">Asset Sub Category Table</h1>
        </div>
        <div class="col-4">
            <a class="btn btn-success" href="javascript:void(0)" id="createNewAssetSubCategory"> Create New Asset Sub Category</a>
        </div>
    </div>
    <table class="table table-bordered data-table mt-5" id="asset_sub_category_table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Asset Category</th>
                <th>Status</th>
                <th>Business</th>
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
                <form id="asset_sub_categoryForm" name="asset_sub_categoryForm" class="form-horizontal">
                   <input type="hidden" name="asset_sub_category_id" id="asset_sub_category_id">

                    <div class="form-group">
                        <label for="name" class="col control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="asset_category_id">Asset Category</label>
                        <select name="asset_category_id" class="form-control">
                            <option value="">Select Asset Category</option>
                            @foreach ($asset_categories as $asset_category)
                                <option value="{{ $asset_category->id }}">{{ $asset_category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="status">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" checked role="switch" id="status">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="business_id">Business</label>
                        <select name="business_id" class="form-control">
                            <option value="">Select Business</option>
                            @foreach ($businesses as $business)
                                <option value="{{ $business->id }}">{{ $business->name }}</option>
                            @endforeach
                        </select>
                    </div>

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
    var table = $('#asset_sub_category_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('asset_sub_category.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'asset_category_id', name: 'asset_category_id'},
            {data: 'status', name: 'status'},
            {data: 'business_id', name: 'business_id'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewAssetSubCategory').click(function () {
        $('#saveBtn').val("create-asset_sub_category");
        $('#asset_sub_category_id').val('');
        $('#asset_sub_categoryForm').trigger("reset");
        $('#modelHeading').html("Create New AssetSubCategory");
        $('#ajaxModel').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editAssetSubCategory', function () {
      var asset_sub_category_id = $(this).data('id');
      $.get("{{ route('asset_sub_category.index') }}" +'/' + asset_sub_category_id +'/edit', function (data) {
          $('#modelHeading').html("Edit AssetSubCategory");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#asset_sub_category_id').val(data.id);
          $('#name').val(data.name);
          $('#asset_category_id').val(data.asset_category_id);
          $('#status').val(data.status);
          $('#business_id').val(data.business_id);
      })
    });

    /*------------------------------------------
    --------------------------------------------
    Create AssetSubCategory Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#asset_sub_categoryForm').serialize(),
          url: "{{ route('asset_sub_category.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#asset_sub_categoryForm').trigger("reset");
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
    Delete AssetSubCategory Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteAssetSubCategory', function () {

        var asset_sub_category_id = $(this).data("id");
        var confirmDelete = confirm("Are You sure want to delete !");

        if(confirmDelete){
            $.ajax({
                type: "DELETE",
                url: "{{ route('asset_sub_category.store') }}"+'/'+asset_sub_category_id,
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
