@extends('layouts.header')
@section('main')
    @push('title')
        <title>الشركات</title>
    @endpush

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">قائمة الشركات</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">الشركات</a></li>
                                    <li class="breadcrumb-item active">قائمة الشركات</li>
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
                                                data-bs-toggle="modal" data-bs-target="#employee_leave_history"><i
                                                class="bx bx-plus me-1"></i> إضافة شركة</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_company">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align: right;">رقم</th>
                                                <th style="text-align: right; width: 20px;">Employee Name</th>
                                                <th style="text-align: right;">Holidays</th>
                                                <th style="text-align: right;">Holidays Gained</th>
                                                <th style="text-align: right; width: 20px;">إجراء</th>


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
            <div class="modal modal-lg fade employee_leave_history" id="employee_leave_history" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Leaves History </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table align-middle dt-responsive table-check nowrap"
                            style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_profile_docs">
                            <thead>
                                <tr class="bg-transparent">
                                    <th style="width: 30px; text-align:center;">الرقم</th>
                                    <th style="text-align:center;"> Leave Type</th>
                                    <th style="text-align:center;">Dates </th>
                                    <th style="text-align:center;"> Balance</th>
                                    <th style="text-align:center;"> Approved By</th>
                                    <th style="text-align:center;"> Action</th>
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


        <div>
            <div class="modal  fade employee_modal" id="employee_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">نافذة الموظف</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_employee" id="add_employee" method="POST" action="#">
                                @csrf
                                <input type="hidden" class="employee_company" name="employee_company">
                                <div class="mb-3">
                                    <label for="employee_name" class="col-form-label ">اسم الموظف</label>
                                    <input type="text" class="employee_name form-control" name="employee_name" id="employee_name">
                                </div>
                                {{-- new --}}
                                {{-- <div class="mb-3">
                                    <label for="choices-single-groups" class="form-label font-size-13" hidden>الشركات</label>
                                    <select class="employee_company form-control" searchable name="employee_company" hidden
                                        id="choices-single-groups">
                                        <option value="">اختر الشركة</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name ?? ''}}</option>
                                        @endforeach

                                    </select>
                                </div> --}}

                                {{-- endnew --}}
                                <input type="text" class="employee_id" name="employee_id" id="employee_id" hidden>
                                <div class="mb-3">
                                    <label for="employee_email" class="col-form-label employee_email">بريد الموظف الإلكتروني</label>
                                    <input type="text" class="employee_email form-control" name="employee_email" id="employee_email">
                                </div>
                                <div class="mb-3">
                                    <label for="employee_phone" class="col-form-label employee_phone">رقم هاتف الموظف</label>
                                    <input type="text" class="employee_phone form-control" name="employee_phone" id="employee_phone">
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">تفاصيل الموظف</label>
                                    <textarea class="employee_detail form-control" name="employee_detail" id="employee_detail"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                </div>
                            </form>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

        @include('layouts.footer')
    @endsection
