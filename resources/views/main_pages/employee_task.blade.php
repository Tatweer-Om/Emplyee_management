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
                                                    <h4>$ 6134.39</h4>

                                                    <p class="text-muted mb-4"> 7565 <i
                                                            class="mdi mdi-arrow-up ms-1 text-success"></i> Employee
                                                        Documents</p>

                                                    <div class="row g-0">
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">Total
                                                                    Companies</p>
                                                                <h5 class="fw-medium">$ 2632.46</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">
                                                                    Company documents</p>
                                                                <h5 class="fw-medium">-$ 924.38</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-2">
                                                        <a href="#" class="btn btn-primary btn-sm">View more <i
                                                                class="mdi mdi-arrow-right ms-1"></i></a>
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
                                    <!-- card body -->
                                    <div class="card-body p-0">
                                        <div id="carouselExampleCaptions" class="carousel slide text-center widget-carousel"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="text-center p-4">
                                                        <i class="mdi mdi-bitcoin widget-box-1-icon"></i>
                                                        <div class="avatar-md m-auto">
                                                            <span
                                                                class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                                                                <i class="mdi mdi-currency-btc"></i>
                                                            </span>
                                                        </div>
                                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>Recently</b> Added
                                                        </h4>
                                                        <p class="text-white-50 font-size-13">Bitcoin prices fell sharply
                                                            amid the global sell-off in equities. Negative news
                                                            over the Bitcoin past week has dampened Bitcoin basics
                                                            sentiment for bitcoin. </p>
                                                        <button type="button" class="btn btn-light btn-sm">View details <i
                                                                class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </div>
                                                </div>
                                                <!-- end carousel-item -->
                                                <div class="carousel-item">
                                                    <div class="text-center p-4">
                                                        <i class="mdi mdi-ethereum widget-box-1-icon"></i>
                                                        <div class="avatar-md m-auto">
                                                            <span
                                                                class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                                                                <i class="mdi mdi-ethereum"></i>
                                                            </span>
                                                        </div>
                                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>About</b> to Expire
                                                        </h4>
                                                        <p class="text-white-50 font-size-13">Bitcoin prices fell sharply
                                                            amid the global sell-off in equities. Negative news
                                                            over the Bitcoin past week has dampened Bitcoin basics
                                                            sentiment for bitcoin. </p>
                                                        <button type="button" class="btn btn-light btn-sm">View details <i
                                                                class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </div>
                                                </div>
                                                <!-- end carousel-item -->
                                                <div class="carousel-item">
                                                    <div class="text-center p-4">
                                                        <i class="mdi mdi-litecoin widget-box-1-icon"></i>
                                                        <div class="avatar-md m-auto">
                                                            <span
                                                                class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                                                                <i class="mdi mdi-litecoin"></i>
                                                            </span>
                                                        </div>
                                                        <h4 class="mt-3 lh-base fw-normal text-white"><b>Under</b> Renewl
                                                            Process</h4>
                                                        <p class="text-white-50 font-size-13">Bitcoin prices fell sharply
                                                            amid the global sell-off in equities. Negative news
                                                            over the Bitcoin past week has dampened Bitcoin basics
                                                            sentiment for bitcoin. </p>
                                                        <button type="button" class="btn btn-light btn-sm">View details <i
                                                                class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </div>
                                                </div>
                                                <!-- end carousel-item -->
                                            </div>
                                            <!-- end carousel-inner -->

                                            <div class="carousel-indicators carousel-indicators-rounded">
                                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                                    data-bs-slide-to="0" class="active" aria-current="true"
                                                    aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
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
                                    <!-- end nav tabs -->
                                </div>
                            </div><!-- end card header -->

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
                                                        <th style="width: 120px; text-align:center;">Sr.No</th>
                                                        <th style="text-align:center;">Company Name</th>
                                                        <th style="text-align:center;">Company Document</th>
                                                        <th style="text-align:center;">Document Status</th>
                                                        <th style="text-align:center;">Action</th>
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
                                                        <th style="width: 120px; text-align:center;">Sr.No</th>
                                                        <th style="text-align:center;">Employee Name</th>
                                                        <th style="text-align:center;">Employee Documents</th>
                                                        <th style="text-align:center;">Document Status</th>
                                                        <th style="text-align:center;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <!-- Rows will be populated here via JavaScript -->
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

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Under Renewl Process</h4>

                            </div><!-- end card header -->

                            <div class="card-body px-0">
                                <div class="px-3" data-simplebar style="max-height: 352px;">
                                    <ul class="list-unstyled activity-wid mb-0">



                                        <li class="activity-list activity-border">
                                            <div class="activity-icon avatar-md">
                                                <span class="avatar-title  bg-primary-subtle text-primary rounded-circle">
                                                    <i class="mdi mdi-ethereum font-size-24"></i>
                                                </span>
                                            </div>
                                            <div class="timeline-list-item">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 overflow-hidden me-4">

                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100" style="width: 75%"></div>
                                                        </div>

                                                    </div>

                                                    <div class="flex-shrink-0 text-end me-3">
                                                        <h6 class="mb-1">Document Name</h6>
                                                        <div class="font-size-13">Company or Employee Name</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div><!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



    </div>

    <div>
        <div class="modal  fade employee_modal" id="employee_modal2" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">employee Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add_employee_status" id="add_employee_status" method="POST" action="#">
                            @csrf
                            <input type="hidden" class="employee_company">
                            <div class="mb-3">
                                <label for="expiry_date" class="col-form-label ">Old Expiry Date</label>
                                <input type="text" class="expiry_date form-control" name="expiry_date" id="expiry_date" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="new_expiry" class="col-form-label ">New Expiry DATE</label>
                                <input type="date" class="new_expiry form-control" name="new_expiry" id="new_expiry">
                            </div>
                            {{-- new --}}
                            <div class="mb-3">
                                <label for="choices-single-groups" class="form-label font-size-13" >Document Status
                                    </label>
                                <select class="doc_status form-control" searchable  name="doc_status"
                                    id="choices-single-groups">
                                    <option value="">Document Statsu</option>
                                    <option value="1">UNDER PROCESS</option>
                                    <option value="2">Recieved</option>
                                    <option value="3">Some Issue</option>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Renewl Notes</label>
                                <textarea class="renewl_note form-control" class="renewl_note" name="renewl_note" id="renewl_note"></textarea>
                            </div>

                            {{-- endnew  --}}
                            <input type="text" class="employee_id" name="employee_id" id="employee_id" hidden>
                            <input type="text" class="document_id" name="document_id" id="document_id" hidden>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    @include('layouts.footer')
@endsection
