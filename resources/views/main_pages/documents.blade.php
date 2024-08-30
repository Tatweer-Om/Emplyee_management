@extends('layouts.header')
@section('main')
    @push('title')
        <title> المستندات </title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- بداية عنوان الصفحة -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">قائمة المستندات</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">المستندات</a></li>
                                    <li class="breadcrumb-item active">قائمة المستندات</li>
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
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="mb-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#document_modal"><i
                                                class="bx bx-plus me-1"></i> إضافة مستند</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- نهاية الصف -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_document">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align:center;">الرقم التسلسلي</th>
                                                <th  style="text-align:center;">اسم المستند</th>
                                                <th  style="text-align:center;">نوع المستند</th>
                                                <th style="text-align:center;">تفاصيل المستند</th>
                                                <th  style="text-align:center;">أضيف بواسطة</th>
                                                <th  style="text-align:center;">الإجراءات</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                                <!-- نهاية الجدول القابل للاستجابة -->
                            </div>
                            <!-- نهاية محتوى البطاقة -->
                        </div>
                        <!-- نهاية البطاقة -->
                    </div>
                    <!-- نهاية العمود -->
                </div>
                <!-- نهاية الصف -->
            </div> <!-- نهاية الحاوية -->
        </div>

        <div>
            <div class="modal fade document_modal" id="document_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">نموذج المستندات</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_document" id="add_document" method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label for="document_name" class="col-form-label ">اسم المستند</label>
                                    <input type="text" class="document_name form-control" name="document_name" id="document_name">
                                </div>


                                <div class="mb-3">

                                        <label for="choices-single-groups" class="form-label font-size-13"> نوع المستند</label>
                                        <select class="document_type form-control" name="document_type">
                                            <option value="">اختر مستند</option>
                                            <option value="1">مستندات الشركة</option>
                                            <option value="2">مستندات الموظف</option>

                                        </select>

                                </div>

                                <input type="text" class="document_id" name="document_id" hidden>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">تفاصيل المستند</label>
                                    <textarea class="document_detail form-control" class="document_detail" name="document_detail" id="document_detail"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                </div>
                            </form>
                        </div>

                    </div><!-- /.محتوى-النموذج -->
                </div><!-- /.حوار-النموذج -->
            </div><!-- /.النموذج -->
        </div>

        @include('layouts.footer')
    @endsection
