<!DOCTYPE html>
<html>
<head>
    <title>Business Table</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Business Table</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewBusiness"> Create New Business</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Business Email</th>
                <th>Street No</th>
                <th>Address</th>
                <th>City</th>
                <th>Status</th>
                <th width="280px">Action</th>
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
                <form id="businessForm" name="businessForm" class="form-horizontal">
                   <input type="hidden" name="business_id" id="business_id">
                    <div class="form-group">
                        <label for="name" class="col control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_email" class="col control-label">Business Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="business_email" name="business_email" placeholder="Enter Email" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="street_no" class="col control-label">Street No</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="street_no" name="street_no" placeholder="Enter Street No" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col control-label">City</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="" maxlength="50" required="">
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

</body>

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
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('business.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'business_email', name: 'business_email'},
            {data: 'street_no', name: 'street_no'},
            {data: 'address', name: 'address'},
            {data: 'city', name: 'city'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewBusiness').click(function () {
        $('#saveBtn').val("create-business");
        $('#business_id').val('');
        $('#businessForm').trigger("reset");
        $('#modelHeading').html("Create New Business");
        $('#ajaxModel').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editBusiness', function () {
      var business_id = $(this).data('id');
      $.get("{{ route('business.index') }}" +'/' + business_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Business");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#business_id').val(data.id);
          $('#name').val(data.name);
          $('#business_email').val(data.business_email);
          $('#street_no').val(data.street_no);
          $('#address').val(data.address);
          $('#city').val(data.city);
          $('#status').val(data.status);
      })
    });

    /*------------------------------------------
    --------------------------------------------
    Create Business Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#businessForm').serialize(),
          url: "{{ route('business.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#businessForm').trigger("reset");
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
    Delete Business Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteBusiness', function () {

        var business_id = $(this).data("id");
        var confirmDelete = confirm("Are You sure want to delete !");

        if(confirmDelete){
            $.ajax({
                type: "DELETE",
                url: "{{ route('business.store') }}"+'/'+business_id,
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
</html>
