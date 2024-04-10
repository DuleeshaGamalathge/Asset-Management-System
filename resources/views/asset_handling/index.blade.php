@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-between">
        <div class="col-6">
            <h1 class="g-col-6">Asset Handling Table</h1>
        </div>
        <div class="col-4">
            <a class="btn btn-success" href="javascript:void(0)" id="createNewAssetHandling"> Create New Asset Handling</a>
        </div>
    </div>
    <table class="table table-bordered data-table mt-5 col-12" id="asset_handling_table">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Created By</th>
                <th>Given Date</th>
                <th>Given By</th>
                <th>Handover Date</th>
                <th>Handover To</th>
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
                <form id="asset_handlingForm" name="asset_handlingForm" class="form-horizontal">
                   <input type="hidden" name="asset_handling_id" id="asset_handling_id">
                   {{-- <div class="form-group">
                        <label for="business_user" class="col control-label">Business User</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="business_user" name="business_user" placeholder="Enter Business User" value="" maxlength="50" required="">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col control-label" for="business_user">User</label>
                        <select name="business_user" class="form-control">
                            <option value="">Select User</option>
                            @foreach ($business_users as $business_user)
                                <option value="{{ $business_user->id }}">{{ $business_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col control-label" for="created_by">Created By</label>
                        <select name="created_by" class="form-control">
                            <option value="">Created By</option>
                            @foreach ($business_users as $business_user)
                                <option value="{{ $business_user->id }}">{{ $business_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="created_by" class="col control-label">Created By</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="created_by" name="created_by" placeholder="Enter Created By" value="" maxlength="50" required="">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="given_date" class="col control-label">Given Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="given_date" name="given_date" placeholder="Enter given_date" value="" maxlength="50" required="">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="given_by" class="col control-label">Given By</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="given_by" name="given_by" placeholder="Given By" value="" maxlength="50" required="">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="col control-label" for="given_by">Given By</label>
                        <select name="given_by" class="form-control">
                            <option value="">Given By</option>
                            @foreach ($business_users as $business_user)
                                <option value="{{ $business_user->id }}">{{ $business_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="handover_date" class="col control-label">Handover Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="handover_date" name="handover_date" placeholder="Enter Handover Date" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="handover_to" class="col control-label">Handover To</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="handover_to" name="handover_to" placeholder="Handover To" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label" for="status">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input ms-1" type="checkbox" name="status" checked role="switch" id="status">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label" for="business_id">Business</label>
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
    var table = $('#asset_handling_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('asset_handling.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'business_user', name: 'business_user'},
            {data: 'created_by', name: 'created_by'},
            {data: 'given_date', name: 'given_date'},
            {data: 'given_by', name: 'given_by'},
            {data: 'handover_date', name: 'handover_date'},
            {data: 'handover_to', name: 'handover_to'},
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
    $('#createNewAssetHandling').click(function () {
        $('#saveBtn').val("create-asset_handling");
        $('#asset_handling_id').val('');
        $('#asset_handlingForm').trigger("reset");
        $('#modelHeading').html("Create New AssetHandling");
        $('#ajaxModel').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editAssetHandling', function () {
      var asset_handling_id = $(this).data('id');
      $.get("{{ route('asset_handling.index') }}" +'/' + asset_handling_id +'/edit', function (data) {
          $('#modelHeading').html("Edit AssetHandling");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#asset_handling_id').val(data.id);
          $('#business_user').val(data.business_user);
          $('#created_by').val(data.created_by);
          $('#given_date').val(data.given_date);
          $('#given_by').val(data.given_by);
          $('#handover_date').val(data.handover_date);
          $('#handover_to').val(data.handover_to);
          $('#status').val(data.status);
          $('#business_id').val(data.business_id);
      })
    });

    /*------------------------------------------
    --------------------------------------------
    Create AssetHandling Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#asset_handlingForm').serialize(),
          url: "{{ route('asset_handling.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#asset_handlingForm').trigger("reset");
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
    Delete AssetHandling Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteAssetHandling', function () {

        var asset_handling_id = $(this).data("id");
        var confirmDelete = confirm("Are You sure want to delete !");

        if(confirmDelete){
            $.ajax({
                type: "DELETE",
                url: "{{ route('asset_handling.store') }}"+'/'+asset_handling_id,
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
