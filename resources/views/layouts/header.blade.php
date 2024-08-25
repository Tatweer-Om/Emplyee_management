<!doctype html>
<html lang="en" dir="rtl">


<!-- Mirrored from themesbrand.com/minia/layouts/index-rtl.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:36:16 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Dashboard | Minia - Minimal Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('title')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{  asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

     {{-- calender  --}}

     <link href="{{ asset('libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{  asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.css')}}">

     <link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />

     <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

     <!-- color picker css -->
     <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/classic.min.css')}}"/> <!-- 'classic' theme -->
     <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/monolith.min.css')}}"/> <!-- 'monolith' theme -->
     <link rel="stylesheet" href="{{asset('libs/%40simonwep/pickr/themes/nano.min.css')}}"/> <!-- 'nano' theme -->

 <!-- flatpickr css -->
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- DataTables -->
<link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />


</head>

<body>



    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{  asset('images/logo-sm.svg')}}" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{  asset('images/logo-sm.svg')}}" alt="" height="24"> <span class="logo-txt">Minia</span>
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{  asset('images/logo-sm.svg')}}" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="{{  asset('images/logo-sm.svg')}}" alt="" height="24"> <span class="logo-txt">Minia</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                        </div>
                    </form>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img id="header-lang-img" src="{{  asset('images/flags/us.jpg')}}" alt="Header Language" height="16">
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                <img src="{{  asset('images/flags/us.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                <img src="{{  asset('images/flags/spain.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                <img src="{{  asset('images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                <img src="{{  asset('images/flags/italy.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                <img src="{{  asset('images/flags/russia.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="grid" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="p-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{  asset('images/brands/github.png')}}" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{  asset('images/brands/bitbucket.png')}}" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{  asset('images/brands/dribbble.png')}}" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{  asset('images/brands/dropbox.png')}}" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{  asset('images/brands/mail_chimp.png')}}" alt="mail_chimp">
                                            <span>Mail Chimp</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{  asset('images/brands/slack.png')}}" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        // Get today's date
                        $today = date('Y-m-d');

                        // Get the date 30 days from now
                        $dateIn30Days = date('Y-m-d', strtotime('+30 days'));

                        // Example user ID to filter by
                        $userId = Auth::id(); // Replace with the actual user ID

                        // For employee_docs table
                        $employeeDocs = DB::table('employee_docs')
                            ->whereBetween('expiry_date', [$today, $dateIn30Days])
                            ->where('user_id', $userId);

                        // For company_docs table
                        $companyDocs = DB::table('company_docs')
                            ->whereBetween('expiry_date', [$today, $dateIn30Days])
                            ->where('user_id', $userId);

                        $total_noti = $companyDocs->count() + $employeeDocs->count();

                        $emp_docs = $employeeDocs->get();
                        $comp_docs = $companyDocs->get();
                    ?>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell" class="icon-lg"></i>
                            <span class="badge bg-danger rounded-pill"><?php echo $total_noti;  ?></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <?php foreach ($comp_docs as $key => $cd) {
                                    // Parse the expiry date
                                    $expiryDate = new DateTime($cd->expiry_date);

                                    // Get the current date
                                    $today = new DateTime();

                                    // Calculate the difference as a DateInterval object
                                    $interval = $today->diff($expiryDate);

                                    // Extract the difference in years, months, and days
                                    $diffInYears = (int)$interval->y;
                                    $diffInMonths = (int)$interval->m;
                                    $diffInDays = (int)$interval->d;

                                    // Calculate the total days remaining
                                    $totalDaysRemaining = (int)$today->diff($expiryDate)->days;

                                    // Determine if expired
                                    if ($totalDaysRemaining < 1) {
                                    $renewl_period2 = '<p style="text-align:center; color: red;">منتهي الصلاحية</p>';
                                    } else {
                                    // Format the difference in Arabic
                                    $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                                    $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                                    $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                                    $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                                    // Determine badge color based on total days remaining
                                    $badgeClass = $totalDaysRemaining < 60 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                                    // Output the time left and total days remaining
                                    $renewl_period2 = '<span class="' . $badgeClass . '" >' . $totalDaysRemaining . ' يوم متبقي</span>';
                                    }

                                    ?>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="fas fa-building"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $cd->companydoc_name }} of {{ $cd->company_name }} </h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1"><?php echo $renewl_period2; ?> - {{ $cd->expiry_date }}</p>
                                                    {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>
                                <?php foreach ($emp_docs as $key => $ed) {
                                    // Parse the expiry date
                                    $expiryDate = new DateTime($ed->expiry_date);

                                    // Get the current date
                                    $today = new DateTime();

                                    // Calculate the difference as a DateInterval object
                                    $interval = $today->diff($expiryDate);

                                    // Extract the difference in years, months, and days
                                    $diffInYears = (int)$interval->y;
                                    $diffInMonths = (int)$interval->m;
                                    $diffInDays = (int)$interval->d;

                                    // Calculate the total days remaining
                                    $totalDaysRemaining = (int)$today->diff($expiryDate)->days;

                                    // Determine if expired
                                    if ($totalDaysRemaining < 1) {
                                    $renewl_period = '<p style="text-align:center; color: red;">منتهي الصلاحية</p>';
                                    } else {
                                    // Format the difference in Arabic
                                    $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                                    $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                                    $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                                    $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                                    // Determine badge color based on total days remaining
                                    $badgeClass = $totalDaysRemaining < 60 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                                    // Output the time left and total days remaining
                                    $renewl_period = '<span class="' . $badgeClass . '" >' . $totalDaysRemaining . ' يوم متبقي</span>';
                                    }

                                    ?>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $ed->employeedoc_name }} of {{ $ed->employee_name }} </h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1"><?php echo $renewl_period; ?> - {{ $ed->expiry_date }}</p>
                                                    {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>


                            </div>
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ url('show_expired_docs') }}">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item right-bar-toggle me-2">
                            <i data-feather="settings" class="icon-lg"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{  asset('images/users/avatar-1.jpg')}}" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">Shawn L.</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                            <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="auth-logout.html"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" data-key="t-menu">Menu</li>

                        <li>
                            <a href="{{ url('home') }}">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="grid"></i>
                                <span data-key="t-apps">Office Management</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{url('user')}}">
                                        <span data-key="t-calendar">Office Employees</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('branch') }}">
                                        <span data-key="t-chat">Office Branches</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('about') }}">
                                        <span data-key="t-chat">About Office</span>
                                    </a>
                                </li>

                                {{-- <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <span data-key="t-email">Email</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="apps-email-inbox.html" data-key="t-inbox">Inbox</a></li>
                                        <li><a href="apps-email-read.html" data-key="t-read-email">Read Email</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <span data-key="t-invoices">Invoices</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="apps-invoices-list.html" data-key="t-invoice-list">Invoice List</a></li>
                                        <li><a href="apps-invoices-detail.html" data-key="t-invoice-detail">Invoice Detail</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <span data-key="t-contacts">Contacts</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="apps-contacts-grid.html" data-key="t-user-grid">User Grid</a></li>
                                        <li><a href="apps-contacts-list.html" data-key="t-user-list">User List</a></li>
                                        <li><a href="apps-contacts-profile.html" data-key="t-profile">Profile</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="">
                                        <span data-key="t-blog">Blog</span>
                                        <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="apps-blog-grid.html" data-key="t-blog-grid">Blog Grid</a></li>
                                        <li><a href="apps-blog-list.html" data-key="t-blog-list">Blog List</a></li>
                                        <li><a href="apps-blog-detail.html" data-key="t-blog-details">Blog Details</a></li>
                                    </ul>
                                </li> --}}
                            </ul>
                        </li>

                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-authentication">Authentication</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="auth-login.html" data-key="t-login">Login</a></li>
                                <li><a href="auth-register.html" data-key="t-register">Register</a></li>
                                <li><a href="auth-recoverpw.html" data-key="t-recover-password">Recover Password</a></li>
                                <li><a href="auth-lock-screen.html" data-key="t-lock-screen">Lock Screen</a></li>
                                <li><a href="auth-logout.html" data-key="t-logout">Log Out</a></li>
                                <li><a href="auth-confirm-mail.html" data-key="t-confirm-mail">Confirm Mail</a></li>
                                <li><a href="auth-email-verification.html" data-key="t-email-verification">Email Verification</a></li>
                                <li><a href="auth-two-step-verification.html" data-key="t-two-step-verification">Two Step Verification</a></li>
                            </ul>
                        </li> --}}

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="file-text"></i>
                                <span data-key="t-pages">Companies Management</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('company') }}" data-key="t-starter-page">Companies</a></li>
                                <li><a href="{{ url('employee') }}" data-key="t-maintenance">Employees</a></li>
                                <li><a href="{{ url('document') }}" data-key="t-maintenance">Add Document</a></li>

                            </ul>
                        </li>

                        {{-- <li>
                            <a href="layouts-horizontal.html">
                                <i data-feather="layout"></i>
                                <span data-key="t-horizontal">Horizontal</span>
                            </a>
                        </li>

                        <li class="menu-title mt-2" data-key="t-components">Elements</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="briefcase"></i>
                                <span data-key="t-components">Components</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="ui-alerts.html" data-key="t-alerts">Alerts</a></li>
                                <li><a href="ui-buttons.html" data-key="t-buttons">Buttons</a></li>
                                <li><a href="ui-cards.html" data-key="t-cards">Cards</a></li>
                                <li><a href="ui-carousel.html" data-key="t-carousel">Carousel</a></li>
                                <li><a href="ui-dropdowns.html" data-key="t-dropdowns">Dropdowns</a></li>
                                <li><a href="ui-grid.html" data-key="t-grid">Grid</a></li>
                                <li><a href="ui-images.html" data-key="t-images">Images</a></li>
                                <li><a href="ui-modals.html" data-key="t-modals">Modals</a></li>
                                <li><a href="ui-offcanvas.html" data-key="t-offcanvas">Offcanvas</a></li>
                                <li><a href="ui-progressbars.html" data-key="t-progress-bars">Progress Bars</a></li>
                                <li><a href="ui-placeholders.html" data-key="t-progress-bars">Placeholders</a></li>
                                <li><a href="ui-tabs-accordions.html" data-key="t-tabs-accordions">Tabs & Accordions</a></li>
                                <li><a href="ui-typography.html" data-key="t-typography">Typography</a></li>
                                <li><a href="ui-toasts.html" data-key="t-typography">Toasts</a></li>
                                <li><a href="ui-video.html" data-key="t-video">Video</a></li>
                                <li><a href="ui-general.html" data-key="t-general">General</a></li>
                                <li><a href="ui-colors.html" data-key="t-colors">Colors</a></li>
                                <li><a href="ui-utilities.html" data-key="t-colors">Utilities</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="gift"></i>
                                <span data-key="t-ui-elements">Extended</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="extended-lightbox.html" data-key="t-lightbox">Lightbox</a></li>
                                <li><a href="extended-rangeslider.html" data-key="t-range-slider">Range Slider</a></li>
                                <li><a href="extended-sweet-alert.html" data-key="t-sweet-alert">SweetAlert 2</a></li>
                                <li><a href="extended-session-timeout.html" data-key="t-session-timeout">Session Timeout</a></li>
                                <li><a href="extended-rating.html" data-key="t-rating">Rating</a></li>
                                <li><a href="extended-notifications.html" data-key="t-notifications">Notifications</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i data-feather="box"></i>
                                <span class="badge rounded-pill badge-soft-danger  text-danger float-end">7</span>
                                <span data-key="t-forms">Forms</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="form-elements.html" data-key="t-form-elements">Basic Elements</a></li>
                                <li><a href="form-validation.html" data-key="t-form-validation">Validation</a></li>
                                <li><a href="form-advanced.html" data-key="t-form-advanced">Advanced Plugins</a></li>
                                <li><a href="form-editors.html" data-key="t-form-editors">Editors</a></li>
                                <li><a href="form-uploads.html" data-key="t-form-upload">File Upload</a></li>
                                <li><a href="form-wizard.html" data-key="t-form-wizard">Wizard</a></li>
                                <li><a href="form-mask.html" data-key="t-form-mask">Mask</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="sliders"></i>
                                <span data-key="t-tables">Tables</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="tables-basic.html" data-key="t-basic-tables">Bootstrap Basic</a></li>
                                <li><a href="tables-datatable.html" data-key="t-data-tables">DataTables</a></li>
                                <li><a href="tables-responsive.html" data-key="t-responsive-table">Responsive</a></li>
                                <li><a href="tables-editable.html" data-key="t-editable-table">Editable</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="pie-chart"></i>
                                <span data-key="t-charts">Charts</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="charts-apex.html" data-key="t-apex-charts">Apexcharts</a></li>
                                <li><a href="charts-echart.html" data-key="t-e-charts">Echarts</a></li>
                                <li><a href="charts-chartjs.html" data-key="t-chartjs-charts">Chartjs</a></li>
                                <li><a href="charts-knob.html" data-key="t-knob-charts">Jquery Knob</a></li>
                                <li><a href="charts-sparkline.html" data-key="t-sparkline-charts">Sparkline</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="cpu"></i>
                                <span data-key="t-icons">Icons</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="icons-boxicons.html" data-key="t-boxicons">Boxicons</a></li>
                                <li><a href="icons-materialdesign.html" data-key="t-material-design">Material Design</a></li>
                                <li><a href="icons-dripicons.html" data-key="t-dripicons">Dripicons</a></li>
                                <li><a href="icons-fontawesome.html" data-key="t-font-awesome">Font Awesome 5</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="map"></i>
                                <span data-key="t-maps">Maps</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="maps-google.html" data-key="t-g-maps">Google</a></li>
                                <li><a href="maps-vector.html" data-key="t-v-maps">Vector</a></li>
                                <li><a href="maps-leaflet.html" data-key="t-l-maps">Leaflet</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="share-2"></i>
                                <span data-key="t-multi-level">Multi Level</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);" data-key="t-level-1-1">Level 1.1</a></li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2">Level 1.2</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="javascript: void(0);" data-key="t-level-2-1">Level 2.1</a></li>
                                        <li><a href="javascript: void(0);" data-key="t-level-2-2">Level 2.2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> --}}

                    </ul>

                    {{-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                        <div class="card-body">
                            <img src="{{  asset('images/giftbox.png')}}" alt="">
                            <div class="mt-4">
                                <h5 class="alertcard-title font-size-16">Unlimited Access</h5>
                                <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>
                                <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
@yield('main')
