@extends('layouts.header')
@section('main')
    @push('title')
        <title>تفاصيل المكتب</title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- بداية عنوان الصفحة -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">تفاصيل المكتب</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">تفاصيل المكتب</a></li>
                                    <li class="breadcrumb-item active">جميع التفاصيل</li>
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
                                                data-bs-toggle="modal" data-bs-target="#about_modal"><i
                                                class="bx bx-plus me-1"></i> إضافة تفاصيل المكتب</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- نهاية الصف -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_about">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align:right;">رقم س.ت</th>
                                                <th  style="text-align:center;">اسم المكتب</th>
                                                <th  style="text-align:center;">عنوان المكتب</th>
                                                <th style="text-align:center;">هاتف المكتب</th>
                                                <th style="text-align:center;">تفاصيل المكتب</th>

                                                <th  style="text-align:center;">أضيف بواسطة</th>
                                                <th  style="text-align:center;">إجراء</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                                <!-- نهاية الجدول القابل للتمرير -->
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

        <div>
            <div class="modal fade about_modal" id="about_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">نموذج المكتب</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_about" id="add_about" method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label for="about_name" class="col-form-label ">اسم المكتب</label>
                                    <input type="text" class="about_name form-control" name="about_name" id="about_name">
                                </div>

                                <input type="text" class="about_id" name="about_id" id="about_id" hidden>

                                <div class="mb-3">
                                    <label for="about_phone" class="col-form-label about_phone">هاتف المكتب</label>
                                    <input type="text" class="about_phone form-control" name="about_phone" id="about_phone">
                                </div>
                                <div class="mb-3">
                                    <label for="about_address" class="col-form-label about_address">عنوان المكتب</label>
                                    <input type="text" class="about_address form-control" name="about_address"
                                        id="about_address">
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">تفاصيل المكتب</label>
                                    <textarea class="about_detail form-control" class="about_detail" name="about_detail" id="about_detail"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                </div>
                            </form>
                        </div>

                    </div><!-- /.محتوى النموذج -->
                </div><!-- /.حوار النموذج -->
            </div><!-- /.نموذج -->
        </div>

        @include('layouts.footer')
    @endsection
