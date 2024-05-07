@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row justify-content-between">
        <div class="col-6">
            <h2 class="g-col-6">Inventory Table</h2>
        </div>
        <div class="col-4">
            <a class="btn btn-success" href="javascript:void(0)" id="createNewInventory"> Create New Inventory</a>
        </div>
    </div>
    <table class="table table-bordered data-table mt-5 fs-6" id="inventory_table">
        <thead>
            <tr>
                <th>No</th>
                <th>Inventory No.</th>
                <th>Inventory Name</th>
                <th>Inventory Category</th>
                <th>Purchased Date</th>
                <th>Warranty</th>
                <th>Description</th>
                <th>Remarks</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Updated By</th>
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
                <form id="inventoryForm" name="inventoryForm" class="form-horizontal">
                   <input type="hidden" name="inventory_id" id="inventory_id">
                   <div class="form-group">
                        <label for="inventory_no" class="col control-label">Inventory No.</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="inventory_no" name="inventory_no" placeholder="Enter Inventory No." value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col control-label">Inventory Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Inventory Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label" for="inventory_category_id">Inventory Category</label>
                        <select name="inventory_category_id" class="form-control">
                            <option value="">Select inventory Category</option>
                            @foreach ($inventory_categories as $inventory_category)
                                <option value="{{ $inventory_category->id }}">{{ $inventory_category->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="purchased_date" class="col control-label">Purchased Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="purchased_date" name="purchased_date" placeholder="Enter Inventory purchased_date" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="warranty" class="col control-label">Warranty</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="warranty" name="warranty" placeholder="Enter warranty" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remarks" class="col control-label">Remarks</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter remarks" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col control-label" for="status">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input ms-1" type="checkbox" name="status" checked role="switch" id="status">
                        </div>
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
                    <div class="form-group">
                        <label class="col control-label" for="updated_by">Updated By</label>
                        <select name="updated_by" class="form-control">
                            <option value="">Updated By</option>
                            @foreach ($business_users as $business_user)
                                <option value="{{ $business_user->id }}">{{ $business_user->name }}</option>
                            @endforeach
                        </select>
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
    var table = $('#inventory_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('inventory.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'inventory_no', name: 'inventory_no'},
            {data: 'name', name: 'name'},
            {data: 'inventory_category_id', name: 'inventory_category_id'},
            {data: 'purchased_date', name: 'purchased_date'},
            {data: 'warranty', name: 'warranty'},
            {data: 'description', name: 'description'},
            {data: 'remarks', name: 'remarks'},
            {data: 'status', name: 'status'},
            {data: 'created_by', name: 'created_by'},
            {data: 'updated_by', name: 'updated_by'},
            // {data: 'business_id', name: 'business_id'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewInventory').click(function () {
        $('#saveBtn').val("create-inventory");
        $('#inventory_id').val('');
        $('#inventoryForm').trigger("reset");
        $('#modelHeading').html("Create New Inventory");
        $('#ajaxModel').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editInventory', function () {
      var inventory_id = $(this).data('id');
      $.get("{{ route('inventory.index') }}" +'/' + inventory_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Inventory");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#inventory_id').val(data.id);
          $('#inventory_no').val(data.inventory_no);
          $('#name').val(data.name);
          $('#inventory_category_id').val(data.inventory_category_id);
          $('#purchased_date').val(data.purchased_date);
          $('#warranty').val(data.warranty);
          $('#description').val(data.description);
          $('#remarks').val(data.remarks);
          $('#status').val(data.status);
          $('#created_by').val(data.created_by);
          $('#updated_by').val(data.updated_by);
          $('#business_id').val(data.business_id);
      })
    });

    /*------------------------------------------
    --------------------------------------------
    Create Inventory Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#inventoryForm').serialize(),
          url: "{{ route('inventory.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#inventoryForm').trigger("reset");
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
    Delete Inventory Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteInventory', function () {

        var inventory_id = $(this).data("id");
        var confirmDelete = confirm("Are You sure want to delete !");

        if(confirmDelete){
            $.ajax({
                type: "DELETE",
                url: "{{ route('inventory.store') }}"+'/'+inventory_id,
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
