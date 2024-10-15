@extends('layouts.header')
@section('main')
    @push('title')
        <title>الإجازة</title>
    @endpush
    <style>
        .green-row {
    background-color: #d4edda !important; /* Light green background */
}
    </style>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"> الإجازة</h4>

                            <div class="page-title-center">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">الإجازة</a></li>
                                    <li class="breadcrumb-item active"> الإجازة</li>
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

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_leaves">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align: right;">رقم</th>
                                                <th style="text-align: right;">تفاصيل الموظف</th>
                                                <th style="text-align: right;">الإجازات</th>
                                                <th style="text-align: right;">سبب الإجازات</th>
                                                <th style="text-align: right;">تفاصيل الإجازة</th>
                                                <th style="text-align: center;">إجراء</th>

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

        <div class="modal modal-xl fade employee_leave_history" id="employee_leave_history" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">سجل الإجازات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <table class="table align-middle dt-responsive table-check nowrap"
                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="leaves_history">
                        <thead>
                            <tr class="bg-transparent">
                                <th style="width: 30px; text-align:center;">الرقم</th>
                                <th style="text-align:center;">تفاصيل الموظف</th>
                                <th style="text-align:center;">حالة الإجازة</th>
                                <th style="text-align:center;">حالة الموافقة</th>
                                <th style="text-align:center;">الإجازات المقدمة</th>
                                <th style="text-align:center;"> إجراء</th>

                            </tr>
                        </thead>
                        <tbody id="leaves_history_body">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <div class="modal modal-md fade action" id="action" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">حالة الإجازة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="leave_id" name="leave_id" value="">
                    <button type="button" class="btn btn-success" id="approveButton">الموافقة</button>
                    <button type="button" class="btn btn-danger" id="rejectButton">رفض</button>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">السبب:</label>
                        <textarea class="notes form-control" name="notes" id="notes"></textarea>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


        @include('layouts.footer')
    @endsection
