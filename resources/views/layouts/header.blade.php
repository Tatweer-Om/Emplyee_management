<!doctype html>
<html lang="en" dir="rtl">

<head>

    <meta charset="utf-8" />

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

    @php
    $about = DB::table('abouts')->first();
    $company_name = $about->about_name ?? '';

    $user = Auth::user();
    $user_name = $user->user_name ?? '';
    $user_id = $user->id;
@endphp



    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="#" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="#" alt="" height="24"> <span class="logo-txt">{{  $company_name ?? '' }}</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
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
                                        <input type="text" class="form-control" placeholder="بحث ..." aria-label="نتائج البحث">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                        // الحصول على تاريخ اليوم
                        $today = date('Y-m-d');

                        // الحصول على التاريخ بعد 30 يومًا
                        $dateIn30Days = date('Y-m-d', strtotime('+30 days'));
                        $today = date('Y-m-d');
                        $userId = Auth::id();
                        $user_type = Auth::user()->user_type; // افتراض أن user_type هو عمود في جدول المستخدمين

                        // لجدول employee_docs
                        $employeeDocs = DB::table('employee_docs')
                            ->whereBetween('expiry_date', [$today, $dateIn30Days]);

                        if ($user_type != 1) {
                            $employeeDocs->where('user_id', $userId);
                        }

                        // استرجاع سجلات employee_docs
                        $employeeDocs = $employeeDocs->get();

                        // لجدول company_docs
                        $companyDocs = DB::table('company_docs')
                            ->whereBetween('expiry_date', [$today, $dateIn30Days]);

                        if ($user_type != 1) {
                            $companyDocs->where('user_id', $userId);
                        }

                        // استرجاع سجلات company_docs
                        $companyDocs = $companyDocs->get();

                        // حساب إجمالي الإشعارات
                        $total_noti = $companyDocs->count() + $employeeDocs->count();

                        // الآن $employeeDocs و $companyDocs هما مجموعات
                        $emp_docs = $employeeDocs;
                        $comp_docs = $companyDocs;

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
                                        <h6 class="m-0">الإشعارات</h6>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <a href="#!" class="small text-reset text-decoration-underline"> غير مقروء (3)</a>
                                    </div> --}}
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <?php foreach ($comp_docs as $key => $cd) {
                                    // تحليل تاريخ انتهاء الصلاحية
                                    $expiryDate = new DateTime($cd->expiry_date);

                                    // الحصول على التاريخ الحالي
                                    $today = new DateTime();

                                    // حساب الفرق ككائن DateInterval
                                    $interval = $today->diff($expiryDate);

                                    // استخراج الفرق بالسنوات والشهور والأيام
                                    $diffInYears = (int)$interval->y;
                                    $diffInMonths = (int)$interval->m;
                                    $diffInDays = (int)$interval->d;

                                    // حساب إجمالي الأيام المتبقية
                                    $totalDaysRemaining = (int)$today->diff($expiryDate)->days;

                                    // تحديد إذا كان منتهي الصلاحية
                                    if ($totalDaysRemaining < 1) {
                                        $renewl_period2 = '<p style="text-align:center; color: red;">منتهي الصلاحية</p>';
                                    } else {
                                        // تنسيق الفرق باللغة العربية
                                        $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                                        $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                                        $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                                        $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                                        // تحديد لون الشارة بناءً على إجمالي الأيام المتبقية
                                        $badgeClass = $totalDaysRemaining < 60 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                                        // إخراج الوقت المتبقي وإجمالي الأيام المتبقية
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
                                                <h6 class="mb-1">{{ $cd->companydoc_name }} من {{ $cd->company_name }} </h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1"><?php echo $renewl_period2; ?> - {{ $cd->expiry_date }}</p>
                                                    {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>منذ 3 دقائق</span></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>
                                <?php foreach ($emp_docs as $key => $ed) {
                                    // تحليل تاريخ انتهاء الصلاحية
                                    $expiryDate = new DateTime($ed->expiry_date);

                                    // الحصول على التاريخ الحالي
                                    $today = new DateTime();

                                    // حساب الفرق ككائن DateInterval
                                    $interval = $today->diff($expiryDate);

                                    // استخراج الفرق بالسنوات والشهور والأيام
                                    $diffInYears = (int)$interval->y;
                                    $diffInMonths = (int)$interval->m;
                                    $diffInDays = (int)$interval->d;

                                    // حساب إجمالي الأيام المتبقية
                                    $totalDaysRemaining = (int)$today->diff($expiryDate)->days;

                                    // تحديد إذا كان منتهي الصلاحية
                                    if ($totalDaysRemaining < 1) {
                                        $renewl_period = '<p style="text-align:center; color: red;">منتهي الصلاحية</p>';
                                    } else {
                                        // تنسيق الفرق باللغة العربية
                                        $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                                        $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                                        $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                                        $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                                        // تحديد لون الشارة بناءً على إجمالي الأيام المتبقية
                                        $badgeClass = $totalDaysRemaining < 60 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

                                        // إخراج الوقت المتبقي وإجمالي الأيام المتبقية
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
                                                <h6 class="mb-1">{{ $ed->employeedoc_name }} من {{ $ed->employee_name }} </h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1"><?php echo $renewl_period; ?> - {{ $ed->expiry_date }}</p>
                                                    {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>منذ 3 دقائق</span></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ url('show_expired_docs') }}">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span>عرض المزيد..</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{  asset('images/users/user.png')}}" alt="صورة الملف الشخصي">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{  $user_name ?? '' }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> الملف الشخصي</a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item logout" href=""><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> تسجيل الخروج</a>
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
                        <li class="menu-title" data-key="t-menu">القائمة</li>

                        <li>
                            <a href="{{ url('/') }}">
                                <i data-feather="home"></i>
                                <span data-key="t-dashboard">اللوحة الرئيسية</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="grid"></i>
                                <span data-key="t-apps">إدارة المكتب</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{url('user')}}">
                                        <span data-key="t-calendar">موظفو المكتب</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ url('branch') }}">
                                        <span data-key="t-chat">فروع المكتب</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('about') }}">
                                        <span data-key="t-chat">عن المكتب</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="file-text"></i>
                                <span data-key="t-pages">إدارة الشركات</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('company') }}" data-key="t-starter-page">الشركات</a></li>
                                <li><a href="{{ url('employee') }}" data-key="t-maintenance">الموظفون</a></li>
                                <li><a href="{{ url('document') }}" data-key="t-maintenance">إضافة مستند</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="file-text"></i>
                                <span data-key="t-pages">صفحة مهام الموظف</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('employee_task_page/' . $user_id) }}" data-key="t-starter-page">مهام الموظف</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="file-text"></i>
                                <span data-key="t-pages">  Reports</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('employee_doc_report') }}" data-key="t-starter-page"> Employee Document report</a></li>
                                <li><a href="{{ url('company_doc_report') }}" data-key="t-starter-page"> Company Document report</a></li>
                            </ul>
                        </li>

                    </ul>

                </div>
                <!-- Sidebar -->
            </div>
        </div>

        <!-- Left Sidebar End -->
@yield('main')
