@extends('layouts.header')
@section('main')
    @push('title')
        <title>الفرع</title>
    @endpush

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">قائمة الفروع</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">الفروع</a></li>
                                    <li class="breadcrumb-item active">قائمة الفروع</li>
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
                                                data-bs-toggle="modal" data-bs-target="#branch_modal"><i
                                                class="bx bx-plus me-1"></i> إضافة فرع</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle datatable dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_branch">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align:right;">رقم</th>
                                                <th style="text-align:center;">اسم الفرع</th>
                                                <th style="text-align:center;">عنوان الفرع</th>
                                                <th style="text-align:center;">هاتف الفرع</th>
                                                <th style="text-align:center;">تفاصيل الفرع</th>

                                                <th style="text-align:center;">أضيف بواسطة</th>
                                                <th style="text-align:center;">الإجراء</th>

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
            <div class="modal fade branch_modal" id="branch_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">مودال الفرع</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="add_branch" id="add_branch" method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label for="branch_name" class="col-form-label ">اسم الفرع</label>
                                    <input type="text" class="branch_name form-control" name="branch_name" id="branch_name">
                                </div>

                                <input type="text" class="branch_id" name="branch_id" id="branch_id" hidden>

                                <div class="mb-3">
                                    <label for="branch_phone" class="col-form-label branch_phone">هاتف الفرع</label>
                                    <input type="text" class="branch_phone form-control" name="branch_phone" id="branch_phone">
                                </div>
                                <div class="mb-3">
                                    <label for="branch_address" class="col-form-label branch_address">عنوان الفرع</label>
                                    <input type="text" class="branch_address form-control" name="branch_address"
                                        id="branch_address">
                                </div>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">تفاصيل الفرع</label>
                                    <textarea class="branch_detail form-control" name="branch_detail" id="branch_detail"></textarea>
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
