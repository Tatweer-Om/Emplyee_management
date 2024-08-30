@extends('layouts.header')
@section('main')
    @push('title')
        <title>الملف الشخصي للشركة</title>
    @endpush

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">الملف الشخصي للشركة</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('company') }}">الملف الشخصي للشركة</a></li>
                                    <li class="breadcrumb-item active"><a href="{{ url('company') }}">الشركات</a></li>
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
                                                <h4 class="float-end font-size-16">رقم الشركة-{{ $company->id ?? '' }}</h4>
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
                                        <h4 class="card-title mb-0 flex-grow-1">مستندات الشركة والموظفين</h4>
                                        <div class="flex-shrink-0">
                                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs"
                                                role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#home2"
                                                        role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">مستندات الموظفين</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile2"
                                                        role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">مستندات الشركة</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile3"
                                                        role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">جميع الموظفين</span>
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
                                                    <h5 class="mb-3">مستندات الموظفين التي تحتاج إلى تجديد</h5>
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
                                                                <th style="width: 120px; text-align:center;">رقم</th>
                                                                <th style="text-align:center;">اسم الموظف</th>
                                                                <th style="text-align:center;">مستندات الموظف</th>
                                                                <th style="text-align:center;">تاريخ الإضافة</th>
                                                                <th style="text-align:center;">مستخدم المكتب</th>
                                                                <th style="text-align:center;">الإجراء</th>
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
                                                                    12 أكتوبر، 2020
                                                                </td>
                                                                <td>كوني فرانكو</td>

                                                                <td>
                                                                    $26.30
                                                                </td>
                                                                <td>
                                                                    <div class="badge badge-soft-success font-size-12">مدفوع
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
                                                                                    href="#">تعديل</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">طباعة</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">حذف</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr> --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile2" role="tabpanel">
                                                <a href="{{ url('document_addition').'/'.$company->id }}" class="btn btn-success">إضافة مستندات</a>
                                                <div class="table-responsive">
                                                    <table class="table align-middle dt-responsive table-check nowrap"
                                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_profile_docs">
                                                        <thead>
                                                            <tr class="bg-transparent">
                                                                <th style="width: 120px; text-align:center;">رقم</th>
                                                                <th style="text-align:center;">اسم المستند</th>
                                                                <th style="text-align:center;">تاريخ الانتهاء</th>
                                                                <th style="text-align:center;">فترة التجديد</th>
                                                                <th style="text-align:center;">تاريخ الإضافة</th>
                                                                <th style="text-align:center;">مستخدم المكتب</th>
                                                                <th style="text-align:center;">الإجراء</th>
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
                                                                    12 أكتوبر، 2020
                                                                </td>
                                                                <td>كوني فرانكو</td>

                                                                <td>
                                                                    $26.30
                                                                </td>
                                                                <td>
                                                                    <div class="badge badge-soft-success font-size-12">مدفوع
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
                                                                                    href="#">تعديل</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">طباعة</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#">حذف</a></li>
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
                                    <h5 class="mb-3">تفاصيل الشركة</h5>
                                    <ul class="list-unstyled fw-medium px-2">
                                        <li>
                                            <a href="javascript: void(0);" class="text-body pb-3 d-block border-bottom">
                                                موظفو الشركة
                                                <span id="employees-count" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                مستندات الشركة
                                                <span id="company-docs-count" class="badge bg-primary-subtle text-primary rounded-pill float-end ms-1 font-size-12"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);" class="text-body py-3 d-block border-bottom">
                                                مستندات الموظفين
                                                <span id="employee-docs-count" class="badge bg-primary-subtle text-primary rounded-pill ms-1 float-end font-size-12"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-5">
                                    <h5 class="mb-3">مستندات الموظفين التي تحتاج إلى تجديد</h5>
                                    <div id="renewal-docs-list" class="list-group list-group-flush">
                                        <!-- سيتم إضافة العناصر هنا ديناميكيًا -->
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
        <div class="modal fade employee_modal" id="employee_modal" tabindex="-1" role="dialog"
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
                            <div class="mb-3">
                                <label for="employee_name" class="col-form-label">اسم الموظف</label>
                                <input type="text" class="employee_name form-control" name="employee_name" id="employee_name">
                            </div>

                            {{-- endnew --}}
                            <input type="text" class="employee_id" name="employee_id" id="employee_id" hidden>
                            <div class="mb-3">
                                <label for="employee_email" class="col-form-label employee_email">بريد الموظف الإلكتروني</label>
                                <input type="text" class="employee_email form-control" name="employee_email" id="employee_email">
                            </div>
                            <div class="mb-3">
                                <label for="employee_phone" class="col-form-label employee_phone">هاتف الموظف</label>
                                <input type="text" class="employee_phone form-control" name="employee_phone" id="employee_phone">
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">تفاصيل الموظف</label>
                                <textarea class="employee_detail form-control" name="employee_detail" id="employee_detail"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    @include('layouts.footer')
@endsection
