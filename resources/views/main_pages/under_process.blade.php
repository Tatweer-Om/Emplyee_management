@extends('layouts.header')
@section('main')
    @push('title')
        <title>تحت المعالجة</title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- بداية عنوان الصفحة -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">المستندات منتهية الصلاحية</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">المستندات منتهية الصلاحية</a></li>
                                    <li class="breadcrumb-item active">المستندات منتهية الصلاحية</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- نهاية عنوان الصفحة -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- نهاية الصف -->

                                <div class="table-responsive">
                                    <table class="table align-middle dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_expired_documents2">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align: center;">رقم سري</th>
                                                <th style="text-align: center; width: 20px;">الشركة أو الموظف</th>
                                                <th style="text-align: center;">المستخدم في المكتب</th>
                                                <th style="text-align: center;">اسم المستند</th>
                                                <th style="text-align: center;">تاريخ الانتهاء</th>
                                                <th style="text-align: center;">تاريخ الإضافة</th>
                                                <th style="text-align: center; width: 20px;">إجراء</th>

                                            </tr>
                                        </thead>
                                        <tbody>



                                        </tbody>
                                    </table>
                                </div>
                                <!-- نهاية الجدول القابل للتكيف -->
                            </div>
                            <!-- نهاية جسم البطاقة -->
                        </div>
                        <!-- نهاية البطاقة -->
                    </div>
                    <!-- نهاية العمود -->
                </div>
                <!-- نهاية الصف -->
            </div> <!-- container-fluid -->
        </div>

        <div class="modal fade employee_modal" id="renew_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">نموذج التجديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="add_employee_status2" id="add_employee_status2" method="POST" action="#">
                            @csrf
                            <input type="hidden" class="docs_id" name="docs_id">
                            <input type="hidden" class="docs_type" name="docs_type">
                            <div class="mb-3">
                                <label for="new_expiry" class="col-form-label">تاريخ انتهاء الصلاحية الجديد</label>
                                <input type="date" class="new_expiry form-control" name="new_expiry" id="new_expiry">
                            </div>
                            {{-- جديد --}}



                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">ملاحظات التجديد</label>
                                <textarea class="renewl_note form-control" name="renewl_note" id="renewl_note"></textarea>
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





        @include('layouts.footer')
    @endsection
