@extends('layouts.header')
@section('main')
    @push('title')
        <title> user </title>
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
                                                data-bs-toggle="modal" data-bs-target="#user_modal"><i
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
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_user">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align: right;">Sr.No</th>
                                                <th style="text-align: right; width: 20px;">user Name</th>
                                                <th style="text-align: right;">user Phone</th>
                                                <th style="text-align: right;">user Detail</th>
                                                <th style="text-align: right;">user Type</th>

                                                <th style="text-align: right; width: 20px;">Added By</th>
                                                <th style="text-align: right; width: 20px;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>


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
            <div class="modal fade user_modal" id="user_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">user Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_user" id="add_user" method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label for="user_name" class="col-form-label ">user Name</label>
                                    <input type="text" class="user_name form-control" name="user_name" id="user_name">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="col-form-label ">Password</label>
                                    <input type="text" class="password form-control" name="password" id="password">
                                </div>
                                {{-- new --}}

                                <div class="mb-3">
                                    <label class="form-label font-size-13">Choose Branch</label>
                                    <select class="user_branch form-control" searchable name="user_branch"  >
                                        <option value="" >Choose Branch</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->branch_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label > Allow Access For All Branches </label> <br>
                                <input type="checkbox" class="user_all" id="switch6" switch="primary" name="user_all" checked />
                                <label for="switch6" data-on-label="Yes" data-off-label="No"> </label>

                                <div class="mb-3">
                                    <label class="form-label font-size-13">User Type</label>

                                    <select class="user_type form-control"  name="user_type"  >
                                        <option value="" >Choose User Type</option>

                                            <option value="1">admin</option>
                                            <option value="2">user</option>

                                    </select>
                                </div>


                                {{-- endnew  --}}
                                <input type="text" class="user_id" name="user_id" id="user_id" hidden>

                                <div class="mb-3">
                                    <label for="user_phone" class="col-form-label user_phone">user Phone</label>
                                    <input type="text" class="user_phone form-control" name="user_phone" id="user_phone">
                                </div>

                                <div class="mb-3">
                                    <label for="user_email" class="col-form-label user_email">user email</label>
                                    <input type="email" class="user_email form-control" name="user_email" id="user_email">
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">user Detail</label>
                                    <textarea class="user_detail form-control" class="user_detail" name="user_detail" id="user_detail"></textarea>
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
