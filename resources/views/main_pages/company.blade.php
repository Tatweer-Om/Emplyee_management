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
                                                data-bs-toggle="modal" data-bs-target="#company_modal"><i
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
                                                <th style="text-align: right; width: 20px;">اسم الشركة</th>
                                                <th style="text-align: right;">تواصل الشركة</th>
                                                <th style="text-align: right;">مستخدم المكتب</th>
                                                <th style="text-align: right;">تفاصيل الشركة</th>
                                                <th style="text-align: right;">رقم السجل التجاري</th>
                                                <th style="text-align: right; width: 20px;">تاريخ الإضافة</th>
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
            <div class="modal fade company_modal" id="company_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">نافذة الشركة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_company" id="add_company" method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label for="company_name" class="col-form-label ">اسم الشركة</label>
                                    <input type="text" class="company_name form-control" name="company_name" id="company_name">
                                </div>

                                <input type="text" class="company_id" name="company_id" id="company_id" hidden>
                                <div class="mb-3">
                                    <label for="company_email" class="col-form-label company_email">بريد الشركة الإلكتروني</label>
                                    <input type="email" class="company_email form-control" name="company_email" id="company_email">
                                </div>
                                <div class="mb-3">
                                    <label for="company_phone" class="col-form-label company_phone">رقم هاتف الشركة</label>
                                    <input type="tel" class="company_phone form-control" name="company_phone" id="company_phone">
                                </div>
                                <div class="mb-3">
                                    <label for="company_address" class="col-form-label company_address">عنوان الشركة</label>
                                    <input type="text" class="company_address form-control" name="company_address"
                                        id="company_address">
                                </div>
                                <div class="mb-3">
                                    <label for="cr_no" class="col-form-label cr_no">رقم السجل التجاري</label>
                                    <input type="text" class="cr_no form-control" name="cr_no" id="cr_no">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label font-size-13">Assign Company </label>
                                    <select class="user form-control" searchable name="user">
                                        <option value="" > Choose A Employee</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->user_name ?? ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">تفاصيل الشركة</label>
                                    <textarea class="company_detail form-control" name="company_detail" id="company_detail"></textarea>
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
                                <input type="hidden" class="employee_company">
                                <div class="mb-3">
                                    <label for="employee_name" class="col-form-label ">اسم الموظف</label>
                                    <input type="text" class="employee_name form-control" name="employee_name" id="employee_name">
                                </div>
                                {{-- new --}}
                                <div class="mb-3">
                                    <label for="choices-single-groups" class="form-label font-size-13" hidden>الشركات</label>
                                    <select class="employee_company form-control" searchable name="employee_company" hidden
                                        id="choices-single-groups">
                                        <option value="">اختر الشركة</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name ?? ''}}</option>
                                        @endforeach

                                    </select>
                                </div>

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
