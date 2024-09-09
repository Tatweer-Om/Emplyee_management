@extends('layouts.header')
@section('main')
    @push('title')
        <title>المستندات المنتهية الصلاحية</title>
    @endpush

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">المستندات المنتهية الصلاحية</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">المستندات المنتهية الصلاحية</a></li>
                                    <li class="breadcrumb-item active">المستندات المنتهية الصلاحية</li>
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
                                    <table class="table align-middle dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_expired_documents">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="text-align: right;">الرقم</th>
                                                <th style="text-align: right; width: 20px;">الشركة أو الموظف</th>
                                                <th style="text-align: right;">مستخدم المكتب</th>
                                                <th style="text-align: right;">اسم الوثيقة</th>
                                                <th style="text-align: right;">تاريخ انتهاء الصلاحية</th>
                                                <th style="text-align: right;">الحالة</th>
                                                <th style="text-align: right;">تاريخ الإضافة</th>
                                                <th style="text-align: right; width: 20px;">الإجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be populated here via JavaScript -->
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

        <div class="modal fade renew_modal" id="renew_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">تجديد الوثيقة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add_employee_status" id="add_employee_status" method="POST" action="#">
                            @csrf
                            <input type="hidden" class="docs_id" name="docs_id">
                            <input type="hidden" class="docs_type" name="docs_type">
                            <div class="mb-3">
                                <label for="new_expiry" class="col-form-label">تاريخ انتهاء الصلاحية الجديد</label>
                                <input type="date" class="new_expiry form-control" name="new_expiry" id="new_expiry">
                            </div>
                            <div class="mb-3">
                                <label for="renewl_note" class="col-form-label">ملاحظات التجديد</label>
                                <textarea class="renewl_note form-control" name="renewl_note" id="renewl_note"></textarea>
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

        @include('layouts.footer')
    @endsection
