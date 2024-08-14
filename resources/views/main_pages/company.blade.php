@extends('layouts.header')
@section('main')
    @push('title')
        <title> Company </title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Invoice List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                    <li class="breadcrumb-item active">Invoice List</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="mb-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#company_modal"><i
                                                class="bx bx-plus me-1"></i> Add Invoice</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-1 mb-4">
                                            <div class="input-group datepicker-range">
                                                <input type="text" class="form-control flatpickr-input" data-input
                                                    aria-describedby="date1">
                                                <button class="input-group-text" id="date1" data-toggle><i
                                                        class="bx bx-calendar-event"></i></button>
                                            </div>
                                            <div class="dropdown">
                                                <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle"
                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_company">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align: right;">Sr.No</th>
                                                <th style="text-align: right; width: 20px;">Company Name</th>
                                                <th style="text-align: right;">Company Contact</th>
                                                <th style="text-align: right;">Office User</th>
                                                <th style="text-align: right;">Company Detail</th>
                                                <th style="text-align: right;">Cr No.</th>
                                                <th style="text-align: right; width: 20px;">Added By</th>
                                                <th style="text-align: right; width: 20px;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
{{--
                                            <tr>
                                                <td>
                                                    <div class="form-check font-size-16">
                                                        <input type="checkbox" class="form-check-input">
                                                        <label class="form-check-label"></label>
                                                    </div>
                                                </td>

                                                <td><a href="javascript: void(0);" class="text-body fw-medium">#MN0215</a>
                                                </td>
                                                <td>
                                                    12 Oct, 2020
                                                </td>
                                                <td>Connie Franco</td>

                                                <td>
                                                    $26.30
                                                </td>
                                                <td>
                                                    <div class="badge badge-soft-success font-size-12">Paid</div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button type="button"
                                                            class="btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light"><i
                                                                class="bx bx-download label-icon"></i> Pdf</button>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                                            <li><a class="dropdown-item" href="#">Print</a></li>
                                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr> --}}

                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table responsive -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>

        <div>
            <div class="modal fade company_modal" id="company_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Company Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_company" id="add_company" method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label for="company_name" class="col-form-label ">Company Name</label>
                                    <input type="text" class="company_name form-control" name="company_name" id="company_name">
                                </div>
                                {{-- new --}}
                                <div class="mb-3">
                                    <label for="choices-single-groups" class="form-label font-size-13 text-muted">Option
                                        groups</label>
                                    <select class="office_user form-control" searchable  name="office_user"
                                        id="choices-single-groups">
                                        <option value="">Choose a User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->user_name ?? ''}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- endnew  --}}
                                <input type="text" class="company_id" name="company_id" id="company_id" hidden>
                                <div class="mb-3">
                                    <label for="company_email" class="col-form-label company_email">Company Email</label>
                                    <input type="text" class="company_email form-control" name="company_email" id="company_email">
                                </div>
                                <div class="mb-3">
                                    <label for="company_phone" class="col-form-label company_phone">Company Phone</label>
                                    <input type="text" class="company_phone form-control" name="company_phone" id="company_phone">
                                </div>
                                <div class="mb-3">
                                    <label for="company_address" class="col-form-label company_address">Company
                                        Address</label>
                                    <input type="text" class="company_address form-control" name="company_address"
                                        id="company_address">
                                </div>
                                <div class="mb-3">
                                    <label for="cr_no" class="col-form-label cr_no">CR No.</label>
                                    <input type="text" class="cr_no form-control" name="cr_no" id="cr_no">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Company Detail</label>
                                    <textarea class="company_detail form-control" class="company_detail" name="company_detail" id="company_detail"></textarea>
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
