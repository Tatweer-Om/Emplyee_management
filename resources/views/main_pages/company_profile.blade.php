@extends('layouts.header')
@section('main')
    @push('title')
        <title> Company Profile </title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Company Profile</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('company') }}">Company Profile</a></li>
                                    <li class="breadcrumb-item active"><a href="{{ url('company') }}">Companies</a></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="mb-4">
                                                <img src="{{ asset('images/logo-sm.svg') }}" alt=""
                                                    height="24"><span class="logo-txt">
                                                    {{ $company->company_name ?? '' }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="mb-4">

                                                <h4 class="float-end font-size-16">Company ID-{{ $company->id ?? '' }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mb-1">{{ $company->company_address }}</p>
                                    <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i>
                                        {{ $company->company_email ?? '' }}</p>
                                    <p><i class="mdi mdi-phone align-middle me-1"></i> {{ $company->company_phone ?? '' }}
                                    </p>
                                </div>
                                <hr class="my-4">



                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Company and Employees Documents</h4>
                                        <div class="flex-shrink-0">
                                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs"
                                                role="tablist">


                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#home2"
                                                        role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Employee Documents</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile2"
                                                        role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">Company Documents</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile3"
                                                        role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">All Employees</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">

                                        <!-- Tab panes -->
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active" id="home2" role="tabpanel">

                                                <div class="mt-5">

                                                    <h5 class="mb-3">Employees Documents to be Renewed</h5>
                                                    {{-- <div class="row">
                                                        <div class="col-lg-4">
                                                            <div
                                                                class="list-group list-group-flush border border-primary rounded">
                                                                <a href="javascript: void(0);"
                                                                    class="list-group-item text-muted pb-3 pt-0 px-2">
                                                                    <div class="d-flex align-items-center">

                                                                        <div class="flex-grow-1 overflow-hidden">
                                                                            <h5 class="font-size-13 text-truncate">Umair
                                                                                Shahnawaz</h5>
                                                                            <p class="mb-0 text-truncate">Passport-Expiry
                                                                                <span
                                                                                    class="badge bg-danger-subtle text-primary rounded-pill ms-1 float-end font-size-13">3
                                                                                    months left</span>
                                                                            </p>
                                                                            <p class="mb-0 text-truncate">ID Card-expiry
                                                                                <span
                                                                                    class="badge bg-danger-subtle text-primary rounded-pill ms-1 float-end font-size-13">3
                                                                                    months left</span>
                                                                            </p>
                                                                        </div>

                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="row" id="employee_docs_list">

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile3" role="tabpanel">
                                                {{-- <a href="#" class="btn btn-success"  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#employee_modal" onclick="add_employee(' . $company->id . ')">Add Employee</a> <br><br> --}}
                                                <div class="table-responsive">

                                                    <table class="table align-middle dt-responsive table-check nowrap"
                                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_company_employee">
                                                        <thead>

                                                            <tr class="bg-transparent">
                                                                <th style="width: 120px; text-align:center;">Sr.No </th>
                                                                <th style=" text-align:center;">Employee Name</th>
                                                                <th style=" text-align:center;">Employee Documents</th>
                                                                <th style=" text-align:center;">Added On</th>
                                                                <th style=" text-align:center;">Office User</th>
                                                                <th style=" text-align:center;">Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            {{-- <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16">
                                                                        <input type="checkbox" class="form-check-input">
                                                                        <label class="form-check-label"></label>
                                                                    </div>
                                                                </td>

                                                                <td><a href="javascript: void(0);"
                                                                        class="text-body fw-medium">#MN0215</a> </td>
                                                                <td>
                                                                    12 Oct, 2020
                                                                </td>
                                                                <td>Connie Franco</td>

                                                                <td>
                                                                    $26.30
                                                                </td>
                                                                <td>
                                                                    <div class="badge badge-soft-success font-size-12">Paid
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <button type="button"
                                                                            class="btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light"><i
                                                                                class="bx bx-download label-icon"></i>
                                                                            Pdf</button>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">Edit</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">Print</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr> --}}



                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile2" role="tabpanel">
                                                <a href="{{ url('document_addition').'/'.$company->id }}" class="btn btn-success">Add Documents</a>
                                                <div class="table-responsive">
                                                    <table class="table align-middle dt-responsive table-check nowrap"
                                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_profile_docs">
                                                        <thead>
                                                            <tr class="bg-transparent">
                                                                <th style="width: 120px; text-align:center;">Sr.No </th>
                                                                <th style=" text-align:center;">Document Name</th>
                                                                <th style=" text-align:center;">Expiry Date</th>
                                                                <th style=" text-align:center;">Renewel Period</th>
                                                                <th style=" text-align:center;">Added On</th>
                                                                <th style=" text-align:center;">Office User</th>
                                                                <th style=" text-align:center;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            {{-- <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16">
                                                                        <input type="checkbox" class="form-check-input">
                                                                        <label class="form-check-label"></label>
                                                                    </div>
                                                                </td>

                                                                <td><a href="javascript: void(0);"
                                                                        class="text-body fw-medium">#MN0215</a> </td>
                                                                <td>
                                                                    12 Oct, 2020
                                                                </td>
                                                                <td>Connie Franco</td>

                                                                <td>
                                                                    $26.30
                                                                </td>
                                                                <td>
                                                                    <div class="badge badge-soft-success font-size-12">Paid
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <button type="button"
                                                                            class="btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light"><i
                                                                                class="bx bx-download label-icon"></i>
                                                                            Pdf</button>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">Edit</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">Print</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr> --}}



                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">

                                <div class="mt-5">
                                    <h5 class="mb-3">Company's Detail</h5>
                                    <ul class="list-unstyled fw-medium px-2">
                                        <li>
                                            <a href="javascript: void(0);" class="text-body pb-3 d-block border-bottom">
                                                Company's Employees
                                                <span id="employees-count" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                Company's Documents
                                                <span id="company-docs-count" class="badge bg-primary-subtle text-primary rounded-pill float-end ms-1 font-size-12"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                Employees Documents
                                                <span id="employee-docs-count" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-5">
                                    <h5 class="mb-3">Employees Documents to be Renewed</h5>
                                    <div id="renewal-docs-list" class="list-group list-group-flush">
                                        <!-- List items will be added here dynamically -->
                                    </div>
                                </div>






                            </div>

                        </div> <!-- end card -->
                    </div>


                </div>

            </div>
            <!-- end row -->
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>



    <div>
        <div class="modal  fade employee_modal" id="employee_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">employee Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add_employee" id="add_employee" method="POST" action="#">
                            @csrf
                            <div class="mb-3">
                                <label for="employee_name" class="col-form-label ">employee Name</label>
                                <input type="text" class="employee_name form-control" name="employee_name" id="employee_name">
                            </div>
                            {{-- new --}}
                            {{-- <div class="mb-3">
                                <label for="choices-single-groups" class="form-label font-size-13" hidden>Companies
                                    </label>
                                <select class="employee_company form-control" searchable  name="employee_company" hidden
                                    id="choices-single-groups">
                                    <option value="">Choose Company</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name ?? ''}}</option>
                                    @endforeach

                                </select>
                            </div> --}}

                            {{-- endnew  --}}
                            <input type="text" class="employee_id" name="employee_id" id="employee_id" hidden>
                            <div class="mb-3">
                                <label for="employee_email" class="col-form-label employee_email">employee Email</label>
                                <input type="text" class="employee_email form-control" name="employee_email" id="employee_email">
                            </div>
                            <div class="mb-3">
                                <label for="employee_phone" class="col-form-label employee_phone">employee Phone</label>
                                <input type="text" class="employee_phone form-control" name="employee_phone" id="employee_phone">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">employee Detail</label>
                                <textarea class="employee_detail form-control" class="employee_detail" name="employee_detail" id="employee_detail"></textarea>
                            </div>
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
