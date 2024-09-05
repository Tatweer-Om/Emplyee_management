@extends('layouts.header')
@section('main')
    @push('title')
        <title>التعيينات</title>
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
                                    <li class="breadcrumb-item active">موظف</li>
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
                                    <h5 class="card-title me-2">التفاصيل الشخصية</h5>
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
                                                <h6>اسم الموظف - <span
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
                                                <h6>البريد الإلكتروني - <span
                                                        class="text-muted font-size-14 fw-normal">{{ $user->user_email ?? '' }}</span>
                                                </h6>
                                                <h6><span
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
                                            <h5 class="card-title me-2">مهام {{ $user->user_name ?? '' }}</h5>
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

                                                    <p class="text-muted mb-4" id="employee-docs">وثائق الموظفين</p>

                                                    <div class="row g-0">
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">إجمالي الشركات</p>
                                                                <h5 class="fw-medium" id="total-companies"> </h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div>
                                                                <p class="mb-2 text-muted text-uppercase font-size-11">وثائق الشركة</p>
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
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">الوثائق</h4>
                                <div class="flex-shrink-0">
                                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#transactions-all-tab"
                                                role="tab">
                                                وثائق الشركة
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#transactions-buy-tab"
                                                role="tab">
                                                وثائق الموظف
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body px-0">
                                <div class="tab-content">
                                    <div class="tab-pane" id="transactions-all-tab" role="tabpanel">
                                        <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#company_modal5">إضافة شركة</a><br><br>
                                        <div class="table-responsive">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                                style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;"
                                                id="company_table">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 120px; text-align:center;">الرقم التسلسلي</th>
                                                        <th style="text-align:center;">اسم الشركة</th>
                                                        <th style="text-align:center;">وثيقة الشركة</th>
                                                        <th style="text-align:center;">حالة الوثيقة</th>
                                                        <th style="text-align:center;">الإجراء</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- سيتم ملء الصفوف هنا بواسطة JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="transactions-buy-tab" role="tabpanel">
                                        <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#employee_modal4">إضافة موظف</a><br><br>
                                        <div class="table-responsive">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap"
                                                style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;"
                                                id="employee_table">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 120px; text-align:center;">الرقم</th>
                                                        <th style="text-align:center;">اسم الموظف</th>
                                                        <th style="text-align:center;">وثائق الموظف</th>
                                                        <th style="text-align:center;">حالة الوثيقة</th>
                                                        <th style="text-align:center;">الإجراء</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- سيتم ملء الصفوف هنا بواسطة JavaScript -->
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
                                <h4 class="card-title mb-0 flex-grow-1">في عملية التجديد</h4>
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
                <!-- end row-->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <div class="modal fade" id="company_modal5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="add_company2" id="add_company2">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFullscreenLabel">إضافة شركة جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name" class="form-label">اسم الشركة</label>
                                <input class="form-control name" type="text" id="name" placeholder="أدخل اسم الشركة">
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input class="form-control email" type="email" id="email" placeholder="أدخل البريد الإلكتروني">
                            </div>
                            <div class="col-md-12">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input class="form-control phone" type="tel" id="phone" placeholder="أدخل رقم الهاتف">
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">العنوان</label>
                                <input class="form-control address" type="text" id="address" placeholder="أدخل العنوان">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary save_btn">إضافة</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="employee_modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form class="add_employee_doc" id="add_employee_doc">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFullscreenLabel">إضافة وثيقة الموظف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>تاريخ انتهاء الصلاحية</th>
                                        <th>تمت التجديد</th>
                                        <th>ملاحظات التجديد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input class="form-control" type="date"></td>
                                        <td><input class="form-control" type="checkbox"></td>
                                        <td><input class="form-control" type="text"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary save_btn">إضافة</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    @endsection
