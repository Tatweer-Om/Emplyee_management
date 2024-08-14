@extends('layouts.header')
@section('main')
    @push('title')
        <title> document </title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">document List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">documents</a></li>
                                    <li class="breadcrumb-item active">document List</li>
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
                                                data-bs-toggle="modal" data-bs-target="#document_modal"><i
                                                class="bx bx-plus me-1"></i> Add document</button>
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
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_document">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align:right;">Sr.No</th>
                                                <th  style="text-align:center;">document Name</th>

                                                <th style="text-align:center;">document Detail</th>

                                                <th  style="text-align:center;">Added By</th>
                                                <th  style="text-align:center;">Action</th>

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
            <div class="modal fade document_modal" id="document_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">document Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_document" id="add_document" method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label for="document_name" class="col-form-label ">document Name</label>
                                    <input type="text" class="document_name form-control" name="document_name" id="document_name">
                                </div>

                                <input type="text" class="document_id" name="document_id" id="document_id" hidden>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">document Detail</label>
                                    <textarea class="document_detail form-control" class="document_detail" name="document_detail" id="document_detail"></textarea>
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
