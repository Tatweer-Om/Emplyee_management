@extends('layouts.header')
@section('main')
    @push('title')
        <title> الوثائق المجددة </title>
    @endpush

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- بداية عنوان الصفحة -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"> الوثائق المجددة </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"> الوثائق المجددة </a></li>
                                    <li class="breadcrumb-item active"> الوثائق المجددة </li>
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

                                <div class="table-responsive">
                                    <table class="table align-middle dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_renewed_documents">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="text-align: center;">الرقم</th>
                                                <th style="text-align: center;">اسم الوثيقة</th>
                                                <th style="text-align: center; width: 20px;">الشركة أو الموظف</th>
                                                <th style="text-align: center;">تاريخ انتهاء الصلاحية الجديد</th>
                                                <th style="text-align: center;">تاريخ انتهاء الصلاحية القديم</th>
                                                <th style="text-align: center;">أضيف بواسطة</th>
                                                <th style="text-align: center;">تاريخ الإضافة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- سيتم تعبئة الصفوف هنا باستخدام JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                                <!-- نهاية الجدول -->
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

     <!-- /.modal -->

        @include('layouts.footer')
    @endsection
