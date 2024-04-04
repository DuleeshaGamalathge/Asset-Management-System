@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="row justify-content-between">
        <div class="col-6">
            <h1>Business User Table</h1>
        </div>
        <div class="col-4">
            <a class="btn btn-success my-4" href="javascript:void(0)" id="createNewBusinessUser"> Create New Business User</a>
        </div>
    </div>
    <table class="table table-bordered data-table mt-5" id="employee_table">
        <thead>
            <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Status</th>
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
                <form id="business_userForm" name="business_userForm" class="form-horizontal">
                   <input type="hidden" name="business_user_id" id="business_user_id">
                   <div class="form-group">
                        <label for="first_name" class="col control-label">First Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col control-label">Last Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_user_email" class="col control-label">Business User Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="business_user_email" name="business_user_email" placeholder="Enter Email" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="col control-label">Contact Number</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact Number" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="status">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" checked role="switch" id="status">
                        </div>
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
    var table = $('#employee_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('business_user.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'name', name: 'name'},
            {data: 'business_user_email', name: 'business_user_email'},
            {data: 'contact', name: 'contact'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewBusinessUser').click(function () {
        $('#saveBtn').val("create-business_user");
        $('#business_user_id').val('');
        $('#business_userForm').trigger("reset");
        $('#modelHeading').html("Create New BusinessUser");
        $('#ajaxModel').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editBusinessUser', function () {
      var business_user_id = $(this).data('id');
      $.get("{{ route('business_user.index') }}" +'/' + business_user_id +'/edit', function (data) {
          $('#modelHeading').html("Edit BusinessUser");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#business_user_id').val(data.id);
          $('#first_name').val(data.first_name);
          $('#last_name').val(data.last_name);
          $('#name').val(data.name);
          $('#business_user_email').val(data.business_user_email);
          $('#contact').val(data.contact);
          $('#status').val(data.status);
      })
    });

    /*------------------------------------------
    --------------------------------------------
    Create BusinessUser Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#business_userForm').serialize(),
          url: "{{ route('business_user.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#business_userForm').trigger("reset");
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
    Delete BusinessUser Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteBusinessUser', function () {

        var business_user_id = $(this).data("id");
        var confirmDelete = confirm("Are You sure want to delete !");

        if(confirmDelete){
            $.ajax({
                type: "DELETE",
                url: "{{ route('business_user.store') }}"+'/'+business_user_id,
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
