@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-between">
        <div class="col-6">
            <h2 class="g-col-6">Business Table</h2>
        </div>
        {{-- @if (Auth::user()->hasRole('SAdmin') || Auth::user()->hasRole('Admin')) --}}
            <div class="col-4">
                <a class="btn btn-success" href="{{url('business/create')}}" id="createNewBusiness"> Create New Business</a>
            </div>
        {{-- @endif --}}

    </div>
    {{-- @foreach ($data as $item)
    <div class="avatar avatar-xl border-radius-md p-2">
        <a class="btn" style="cursor: pointer"  onclick="goToDashboard({{ $item->id }})" data-id="{{ $item->id }}">
    </div>

    @endforeach --}}
    <table class="table table-bordered data-table col-12">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                {{-- <th>Business Email</th>
                <th>Street No</th>
                <th>Address</th>
                <th>City</th> --}}
                <th>Business Status</th>
                {{-- <th>First Name</th>
                <th>Last Name</th> --}}
                <th>User Name</th>
                {{-- <th>Email</th>
                <th>Contact</th> --}}
                <th>User Status</th>
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
                <form id="businessForm" name="businessForm" class="form-horizontal">
                    <div class="row">
                        <div class="col-6">

                            {{-- business --}}
                            <h6>Business</h6>

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
                        </div>
                        <div class="col-6">

                            {{-- business user --}}
                            <h6>Business User</h6>

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
                                    <label for="email" class="col control-label">Business User Email</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contact" class="col control-label">Contact Number</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact Number" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="user_status">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="user_status" checked role="switch" id="user_status">
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                        </div>
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
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('business.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            // {data: 'business_email', name: 'business_email'},
            // {data: 'street_no', name: 'street_no'},
            // {data: 'address', name: 'address'},
            // {data: 'city', name: 'city'},
            {data: 'status', name: 'status'},
            // {data: 'first_name', name: 'first_name'},
            // {data: 'last_name', name: 'last_name'},
            {data: 'name', name: 'name'},
            // {data: 'business_user_email', name: 'business_user_email'},
            // {data: 'contact', name: 'contact'},
            {data: 'user_status', name: 'user_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        createdRow: function(row, data, dataIndex) {
            // Add click event listener to the 'name' column
            $('td', row).eq(1).on('click', function() {
                // Call the goToDashboard function with the ID as an argument
                goToDashboard(data.id); // Assuming the ID is stored in 'id'
            });
        }
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
          $('#user_id').val(data.id);
          $('#first_name').val(data.first_name);
          $('#last_name').val(data.last_name);
          $('#name').val(data.name);
          $('#email').val(data.email);
          $('#contact').val(data.contact);
          $('#user_status').val(data.user_status);
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
          url: "{{ route('business.update') }}",
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
                url: "{{ route('business.update') }}"+'/'+business_id,
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

   function goToDashboard(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = {
                'id': id
            }

            $.ajax({
                type: "POST",
                url: "{{ url('business/move_to_dashboard') }}",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    location.href = '{{ url('/home') }}';
                },
                statusCode: {
                    401: function() {
                        window.location.href =
                            '{{ route('login') }}'; //or what ever is your login URI
                    },
                    419: function() {
                        window.location.href =
                            '{{ route('login') }}'; //or what ever is your login URI
                    },
                }
            });
    }
</script>
@endsection
