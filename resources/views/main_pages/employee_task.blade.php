@extends('layouts.header')
@section('main')
    @push('title')
    <title>المهام</title>
    @endpush


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{ $user->user_name ?? '' }}</h4>
                            <input type="hidden" class="user_id" value="{{ $user->id ?? '' }}" hidden>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a
                                            href="javascript: void(0);">{{ $user->user_name ?? '' }}</a></li>
                                    <li class="breadcrumb-item active">الموظف</li>
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
                                    <h5 class="card-title me-2">تفاصيل شخصية</h5>
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
                                                    التفاصيل العامة</p>
                                                <h6> اسم الموظف - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->user_name ?? '' }}</span>
                                                </h6>

                                                <h6>رقم الموظف - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->id ?? '' }}</span>
                                                </h6>
                                                <h6>فرع الموظف - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $branch_name ?? '' }}</span>
                                                </h6>
                                                <h6>نوع المستخدم - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user_type ?? '' }}</span>
                                                </h6>
                                                <h6>الهاتف - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->user_phone ?? '' }}
                                                    </span></h6>
                                                <h6> البريد الإلكتروني - <span
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
                                            <h5 class="card-title me-2">{{ $user->user_name ?? '' }} المهام</h5>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-sm">
                                                <div id="invested-overview" data-colors='["#5156be", "#34c38f"]'
                                                    class="apex-charts"></div>
                                            </div>
                                            <div class="col-sm align-self-center">
                                                <div class="mt-4 mt-sm-0">
                                                    <p class="mb-1">إجمالي الموظفين</p>
                                                    <h4 id="total-employees"> </h4>

                                                    <p class="text-muted mb-4" id="employee-docs"> مستندات الموظفين</p>

                                                    <div class="row g-0">
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">إجمالي الشركات</p>
                                                                <h5 class="fw-medium" id="total-companies"> </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">مستندات الشركة</p>
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
                </div>
                 <!-- end row-->


                <!-- end row-->

                <div class="row">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">المستندات</h4>
                                <div class="flex-shrink-0">
                                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab"
                                                role="tab">
                                                مستندات الشركة
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#transactions-buy-tab"
                                                role="tab">
                                                مستندات الموظف
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body px-0">
                                <div class="tab-content">
                                    <!-- end tab pane -->
                                    <div class="tab-pane show active" id="transactions-all-tab" role="tabpanel">
                                        {{-- <a href="#" class="btn btn-success" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#company_modal5">إضافة شركة</a> <br><br> --}}
                                        <div class="table-responsive">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                                style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;"
                                                id="company_table">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 30px; text-align:center;">الرقم</th>
                                                        <th style="text-align:center;">الشركة</th>
                                                        <th style="text-align:center;">وثيقة</th>
                                                        <th style="text-align:center;">الحالة</th>
                                                        <th style="width: 30px; text-align:center;">الإجراء</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Rows will be populated here via JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="transactions-buy-tab" role="tabpanel">
                                        <a href="#" class="btn btn-success" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#employee_modal4">إضافة موظف</a> <br><br>
                                        <div class="table-responsive">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                                style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;"
                                                id="employee_table">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 30px; text-align:center;">الرقم</th>
                                                        <th style="text-align:center;">الموظف</th>
                                                        <th style="text-align:center;">وثائق</th>
                                                        <th style="text-align:center;">الحالة</th>
                                                        <th style="width: 30px; text-align:center;">الإجراء</th>
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
                                <h4 class="card-title mb-0 flex-grow-1">تحت عملية التجديد</h4>
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
        <div class="modal modal-lg fade employee_modal2" id="employee_modal2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">سجل الوثائق</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <table class="table align-middle dt-responsive table-check nowrap"
                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_profile_docs">
                        <thead>
                            <tr class="bg-transparent">
                                <th style="width: 30px; text-align:center;">الرقم</th>
                                <th style="text-align:center;">تفاصيل الوثيقة</th>
                                <th style="text-align:center;">حالة تاريخ الانتهاء</th>
                                <th style="text-align:center;">حالة التجديد</th>
                                <th style="text-align:center;">ملاحظات التجديد</th>
                                <th style="text-align:center;">تاريخ الإضافة</th>
                                <th style="text-align:center;">مستخدم المكتب</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be populated here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </div>


    <div>
        <div class="modal fade company_modal5" id="company_modal5" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">نافذة الشركة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <form class="add_company2" id="add_company2" method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="company_name" class="col-form-label">اسم الشركة</label>
                            <input type="text" class="company_name form-control" name="company_name" id="company_name">
                        </div>

                        <input type="text" class="company_id" name="company_id" id="company_id" hidden>
                        <div class="mb-3">
                            <label for="company_email" class="col-form-label">بريد الشركة الإلكتروني</label>
                            <input type="text" class="company_email form-control" name="company_email" id="company_email">
                        </div>
                        <div class="mb-3">
                            <label for="company_phone" class="col-form-label">رقم هاتف الشركة</label>
                            <input type="text" class="company_phone form-control" name="company_phone" id="company_phone">
                        </div>
                        <div class="mb-3">
                            <label for="company_address" class="col-form-label">عنوان الشركة</label>
                            <input type="text" class="company_address form-control" name="company_address" id="company_address">
                        </div>
                        <div class="mb-3">
                            <label for="cr_no" class="col-form-label">رقم السجل التجاري</label>
                            <input type="text" class="cr_no form-control" name="cr_no" id="cr_no">
                        </div>
                        <div class="mb-3">
                            <label for="company_detail" class="col-form-label">تفاصيل الشركة</label>
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
    </div>
    <!-- /.modal -->
    </div>


    <div>
        <div class="modal  fade employee_modal4" id="employee_modal4" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">نافذة الموظف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add_employee4" id="add_employee4" method="POST" action="#">
                            @csrf
                            <div class="mb-3">
                                <label for="employee_name" class="col-form-label ">اسم الموظف</label>
                                <input type="text" class="employee_name form-control" name="employee_name" id="employee_name">
                            </div>
                            {{-- new --}}
                            <div class="mb-3">
                                <label for="choices-single-groups" class="form-label font-size-13">الشركات</label>
                                <select class="employee_company searchable_select select2 form-control" searchable name="employee_company" id="choices-single-groups">
                                    <option value="">اختر الشركة</option>
                                    @foreach($comps as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name ?? 'غير متوفر' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- endnew  --}}
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
                                <textarea class="employee_detail form-control" class="employee_detail" name="employee_detail" id="employee_detail"></textarea>
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


    <div class="modal fade renew_modal" id="renew_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">تجديد الوثيقة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



    @include('layouts.footer')
@endsection
