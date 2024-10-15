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
    <link href="{{ asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" rel="stylesheet">
    <link href="{{ asset('css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- calender  --}}

    <link href="{{ asset('libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.css') }}">

    <link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    <!-- color picker css -->
    <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/classic.min.css') }}" />
    <!-- 'classic' theme -->
    <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/monolith.min.css') }}" />
    <!-- 'monolith' theme -->
    <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->

    <!-- flatpickr css -->
    <link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

    <style>
        table.dataTable.no-footer {
            border-bottom: 0px
        }
    </style>
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
                                <img src="#" alt="" height="10"> <span class="logo-txt"
                                    style="font-size: 10px">{{ $company_name ?? '' }}</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="search" class="icon-lg"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="بحث ..."
                                            aria-label="نتائج البحث">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                            <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                        </button>
                    </div>
                    <?php
                    // Get today's date
                    $today = date('Y-m-d');

                    // Get the date 30 days from today
                    $dateIn30Days = date('Y-m-d', strtotime('+30 days'));
                    $userId = Auth::id();
                    $user_type = Auth::user()->user_type; // Assuming user_type is a column in the users table

                    // Query for employee_docs
                    $employeeDocsQuery = DB::table('employee_docs')
                        ->whereBetween('expiry_date', [$today, $dateIn30Days])
                        ->orderBy('expiry_date', 'asc'); // Sort by expiry_date in ascending order

                    // Filter by user_id if not admin
                    if ($user_type != 1) {
                        $employeeDocsQuery->where('user_id', $userId);
                    }

                    // Fetch employee_docs records
                    $employeeDocs = $employeeDocsQuery->get();

                    // Get company IDs for the current user
                    $companies = DB::table('companies')->where('user_id', $userId)->pluck('id');

                    // Initialize companyDocs collection
                    $companyDocs = collect();

                    if ($companies->isNotEmpty()) {
                        // Query for company_docs
                        $companyDocs = DB::table('company_docs')
                            ->whereIn('company_id', $companies)
                            ->whereBetween('expiry_date', [$today, $dateIn30Days])
                            ->orderBy('expiry_date', 'asc') // Sort by expiry_date in ascending order
                            ->get();
                    }

                    // Calculate total notifications
                    $total_noti = $companyDocs->count() + $employeeDocs->count();

                    // Assign data to variables
                    $emp_docs = $employeeDocs;
                    $comp_docs = $companyDocs;
                    ?>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon position-relative"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="المستندات التي ستنتهي قريبًا">
                            <i data-feather="bell" class="icon-lg"></i>
                            <span class="badge bg-danger rounded-pill"><?php echo $total_noti; ?></span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">المستندات التي ستنتهي قريبًا</h6>
                                    </div>

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
                                            <h6 class="mb-1">{{ $cd->companydoc_name }} من {{ $cd->company_name }}
                                            </h6>
                                            <div class="font-size-13 text-muted">
                                                <p class="mb-1"><?php echo $renewl_period2; ?> - {{ $cd->expiry_date }}</p>
                                                {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>منذ 3 دقائق</span></p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php } ?>
                                <?php foreach ($emp_docs as $key => $ed) {
                                    $expiryDate = new DateTime($ed->expiry_date);

                                    $today = new DateTime();

                                    $interval = $today->diff($expiryDate);

                                    $diffInYears = (int)$interval->y;
                                    $diffInMonths = (int)$interval->m;
                                    $diffInDays = (int)$interval->d;

                                    $totalDaysRemaining = (int)$today->diff($expiryDate)->days;

                                    if ($totalDaysRemaining < 1) {
                                        $renewl_period = '<p style="text-align:center; color: red;">منتهي الصلاحية</p>';
                                    } else {
                                        $yearsText = $diffInYears > 1 ? 'سنوات' : 'سنة';
                                        $monthsText = $diffInMonths > 1 ? 'أشهر' : 'شهر';
                                        $daysText = $diffInDays > 1 ? 'أيام' : 'يوم';

                                        $timeLeft = "$diffInYears $yearsText, $diffInMonths $monthsText, $diffInDays $daysText";

                                        $badgeClass = $totalDaysRemaining < 60 ? 'badge badge-soft-danger font-size-15' : 'badge badge-soft-success font-size-15';

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
                                            <h6 class="mb-1">{{ $ed->employeedoc_name }} من
                                                {{ $ed->employee_name }} </h6>
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
                                <a class="btn btn-sm btn-link font-size-14 text-center"
                                    href="{{ url('show_expired_docs') }}">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span>عرض المزيد..</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- new --}}

                    @php
                        // Fetch and merge the documents
                        $employeeDocs = DB::table('employee_docs')
                            ->where('doc_status', 2)
                            ->get()
                            ->map(function ($doc) {
                                $doc->doc_name = $doc->employeedoc_name;
                                $doc->company_name = $doc->employee_company;
                                $doc->employee_name = $doc->employee_name; // Rename field for consistency
                                $doc->type = 'employee'; // Add type for badge color
                                return $doc;
                            });

                        $companyDocs = DB::table('company_docs')
                            ->where('doc_status', 2)
                            ->get()
                            ->map(function ($doc) {
                                $doc->doc_name = $doc->companydoc_name;
                                $doc->company_name = $doc->company_name; // Rename field for consistency
                                $doc->type = 'company'; // Add type for badge color
                                return $doc;
                            });

                        $allDocs = $employeeDocs->merge($companyDocs)->sortByDesc('updated_at')->take(6);

                    @endphp

                    <div class="dropdown d-inline-block">

                        @if (Auth::check() && Auth::user()->user_type == 1)
                            <button type="button" class="btn header-item noti-icon position-relative"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip"
                                data-bs-placement="top" title=" مستندات عملية التجديد ">


                                <i data-feather="file-text" class="icon-lg"></i>

                                <span class="badge bg-danger rounded-pill">{{ $allDocs->count() }}</span>

                            </button>
                        @endif

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">{{ __('مستندات عملية التجديد') }}</h6>
                                    </div>

                                </div>
                            </div>
                            @if ($allDocs->isNotEmpty())
                                <div data-simplebar style="max-height: 230px;">
                                    @foreach ($allDocs as $doc)
                                        @php
                                            $updatedAt = \Carbon\Carbon::parse($doc->updated_at);
                                            // Determine badge class and text
                                            $badgeClass = $doc->type == 'company' ? 'bg-success' : 'bg-info';
                                            $badgeText = $doc->type == 'company' ? __('شركة مستند') : __('مستند موظف');
                                        @endphp
                                        <a href="#!" class="text-reset notification-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ $doc->doc_name }}</h6>
                                                    <span>{{ $doc->employee_name ?? '' }}</span>
                                                    <div class="font-size-13 text-muted">
                                                        <span>{{ $doc->company_name ?? '' }}</span>

                                                        <p class="mb-0">
                                                            <i class="mdi mdi-clock-outline"></i>
                                                            <span
                                                                class="mb-1">{{ $updatedAt->format('Y-m-d g:i a') }}
                                                                {{ $updatedAt->format('a') == 'am' ? 'ص' : 'م' }}</span>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <span
                                                        class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p>{{ __('لم يتم العثور على مستندات.') }}</p>
                            @endif
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center"
                                    href="{{ url('under_process') }}">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i>
                                    <span>{{ __('عرض المزيد..') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>


                    {{-- endnew  --}}
                    <div class="dropdown d-inline-block">

                        @php
                        $leaves = DB::table('approvals')->where('approval_status', 0)->get();
                        $leave_count=$leaves->count();
                        @endphp

                        @if (Auth::check() && Auth::user()->user_type == 1)
                            <button type="button" class="btn header-item noti-icon position-relative"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="طلبات الإجازات">
                                <i data-feather="slack" class="icon-lg"></i>
                                <span class="badge bg-danger rounded-pill">{{ $leave_count ?? '' }}</span>
                            </button>
                        @endif

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">أحدث طلبات الإجازات</h6>
                                    </div>
                                </div>
                            </div>

                            @if($leaves->isNotEmpty())
                                <div data-simplebar style="max-height: 230px;">
                                    @foreach ($leaves as $leave)
                                        <a href="#!" class="text-reset notification-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ $leave->employee_name }}</h6>
                                                    <span> <span>مدة الإجازة:</span>{{ $leave->duration ?? '' }}</span>
                                                    <div class="font-size-13 text-muted">
                                                        <span> <span>تاريخ البدء</span>{{ $leave->start_date ?? '' }} <br> <span>تاريخ الانتهاء</span>{{ $leave->end_date ?? '' }}</span>

                                                        <p class="mb-0">
                                                            <i class="mdi mdi-clock-outline"></i>
                                                            <span class="mb-1">
                                                                @if($leave->leave_type == 1)
                                                                    إجازة مرضية
                                                                @else
                                                                    إجازة سنوية
                                                                @endif
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p>لا توجد طلبات إجازة</p>
                            @endif
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center"
                                    href="{{ url('all_leaves') }}">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i>
                                    <span>{{ __('عرض المزيد..') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- second --}}

                    @php
                        // Fetch document history where status is 2
                        $documentHistories = DB::table('document_history')
                            ->where('status', 2)
                            ->leftJoin('employees', 'document_history.employee_id', '=', 'employees.id')
                            ->leftJoin('companies', 'document_history.company_id', '=', 'companies.id')
                            ->select(
                                'document_history.*',
                                'employees.employee_name as employee_name',
                                'companies.company_name as company_name',
                            )
                            ->get()
                            ->map(function ($doc) {
                                // Determine the document name and type
                                $doc->name = $doc->doc_name; // Use doc_name directly from document_history
                                $doc->type = $doc->employee_name ? 'employee' : 'company'; // Add type for badge color
                                return $doc;
                            })
                            ->sortByDesc('updated_at')
                            ->take(6); // Get only the latest 6 records
                    @endphp

                    <div class="dropdown d-inline-block">
                        @if (Auth::check() && Auth::user()->user_type == 1)
                            <button type="button" class="btn header-item noti-icon position-relative"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="المستندات التي تم تجديدها مؤخرًا">
                                <i data-feather="clipboard" class="icon-lg"></i>
                                <span class="badge bg-danger rounded-pill">{{ $documentHistories->count() }}</span>
                            </button>
                        @endif
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">{{ __('المستندات التي تم تجديدها مؤخرًا') }}</h6>
                                    </div>
                                    {{-- <div class="col-auto">
                    <a href="#!" class="small text-reset text-decoration-underline">{{ __('غير المقروءة') }} ({{ $documentHistories->where('read', 0)->count() }})</a>
                </div> --}}
                                </div>
                            </div>
                            @if ($documentHistories->isNotEmpty())
                                <div data-simplebar style="max-height: 230px;">
                                    @foreach ($documentHistories as $doc)
                                        @php
                                            $updatedAt = \Carbon\Carbon::parse($doc->updated_at);
                                            $now = \Carbon\Carbon::now();
                                            $diffInHours = $updatedAt->diffInHours($now);
                                            $diffInDays = $updatedAt->diffInDays($now);
                                            $diffInMonths = $updatedAt->diffInMonths($now);

                                            // Determine time ago format
                                            if ($diffInMonths > 0) {
                                                $timeAgo =
                                                    $diffInMonths .
                                                    ' ' .
                                                    __('شهر') .
                                                    ($diffInMonths > 1 ? __('شهور') : '');
                                            } elseif ($diffInDays > 0) {
                                                $timeAgo =
                                                    $diffInDays . ' ' . __('يوم') . ($diffInDays > 1 ? __('أيام') : '');
                                            } else {
                                                $timeAgo =
                                                    $diffInHours .
                                                    ' ' .
                                                    __('ساعة') .
                                                    ($diffInHours > 1 ? __('ساعات') : '');
                                            }

                                            // Determine badge class and text
                                            $badgeClass = $doc->type == 'company' ? 'bg-success' : 'bg-info';
                                            $badgeText = $doc->type == 'company' ? __('شركة مستند') : __('مستند موظف');
                                            $companyNames = DB::table('companies')
                                                ->where('id', $doc->company_id)
                                                ->value('company_name');
                                            $employeeNames = DB::table('employees')
                                                ->where('id', $doc->employee_id)
                                                ->value('employee_name');
                                            $emp_company_id = DB::table('employees')
                                                ->where('id', $doc->employee_id)
                                                ->value('employee_company');
                                            $emp_comp_name = DB::table('companies')
                                                ->where('id', $emp_company_id)
                                                ->value('company_name');

                                        @endphp
                                        <a href="#!" class="text-reset notification-item">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ $doc->name }}</h6>
                                                    <div class="font-size-13 text-muted">
                                                        <span
                                                            class="mb-1">{{ $employeeNames ?? $companyNames }}</span>
                                                        <span class="mb-1">{{ $emp_comp_name ?? '' }}</span>

                                                        <p class="mb-0">
                                                            <i class="mdi mdi-clock-outline"></i>
                                                            <span
                                                                class="mb-1">{{ $updatedAt->format('Y-m-d g:i a') }}
                                                                {{ $updatedAt->format('a') == 'am' ? 'ص' : 'م' }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <span
                                                        class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p>{{ __('لم يتم العثور على مستندات.') }}</p>
                            @endif
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center"
                                    href="{{ url('renewed_docs') }}">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i>
                                    <span>{{ __('عرض المزيد..') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>



                    {{-- endsecond --}}





                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item bg-light-subtle border-start border-end"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('images/users/user.png') }}" alt="صورة الملف الشخصي">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ $user_name ?? '' }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="apps-contacts-profile.html"><i
                                    class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> الملف الشخصي</a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item logout" href=""><i
                                    class="mdi mdi-logout font-size-16 align-middle me-1"></i> تسجيل الخروج</a>
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
                            @if (Auth::check() && Auth::user()->user_type == 1)
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-apps">إدارة المكتب</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('user') }}">
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
                                    <li>
                                        <a href="{{ url('document') }}" data-key="t-maintenance">إضافة مستند</a>
                                    </li>
                                </ul>
                            @endif



                        </li>

                        <li>
                            @if (Auth::check() && Auth::user()->user_type == 1)
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="pie-chart"></i>
                                    <span data-key="t-pages">إدارة الشركات</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('company') }}" data-key="t-starter-page">الشركات</a></li>
                                    <li><a href="{{ url('employee') }}" data-key="t-maintenance">الموظفون</a></li>


                                </ul>
                            @endif
                        </li>




                        <li>
                            @if (Auth::check() && Auth::user()->user_type == 1)
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="cpu"></i>
                                    <span data-key="t-pages"> تقارير</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('employee_doc_report') }}" data-key="t-starter-page"> تقرير
                                            وثائق الموظف</a></li>
                                    <li><a href="{{ url('company_doc_report') }}" data-key="t-starter-page"> تقرير
                                            وثائق الشركة</a></li>
                                    <li><a href="{{ url('doc_expiry') }}" data-key="t-starter-page"> تقرير انتهاء
                                            صلاحية الوثائق</a></li>
                                    <li><a href="{{ url('employee_task_report') }}" data-key="t-starter-page">تقرير
                                            مهام الموظفين</a></li>
                                    <li><a href="{{ url('task_complete') }}" data-key="t-starter-page"> تقرير إتمام
                                            مهام الموظف </a></li>
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="map"></i>
                                <span data-key="t-pages">صفحة مهام الموظف</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('employee_task_page/' . $user_id) }}"
                                        data-key="t-starter-page">مهام الموظف</a></li>

                            </ul>
                        </li>
                        <li>

                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="share-2"></i>
                                <span data-key="t-pages"> الوثائق المنتهية </span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('show_expired_docs') }}" data-key="t-starter-page"> الوثائق قيد
                                        المعالجة </a></li>
                                <li><a href="{{ url('under_process') }}" data-key="t-starter-page"> المستندات قيد
                                        المعالجة </a></li>
                                @if (Auth::check() && Auth::user()->user_type == 1)
                                    <li><a href="{{ url('renewed_docs') }}" data-key="t-starter-page"> الوثائق
                                            المجددة </a></li>
                                @endif
                            </ul>

                        </li>

                        <li>
                            @if (Auth::check() && Auth::user()->user_type == 1)
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="pie-chart"></i>
                                    <span data-key="t-pages">الإجازات</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('all_leaves') }}" data-key="t-starter-page">سجل الإجازات</a>
                                    </li>
                                </ul>
                            @endif

                        </li>

                    </ul>

                </div>
                <!-- Sidebar -->
            </div>
        </div>

        <!-- Left Sidebar End -->
        @yield('main')
