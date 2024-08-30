@extends('layouts.header')
@section('main')
    @push('title')
        <title>{{ $employee->employee_name ?? '' }} </title>
    @endpush

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row" hidden>
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mt-4">
                                                <h5 class="font-size-14">عرض كلاسيكي</h5>
                                                <div class="classic-colorpicker"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-4">
                                                <h5 class="font-size-14">عرض مونوليث</h5>
                                                <div class="monolith-colorpicker"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-4">
                                                <h5 class="font-size-14">عرض نانو</h5>
                                                <div class="nano-colorpicker"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $employee->employee_name ?? '' }}</h4>
                                <p class="card-title-desc">{{ $company_name ?? '' }}</p>
                                <p class="card-title-desc">{{ $employee->employee_email ?? '' }}</p>
                                <p class="card-title-desc">{{ $employee->employee_phone ?? '' }}</p>
                                <p class="card-title-desc" style="text-align:justify;">{{ $employee->employee_detail ?? '' }}</p>
                            </div>
                            <div class="card-body">
                                <!-- حاوية الصفوف الديناميكية -->
                                <div class="employee-doc-form" id="row-container">
                                    <form class="add_employee_doc" id="add_employee_doc" method="POST" action="#">
                                    @csrf
                                    <!-- صف مبدئي (مثال) -->
                                        <div class="row form-row">
                                            <div class="col-md-6 col-lg-3">
                                                <div class="mb-2">
                                                    <label for="choices-single-groups" class="form-label font-size-13">جميع المستندات</label>
                                                    <select class="all_document form-control" name="all_document">
                                                        <option value="">اختر مستندًا</option>
                                                        @foreach($documents as $doc)
                                                        <option value="{{ $doc->id }}">{{ $doc->document_name ?? '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="mb-2">
                                                    <label class="form-label">المستند</label>
                                                    <input type="text" class="form-control employeedoc_name" name="employeedoc_name">
                                                </div>
                                            </div>
                                            <input type="text" name="employeedoc_id" class="employee_doc_id" hidden>
                                            <input type="text" name="employee_company" value="{{ $employee->employee_company ?? '' }}" class="employee_company" hidden>
                                            <input type="text" name="office_user" value="{{ $employee->added_by ?? '' }}" class="office_user" hidden>
                                            <input type="text" name="employee_id" value="{{ $employee->id ?? '' }}" class="employee_id" hidden>
                                            <input type="text" name="employee_name" value="{{ $employee->employee_name ?? '' }}" class="employee_name" hidden>
                                            <div class="col-lg-3">
                                                <div class="mb-2">
                                                    <label class="form-label">تاريخ الانتهاء</label>
                                                    <input type="date" class="form-control expiry_date" name="expiry_date">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mt-4">
                                                <button type="submit" class="btn btn-success submit-row">تقديم</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <div class="table-responsive">
            <table id="all_employee_doc" class="table align-middle dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                <thead>
                    <tr class="bg-transparent">
                        <th style="width: 120px; text-align:center;">رقم</th>
                        <th style="text-align:center;">اسم المستند</th>
                        <th style="text-align:center;">تاريخ الانتهاء</th>
                        <th style="text-align:center;">مدة التجديد</th>
                        <th style="text-align:center;">تاريخ الإضافة</th>
                        <th style="text-align:center;">مستخدم المكتب</th>
                        <th style="text-align:center;">إجراء</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>

    @include('layouts.footer')
@endsection
