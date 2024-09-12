

@extends('layouts.header')
@section('main')
    @push('title')
    <title>اللوحة الرئيسية</title>
    @endpush


        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">اللوحة الرئيسية</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">اللوحة الرئيسية</a></li>
                                        <li class="breadcrumb-item active">اللوحة الرئيسية</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">إجمالي موظفي المكتب</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value" data-target="{{ $users ?? '' }}"></span>
                                            </h4>
                                        </div>

                                        <div class="col-6">
                                            <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-success-subtle text-success">المستخدمون</span>
                                        <span class="ms-1 text-muted font-size-13">ذوو الوصول المحدد</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">عدد الشركات</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value" data-target="{{ $company ?? '' }}"></span>
                                            </h4>
                                        </div>
                                        <div class="col-6">
                                            <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-danger-subtle text-danger">الشركات</span>
                                        <span class="ms-1 text-muted font-size-13">مع عدة مستندات</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">وثائق الشركات</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value" data-target="{{ $comp_docs_cout ?? '' }}"></span>
                                            </h4>
                                        </div>
                                        <div class="col-6">
                                            <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-success-subtle text-success">وثائق الشركات</span>
                                        <span class="ms-1 text-muted font-size-13">تمت إضافتها بشكل منفصل لكل شركة</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">وثائق الموظفين</span>
                                            <h4 class="mb-3">
                                                <span class="counter-value" data-target="{{ $employee_doc ?? '' }}"></span>
                                            </h4>
                                        </div>
                                        <div class="col-6">
                                            <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                        </div>
                                    </div>
                                    <div class="text-nowrap">
                                        <span class="badge bg-success-subtle text-success">وثائق الموظفين</span>
                                        <span class="ms-1 text-muted font-size-13">موظفون من {{ $company ?? '' }} شركات</span>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>
                    <!-- end row-->

                    <div class="row">
                        <div class="col-xl-5">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center mb-4">
                                        <h5 class="card-title me-2"></h5>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-sm align-self-center">
                                            <div class="mt-4 mt-sm-0">
                                                <div>
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-circle align-middle font-size-10 me-2 text-success"></i>
                                                        نسبة وثائق الموظفين
                                                    </p>
                                                    <h6>
                                                        <span class="text-muted font-size-14 fw-normal">
                                                            {{ number_format($employeeDocsPercent ?? 0, 3) }}%
                                                        </span>
                                                    </h6>
                                                </div>

                                                <div class="mt-4 pt-2">
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-circle align-middle font-size-10 me-2 text-primary"></i>
                                                        نسبة وثائق الشركات
                                                    </p>
                                                    <h6>
                                                        <span class="text-muted font-size-14 fw-normal">
                                                            {{ number_format($companyDocsPercent ?? 0, 3) }}%
                                                        </span>
                                                    </h6>
                                                </div>

                                                <div class="mt-4 pt-2">
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-circle align-middle font-size-10 me-2 text-info"></i>
                                                        نسبة الوثائق المجددة
                                                    </p>
                                                    <h6>
                                                        <span class="text-muted font-size-14 fw-normal">
                                                            {{ number_format($renewedDocsPercent ?? 0, 3) }}%
                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var options = {
                                            series: [
                                                { name: 'وثائق الموظفين', data: [{{ $employeeDocsPercent }}] },
                                                { name: 'وثائق الشركات', data: [{{ $companyDocsPercent }}] },
                                                { name: 'الوثائق المجددة', data: [{{ $renewedDocsPercent }}] }
                                            ],
                                            chart: {
                                                type: 'pie'
                                            },
                                            labels: ['وثائق الموظفين', 'وثائق الشركات', 'الوثائق المجددة'],
                                            colors: ['#777aca', '#5156be', '#a8aada']
                                        };

                                        var chart = new ApexCharts(document.querySelector("#wallet-balance"), options);
                                        chart.render();
                                    });
                                </script>
                            </div>

                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-xl-8">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                                <h5 class="card-title me-2">التفاصيل</h5>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-sm">
                                                    <div id="invested-overview" data-colors='["#5156be", "#34c38f"]' class="apex-charts"></div>
                                                </div>
                                                <div class="col-sm align-self-center">
                                                    <div class="mt-4 mt-sm-0">
                                                        <p class="mb-1">إجمالي الوثائق المجددة</p>
                                                        <h4>{{ $renewed ?? '' }}</h4>

                                                        <p class="text-muted mb-4"> {{ $total_docs ?? '' }} <i class="mdi mdi-arrow-up ms-1 text-success"> إجمالي الوثائق</i></p>

                                                        <div class="row g-0">
                                                            <div class="col-6">
                                                                <div>
                                                                    <p class="mb-2 text-muted text-uppercase font-size-11">وثائق الشركات قيد المعالجة</p>
                                                                    <h5 class="fw-medium">{{ $company_doc_count ?? '' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div>
                                                                    <p class="mb-2 text-muted text-uppercase font-size-11">وثائق الموظفين قيد المعالجة</p>
                                                                    <h5 class="fw-medium">{{ $employee_doc_count ?? '' }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-2">
                                                            <a href="{{ url('show_expired_docs') }}" class="btn btn-primary btn-sm">تفاصيل الوثائق <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-4">
                                    <!-- card -->
                                    <div class="card bg-primary text-white shadow-primary card-h-100">

                                        <div class="card-body p-0">
                                            <div id="userActivityCarousel" class="carousel slide text-center" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($carouselItems as $index => $item)
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                            <div class="text-center p-4">
                                                                <h4 class="mt-3 lh-base fw-normal text-white"><b>{{ $item['user_name'] }}</b></h4>
                                                                <h4 class="mt-3 lh-base fw-normal text-white"> رقم المستخدم-<b>{{ $item['user_id'] }}</b></h4>
                                                                <p class="text-white-50 font-size-13">إجمالي السجلات: {{ $item['count'] }}</p>
                                                                <p class="text-white-50 font-size-13" style="text-align: justify"> {{ $item['user_detail'] }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- end carousel-inner -->

                                                <div class="carousel-indicators">
                                                    @foreach ($carouselItems as $index => $item)
                                                        <button type="button" data-bs-target="#userActivityCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="الشريحة {{ $index + 1 }}"></button>
                                                    @endforeach
                                                </div>
                                                <!-- end carousel-indicators -->
                                            </div>
                                            <!-- end carousel -->
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>

                        <!-- end col -->
                    </div> <!-- end row-->



                    <div class="row">

                        <!-- end col -->
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">

                                    @if (Auth::check() && Auth::user()->user_type == 1)
                                    <h4 class="card-title mb-0 flex-grow-1">أحدث الموظفين المضافين</h4>
                                    @else
                                    <h4 class="card-title mb-0 flex-grow-1"> مستندات الموظفين</h4>
                                    @endif
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                        </ul>
                                        <!-- end nav tabs -->
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body px-0">
                                    <div>
                                        <div>
                                            <div class="table-responsive px-3" style="max-height: 352px;">
                                                <table class="table align-middle table-nowrap table-borderless">
                                                    <tbody>
                                                        @if (Auth::check() && Auth::user()->user_type == 1)
                                                        @foreach ( $emps as $emp)
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <div class="font-size-22 text-success">
                                                                    <i class="bx bx-down-arrow-circle d-block"></i>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1">اسم الموظف</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $emp->employee_name ?? '' }}</p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">شركة الموظف</h5>
                                                                    @php
                                                                    // Ensure 'emp' is defined and has 'employee_company' property
                                                                    if (isset($emp) && $emp->employee_company) {
                                                                        $company = DB::table('companies')
                                                                            ->where('id', $emp->employee_company)
                                                                            ->first();
                                                                    } else {
                                                                        $company = null; // Handle cases where 'emp' or 'employee_company' is not set
                                                                    }
                                                                    @endphp
                                                                    @if ($company)
                                                                        <p class="text-muted mb-0 font-size-12">{{ $company->company_name ?? '' }}</p>
                                                                    @else
                                                                        <p>الشركة غير موجودة.</p>
                                                                    @endif
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">تاريخ الإضافة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">
                                                                        {{ $emp->created_at ? \Carbon\Carbon::parse($emp->created_at)->format('Y-m-d') : '' }}
                                                                    </p>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        @foreach ($allData as $data)
                                                        @foreach ($data['employee_docs'] as $doc)
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <div class="font-size-22 text-success">
                                                                    <i class="bx bx-down-arrow-circle d-block"></i>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1">اسم الموظف</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $doc->employee_name ?? '' }}</p>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $doc->employee_company ?? '' }}</p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">Document </h5>
                                                                        <p class="text-muted mb-0 font-size-12">{{ $doc->employeedoc_name ?? '' }}</p>

                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">تاريخ الانتهاء</h5>

                                                                    @php
                                                                        if ($doc->expiry_date) {
                                                                            // Parse the expiry date using Carbon
                                                                            $expiryDate = \Carbon\Carbon::parse($doc->expiry_date);
                                                                            // Get the remaining days as a natural number (whole number)
                                                                            $remainingDays = \Carbon\Carbon::now()->diffInDays($expiryDate, false); // false flag ensures negative value if past
                                                                            $remainingDays = floor($remainingDays); // Ensure whole number (natural number)

                                                                            // Determine the badge color based on remaining days
                                                                            if ($remainingDays > 60) {
                                                                                $badgeClass = 'badge bg-success'; // Green badge for more than 60 days
                                                                            } elseif ($remainingDays > 0 && $remainingDays <= 60) {
                                                                                $badgeClass = 'badge bg-danger'; // Red badge for less than 60 days
                                                                            } else {
                                                                                $badgeClass = 'badge bg-danger'; // Red badge for expired or zero days
                                                                            }
                                                                        }
                                                                    @endphp

                                                                    @if (isset($remainingDays))
                                                                        <p class="mb-0 font-size-12">
                                                                            <span class="{{ $badgeClass }}">
                                                                                @if ($remainingDays > 0)
                                                                                    {{ $remainingDays }} أيام متبقية
                                                                                @elseif ($remainingDays == 0)
                                                                                    منتهي اليوم
                                                                                @else
                                                                                    منتهي منذ {{ abs($remainingDays) }} أيام
                                                                                @endif
                                                                            </span>
                                                                        </p>
                                                                    @else
                                                                        <p class="text-muted mb-0 font-size-12">لا يوجد تاريخ انتهاء</p>
                                                                    @endif
                                                                </div>
                                                            </td>




                                                        </tr>
                                                        @endforeach
                                                        @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    @if (Auth::check() && Auth::user()->user_type == 1)
                                    <h4 class="card-title mb-0 flex-grow-1">  أحدث الموظفين والشركات المضافة</h4>
                                    @else
                                    <h4 class="card-title mb-0 flex-grow-1"> مستندات الشركات </h4>

                                    @endif
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                        </ul>
                                        <!-- end nav tabs -->
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body px-0">
                                    <div>
                                        <div>
                                            <div class="table-responsive px-3" style="max-height: 352px;">
                                                <table class="table align-middle table-nowrap table-borderless">
                                                    <tbody>
                                                        @if (Auth::check() && Auth::user()->user_type == 1)
                                                        @foreach ($comps as $comp)
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <div class="font-size-22 text-success">
                                                                    <i class="bx bx-down-arrow-circle d-block"></i>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1"> {{ $comp->employee_company ?? '' }}</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $comp->employee_name ?? '' }}</p>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $comp->employeedoc_name ?? '' }}</p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">تاريخ الإضافة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">
                                                                        {{ $comp->created_at ? \Carbon\Carbon::parse($comp->created_at)->format('Y-m-d') : '' }}
                                                                    </p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 text-muted mb-0">أضيف بواسطة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $comp->added_by ?? '' }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach

                                                        @else
                                                        @foreach ($allData as $data)
                                                        @foreach ($data['company_docs'] as $doc)
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <div class="font-size-22 text-success">
                                                                    <i class="bx bx-down-arrow-circle d-block"></i>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1"> {{ $doc->company_name ?? '' }}</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $doc->companydoc_name ?? '' }}</p>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $doc->expiry_date ?? '' }}</p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">تاريخ الانتهاء</h5>

                                                                    @php
                                                                        if ($doc->expiry_date) {
                                                                            // Parse the expiry date using Carbon
                                                                            $expiryDate = \Carbon\Carbon::parse($doc->expiry_date);
                                                                            // Get the remaining days as a natural number (whole number)
                                                                            $remainingDays = \Carbon\Carbon::now()->diffInDays($expiryDate, false); // false flag ensures negative value if past
                                                                            $remainingDays = floor($remainingDays); // Ensure whole number (natural number)

                                                                            // Determine the badge color based on remaining days
                                                                            if ($remainingDays > 60) {
                                                                                $badgeClass = 'badge bg-success'; // Green badge for more than 60 days
                                                                            } elseif ($remainingDays > 0 && $remainingDays <= 60) {
                                                                                $badgeClass = 'badge bg-danger'; // Red badge for less than 60 days
                                                                            } else {
                                                                                $badgeClass = 'badge bg-danger'; // Red badge for expired or zero days
                                                                            }
                                                                        }
                                                                    @endphp

                                                                    @if (isset($remainingDays))
                                                                        <p class="mb-0 font-size-12">
                                                                            <span class="{{ $badgeClass }}">
                                                                                @if ($remainingDays > 0)
                                                                                    {{ $remainingDays }} أيام متبقية
                                                                                @elseif ($remainingDays == 0)
                                                                                    منتهي اليوم
                                                                                @else
                                                                                    منتهي منذ {{ abs($remainingDays) }} أيام
                                                                                @endif
                                                                            </span>
                                                                        </p>
                                                                    @else
                                                                        <p class="text-muted mb-0 font-size-12">لا يوجد تاريخ انتهاء</p>
                                                                    @endif
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 text-muted mb-0">أضيف بواسطة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $doc->added_by ?? '' }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endforeach

                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    @if (Auth::check() && Auth::user()->user_type == 1)
                                    <h4 class="card-title mb-0 flex-grow-1">أحدث الوثائق</h4>
                                    @else
                                    <h4 class="card-title mb-0 flex-grow-1">الشركات </h4>
                                    @endif
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                        </ul>
                                        <!-- end nav tabs -->
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body px-0">
                                    <div>
                                        <div>
                                            <div class="table-responsive px-3" style="max-height: 352px;">
                                                <table class="table align-middle table-nowrap table-borderless">
                                                    <tbody>
                                                        @if (Auth::check() && Auth::user()->user_type == 1)
                                                        @foreach ($docs as $doc)
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <div class="font-size-22 text-success">
                                                                    <i class="bx bx-down-arrow-circle d-block"></i>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1">{{ $doc->company_name ?? '' }} </h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $doc->companydoc_name ?? '' }}</p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">تاريخ الإضافة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">
                                                                        {{ $doc->created_at ? \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') : '' }}
                                                                    </p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 text-muted mb-0">أضيف بواسطة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $doc->added_by ?? '' }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        @foreach ($allData as $data)
                                                        @foreach ($data['company2'] as $comp)
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <div class="font-size-22 text-success">
                                                                    <i class="bx bx-down-arrow-circle d-block"></i>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1">{{ $comp->company_name ?? '' }} </h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $comp->company_phone ?? '' }}</p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0">تاريخ الإضافة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">

                                                                        {{ $comp->created_at ? \Carbon\Carbon::parse($comp->created_at)->format('Y-m-d') : '' }}
                                                                    </p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 text-muted mb-0">أضيف بواسطة</h5>
                                                                    <p class="text-muted mb-0 font-size-12">{{ $comp->added_by ?? '' }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </div>

                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->



        </div>
        <!-- end main content-->


    </div>
    <!-- END layout-wrapper -->


@include('layouts.footer')
@endsection
