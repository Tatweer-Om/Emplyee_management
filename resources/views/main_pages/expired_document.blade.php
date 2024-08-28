@extends('layouts.header')
@section('main')
    @push('title')
        <title>Companies </title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Expired Documents</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Expired Documents</a></li>
                                    <li class="breadcrumb-item active">Expired Documents</li>
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
                                 
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_expired_documents">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align: right;">Sr.No</th>
                                                <th style="text-align: right; width: 20px;">Company Name</th>
                                                <th style="text-align: right;">Employee Name</th>
                                                <th style="text-align: right;">Office User</th>
                                                <th style="text-align: right;">Document Name</th>
                                                <th style="text-align: right;">Expiry Date</th>
                                                <th style="text-align: right;">Status</th>
                                                <th style="text-align: right;">Add Date</th>
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

        <div class="modal  fade employee_modal" id="renew_modal" tabindex="-1" role="dialog"
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
                            <input type="hidden" class="docs_id" name="docs_id">
                            <input type="hidden" class="docs_type" name="docs_type">
                            <div class="mb-3">
                                <label for="new_expiry" class="col-form-label ">New Expiry DATE</label>
                                <input type="date" class="new_expiry form-control" name="new_expiry" id="new_expiry">
                            </div>
                            {{-- new --}}
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Document Name</label>
                                <input class="form-control doc_name" name="doc_name" id="doc_name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Renewl Notes</label>
                                <textarea class="renewl_note form-control" class="renewl_note" name="renewl_note" id="renewl_note"></textarea>
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


        


        @include('layouts.footer')
    @endsection
