<script>
    $(document).ready(function() {

        //check the current page is employee creat page or not if true then yes else no


        //This function for menu home button
        $('#home_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('home')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('home')}}';
            }
        });

        //This function for menu dashboard button
        $('#dashboard_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('dashboard')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('dashboard')}}';
            }
        });

         //This function for menu department button
         $('#departments_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('departments')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('departments')}}';
            }
        });

        //This function for menu Shift button
        $('#shifts_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('shifts')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('shifts')}}';
            }
        });

        //This function for menu Employee button
        $('#employees_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('employees')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('employees')}}';
            }
        });

        //This function for menu attendances button
        $('#attendances_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('attendances')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('attendances')}}';
            }
        });

        //This function for menu leave_requests button
        $('#leave_requests_menu_link').click(function(e) {
                    e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('leave_requests')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('leave_requests')}}';
            }
        });


        //This function for menu payslip_request button
        $('#payslip_request_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('payrolls')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('payrolls')}}';
            }
        });




         //This function for menu resignations button
        $('#resignations_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('resignations')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('resignations')}}';
            }
        });


         //This function for menu settings button
        $('#settings_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('settings')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('settings')}}';
            }
        });


         //This function for menu designations button
         $('#designations_menu_link').click(function(e) {
            e.preventDefault();

            if (_main_employee_create == true) {
                $.confirm({
                    theme: 'modern',
                    columnClass: 'col-md-6 col-md-offset-4',
                    icon: 'fa fa-info-circle text-danger',
                    title: 'Alert!',
                    content: 'The data you have entered may not be saved',
                    type: 'green',
                    autoClose: 'cancel|10000',
                    buttons: {
                        confirm: {
                            text: 'LEAVE PAGE',
                            btnClass: 'btn-150',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "{{url('employees/forgot_emp_session')}}",
                                    dataType: "JSON",
                                    success: function (response) {
                                        window.location.href = '{{url('designations')}}';
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'STAY ON PAGE',
                            btnClass: 'btn-150-danger',
                            action: function() {

                            }
                        },
                    }
                });
            } else {
                window.location.href = '{{url('designations')}}';
            }
        });
    });
</script>
