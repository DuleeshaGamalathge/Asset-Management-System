@extends('layouts.app')

@section('content')

<div class="col-12">
    <div class="card" id="ajaxModel">
        <!-- Card header -->
        <div class="card-header pb-0">
            <div class="d-lg-flex">
                <div>
                    <h5 class="mb-0 text-uppercase">Create new Business</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                        <a href="{{ url('business') }}" class="btn bg-gradient-primary btn-sm mb-0">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-0">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-5">
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
                            {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}

                        </div>
                        <div class="col-6">

                            {{-- business user --}}
                            <h6>Business Owner</h6>

                            {{-- <input type="hidden" name="business_user_id" id="business_user_id"> --}}
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
                                    <label for="email" class="col control-label">Business Owner Email</label>
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
<script>
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

$('#createNewBusiness').click(function () {
        window.location.href = '{{ route("business.create") }}';

        $('#saveBtn').val("create-business");
        $('#business_id').val('');
        $('#businessForm').trigger("reset");
        $('#ajaxModel').html(data);
        $('#modelHeading').html("Create New Business");
        $('#ajaxModel').modal('show');
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#businessForm').serialize(),
          url: "{{ route('business.create') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#businessForm').trigger("reset");
              window.location.href = "/business";
              table.draw();
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
        });
    });

});
</script>
@endsection
