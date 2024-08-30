@extends('layouts.header')
@section('main')
    @push('title')
        <title>Assignments</title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $user->user_name ?? '' }}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ $user->user_name ?? '' }}</a></li>
                                    <li class="breadcrumb-item active">Employee</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-5">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="card-title me-2">Personal Details</h5>

                                </div>

                                <div class="row align-items-center">
                                    <div class="col-sm">
                                        <div id="wallet-balance" data-colors='["#777aca", "#5156be", "#a8aada"]'
                                            class="apex-charts"></div>
                                    </div>
                                    <div class="col-sm align-self-center">
                                        <div class="mt-4 mt-sm-0">
                                            <div>
                                                <p class="mb-2"><i
                                                        class="mdi mdi-circle align-middle font-size-10 me-2 text-success"></i>
                                                    General Details</p>
                                                <h6> Employee Name - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->user_name ?? '' }}</span>
                                                </h6>

                                                <h6>Employee ID - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->id ?? '' }}</span>
                                                </h6>
                                                <h6>Employee Branch - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $branch_name ?? '' }}</span>
                                                </h6>
                                                <h6>User Type - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user_type ?? '' }}</span>
                                                </h6>
                                                <h6>Phone - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->user_phone ?? '' }}
                                                    </span></h6>
                                                <h6> Email - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->user_email ?? '' }}</span>
                                                </h6>
                                                <h6> <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->user_detail ?? '' }}</span>
                                                </h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <h5 class="card-title me-2">{{ $user->user_name ?? '' }} Tasks</h5>

                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-sm">
                                                <div id="invested-overview" data-colors='["#5156be", "#34c38f"]'
                                                    class="apex-charts"></div>
                                            </div>
                                            <div class="col-sm align-self-center">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="mb-1">Total Employees</p>
                                                    <h4 id="total-employees"> </h4>

                                                    <p class="text-muted mb-4" id="employee-docs"> Employee Documents</p>

                                                    <div class="row g-0">
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">Total Companies</p>
                                                                <h5 class="fw-medium" id="total-companies"> </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">Company Documents</p>
                                                                <h5 class="fw-medium" id="company-docs"> </h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->




                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                </div> <!-- end row-->


                <!-- end row-->

                <div class="row">


                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Documents</h4>
                                <div class="flex-shrink-0">
                                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab"
                                                role="tab">
                                                Company Documents
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#transactions-buy-tab"
                                                role="tab">
                                                Employee Documents
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>

                            <div class="card-body px-0">
                                <div class="tab-content">

                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="transactions-all-tab" role="tabpanel">
                                        {{-- <a href="#" class="btn btn-success"  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#employee_modal" onclick="add_employee(' . $company->id . ')">Add Employee</a> <br><br> --}}
                                        <div class="table-responsive">

                                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                                style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;"
                                                id="company_table">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 120px; text-align:center;">الرقم التسلسلي</th>
                                                        <th style="text-align:center;">اسم الشركة</th>
                                                        <th style="text-align:center;">وثيقة الشركة</th>
                                                        <th style="text-align:center;">حالة الوثيقة</th>
                                                        <th style="text-align:center;">الإجراء</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <!-- Rows will be populated here via JavaScript -->
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="transactions-buy-tab" role="tabpanel">
                                        {{-- <a href="#" class="btn btn-success"  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#employee_modal" onclick="add_employee(' . $company->id . ')">Add Employee</a> <br><br> --}}
                                        <div class="table-responsive">

                                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                                style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;"
                                                id="employee_table">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 120px; text-align:center;">الرقم التسلسلي</th>
                                                        <th style="text-align:center;">اسم الموظف</th>
                                                        <th style="text-align:center;">وثائق الموظف</th>
                                                        <th style="text-align:center;">حالة الوثيقة</th>
                                                        <th style="text-align:center;">الإجراء</th>
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    <!-- Rows will be populated here via JavaScript -->
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Under Renewal Process</h4>
                            </div>

                            <div class="card-body px-0">
                                <div class="px-3" data-simplebar style="max-height: 352px;">
                                    <ul id="renewl_list" class="list-unstyled activity-wid mb-0 renewl_list">

                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>

        </div>




    </div>

    <div>
        <div class="modal modal-lg fade employee_modal" id="employee_modal2" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table align-middle dt-responsive table-check nowrap"
                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_profile_docs">
                        <thead>
                            <tr class="bg-transparent">
                                <th style="width: 120px; text-align:center;">رقم التسلسل</th>
                                <th style="text-align:center;">تفاصيل الوثيقة</th>
                                <th style="text-align:center;">حالة تاريخ الانتهاء</th>
                                <th style="text-align:center;">حالة التجديد</th>
                                <th style="text-align:center;">ملاحظات التجديد</th>
                                <th style="text-align:center;">تاريخ الإضافة</th>
                                <th style="text-align:center;">مستخدم المكتب</th>

                            </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    @include('layouts.footer')
@endsection
