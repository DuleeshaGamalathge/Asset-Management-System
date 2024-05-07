<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ems_style/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('ems_style/img/favicon.png') }}">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('ems_style/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('ems_style/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('ems_style/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('ems_style/css/argon-dashboard.css?v=2.0.5') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('ems_style/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ems_style/css/my-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ems_style/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ems_style/table/datatable/dt-global_style.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript">
        window.history.forward();

        function noBack() {
            window.history.forward();
            window.menubar.visible = false;
        }
    </script>
</head>

<body class="g-sidenav-show   bg-gray-100" onLoad="noBack();" onpageshow="if (event.persisted) noBack();"
    onUnload="">
    <div class="min-height-100 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" javascript:; ">
                {{-- <img src="ems_style/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
                <span class="ms-1 font-weight-bold">{{ env('APP_NAME') }}</span>
            </a>
        </div>
        @php
            $segment = Request::segment(1);
            $segment2 = Request::segment(2);
        @endphp
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                {{-- @if (Auth::user()->hasRole('SAdmin') || Auth::user()->hasRole('Admin')) --}}
                    <li class="nav-item">
                        <a href="{{url('home')}}" id="home_menu_link" class="nav-link">
                            <div
                                class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fas fa-home text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Home</span>
                        </a>
                    </li>
                {{-- @endif --}}

                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="javascript:;" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-tachometer-alt text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="{{url('business_user')}}" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Business Users</span>
                    </a>
                </li>
                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="{{url('inventory_category')}}" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-warehouse text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inventory Category</span>
                    </a>
                </li>

                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="{{url('inventory')}}" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-laptop-house text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inventory</span>
                    </a>
                </li>
                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="{{url('asset_category')}}" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-object-group text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Asset Category</span>
                    </a>
                </li>
                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="{{url('asset_sub_category')}}" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-object-ungroup text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Asset Sub Category</span>
                    </a>
                </li>
                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="#" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-cubes text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Assets</span>
                    </a>
                </li>
                <li class="nav-item {{ $segment == 'dashboard' ? 'active' : '' }}">
                    <a href="{{url('asset_handling')}}" id="dashboard_menu_link" class="nav-link {{ $segment == 'dashboard' ? 'active' : '' }}">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-tasks text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Asset Handling</span>
                    </a>
                </li>



                {{-- @if (Auth::user()->can('Read_Employees') ||
                        Auth::user()->can('Read_Department') ||
                        Auth::user()->can('Read_Designation') ||
                        Auth::user()->can('Read_Shifts'))
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#staff"
                            class="nav-link {{ ($segment == 'employees' && $segment2 != 'create') || $segment == 'departments' || $segment == 'designations' || $segment == 'shifts' ? 'active' : '' }}"
                            aria-controls="staff" role="button" aria-expanded="false">
                            <div
                                class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Staff</span>
                        </a>
                        <div class="collapse  {{ ($segment == 'employees' && $segment2 != 'create') || $segment == 'departments' || $segment == 'designations' || $segment == 'shifts' ? 'show' : '' }}"
                            id="staff">
                            <ul class="nav ms-4">


                                @if (Auth::user()->can('Read_Department'))
                                    <li class="nav-item {{ $segment == 'departments' ? 'active' : '' }}">
                                        <a class="nav-link {{ $segment == 'departments' ? 'active' : '' }}"
                                        href="javascript:;" id="departments_menu_link">
                                            <span class="sidenav-mini-icon"> D </span>
                                            <span class="sidenav-normal"> Department </span>
                                        </a>
                                    </li>
                                @endif

                                @if (Auth::user()->can('Read_Designation'))
                                    <li class="nav-item {{ $segment == 'designations' ? 'active' : '' }}">
                                        <a class="nav-link {{ $segment == 'designations' ? 'active' : '' }}"
                                             href="javascript:;" id="designations_menu_link">
                                            <span class="sidenav-mini-icon"> D </span>
                                            <span class="sidenav-normal"> Designation </span>
                                        </a>
                                    </li>
                                @endif

                                @if (Auth::user()->can('Read_Shifts'))
                                    <li class="nav-item {{ $segment == 'shifts' ? 'active' : '' }}">
                                        <a class="nav-link {{ $segment == 'shifts' ? 'active' : '' }}"
                                            href="javascript:;" id="shifts_menu_link">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal"> Shifts </span>
                                        </a>
                                    </li>
                                @endif

                                @if (Auth::user()->can('Read_Employees'))
                                    <li class="nav-item {{ $segment == 'employees' && $segment2 != 'create' ? 'active' : '' }}">
                                        <a class="nav-link {{ $segment == 'employees' && $segment2 != 'create' ? 'active' : '' }}"
                                            href="javascript:;" id="employees_menu_link">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal"> Directory</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->can('Read_Attendance'))
                    <li class="nav-item {{ $segment == 'attendances' ? 'active' : '' }}">
                        <a href="{{ url('attendances') }}"
                            class="nav-link {{ $segment == 'attendances' ? 'active' : '' }}" href="javascript:;" id="attendances_menu_link">
                            <div
                                class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fas fa-calendar-alt text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Attendance</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->can('Read_Leave'))
                    <li class="nav-item {{ $segment == 'leave_requests' ? 'active' : '' }}">
                        <a href="{{ url('leave_requests') }}"
                            class="nav-link {{ $segment == 'leave_requests' ? 'active' : '' }}" href="javascript:;" id="leave_requests_menu_link">
                            <div
                                class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fas fa-calendar-times text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Leave</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->can('Read_Payroll'))
                    <li
                        class="nav-item {{ $segment == 'payrolls' || $segment == 'payslip_request' ? 'active' : '' }}">
                        <a
                            class="nav-link {{ $segment == 'payrolls' || $segment == 'payslip_request' ? 'active' : '' }}" href="javascript:;" id="payslip_request_menu_link">
                            <div
                                class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fas fa-file-invoice-dollar text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Payroll</span>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->can('Create_Employees'))
                    <li class="nav-item {{ $segment == 'employees' && $segment2 == 'create' ? 'active' : '' }}">
                        <a href="{{ url('/employees/create') }}"
                            class="nav-link {{ $segment == 'employees' && $segment2 == 'create' ? 'active' : '' }}">
                            <div
                                class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-plus text-success text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Registration</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->can('Read_Resignation'))
                    <li class="nav-item {{ $segment == 'resignations' ? 'active' : '' }}">
                        <a href="{{ url('/resignations') }}"
                            class="nav-link {{ $segment == 'resignations' ? 'active' : '' }}" href="javascript:;" id="resignations_menu_link">
                            <div
                                class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-times text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Resignations</span>
                        </a>
                    </li>
                @endif --}}

                <li class="nav-item {{ $segment == 'settings' ? 'active' : '' }}">
                    <a href="{{ url('/settings') }}" class="nav-link {{ $segment == 'settings' ? 'active' : '' }}" href="javascript:;" id="settings_menu_link">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-cogs text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                </li>

                {{-- <li class="nav-item mt-3">
                    <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">PAGES</h6>
                </li> --}}


            </ul>
        </div>

    </aside>

    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky "
            id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">

                <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                    <a href="javascript:;" class="nav-link p-0">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <ul class="navbar-nav  justify-content-end">

                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="{{ url('/settings') }}" class="nav-link text-white p-0">
                                <i class="fa fa-cog  cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="{{ route('business.index') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link text-white p-0">
                                <i class="fas fa-sign-out-alt cursor-pointer"></i>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('business.index') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid">
            <div class="row">
                <!-- Content-->
                @yield('content')
                <!-- END ----->
            </div>
            <!--
            <footer class="footer pt-3 ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                Powered By <a href="https://www.webappclouds.com/" target="_blank">Webappclouds</a>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>
            -->
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('ems_style/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('ems_style/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ems_style/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('ems_style/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('ems_style/table/datatable/datatables.js') }}"></script>
    {{-- <script src="{{asset('ems_style/js/plugins/multistep-form.js')}}"></script> --}}
    <!-- Kanban scripts -->
    <script src="{{ asset('ems_style/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('ems_style/js/plugins/jkanban/jkanban.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('ems_style/js/argon-dashboard.min.js?v=2.0.5') }}"></script>
    <script src="{{ asset('ems_style/js/validations.js') }}"></script>
    <script src="{{ asset('ems_style/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('ems_style/js/plugins/dropzone.min.js') }}"></script>
    <script>
    </script>
    @include('layouts.adminmenu_script')
    @yield('scripts')
</body>

</html>
