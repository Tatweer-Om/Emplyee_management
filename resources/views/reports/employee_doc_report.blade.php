@extends('layouts.header')
@section('main')
    @push('title')
        <title>تقرير مستندات الموظفين</title>
    @endpush


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">تقارير</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">تقارير</a></li>
                                <li class="breadcrumb-item active">تقرير وثائق الموظف</li>
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
                            {{-- <form action="{{ route('employee_doc_report') }}" method="post">
                                @csrf
                                <div class="row">


                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-3 mb-4">

                                            <div class="w-100">
                                                <label for="date_from" class="form-label">From Date</label>
                                                <input type="date" class="form-control" id="date_from" name="date_from" placeholder="from date"
                                                    value="{{ old('date_from', $sdate ?? '') }}">
                                            </div>

                                            <div class="w-100">
                                                <label for="to_date" class="form-label">To Date</label>
                                                <input type="date" class="form-control" id="to_date" name="to_date" placeholder="to date"
                                                    value="{{ old('date_to', $edate ?? '') }}">
                                            </div>

                                        </div>


                                    </div>

                                    <div class="col-sm">
                                        <div class="d-flex align-items-center gap-1 m-4">

                                            <select class="employee_company form-control" searchable name="company_id" id="choices-single-groups">
                                                <option value="">اختر الشركة</option>
                                                 @foreach($companies as $company)
                                                    <option value="{{ $company->id }}" {{ old('company_id', $company_id) == $company->id ? 'selected' : '' }}>
                                                        {{ $company->company_name ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="m-4">
                                            <button type="submit" class="btn btn-light waves-effect waves-light">إرسال</button>
                                        </div>
                                    </div>
                                </div>
                            </form> --}}
                            <form action="{{ route('employee_doc_report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <div class="w-100">
                                                <label for="date_from" class="form-label">من تاريخ</label>
                                                <input type="date" class="form-control" id="date_from" name="date_from" placeholder="from date"
                                                    value="{{ old('date_from', $sdate ?? '') }}">
                                            </div>

                                            <div class="w-100">
                                                <label for="to_date" class="form-label">إلى تاريخ</label>
                                                <input type="date" class="form-control" id="to_date" name="to_date" placeholder="to date"
                                                    value="{{ old('date_to', $edate ?? '') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="d-flex align-items-center gap-1 ">
                                            <div class="w-100">
                                                <label for="choices-single-groups" class="form-label">اختر الشركة</label>
                                                <select class="employee_company form-control" name="company_id" id="choices-single-groups">
                                                    <option value="">اختر الشركة</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company->id }}" {{ old('company_id', $company_id) == $company->id ? 'selected' : '' }}>
                                                            {{ $company->company_name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-light waves-effect waves-light">إرسال</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <!-- end row -->

                            <div class="table-responsive">
                                <table id="example" class="table align-middle dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">
                                            <th style="width: 120px; text-align:center;">الرقم التسلسلي</th>
                                            <th style="width: 120px; text-align:center;">اسم الموظف والشركة</th>
                                            <th style="width: 120px; text-align:center;">الوثائق وتاريخ الانتهاء</th>
                                            <th style="width: 120px; text-align:center;">أضيف بواسطة</th>
                                            <th style="width: 120px; text-align:center;">تاريخ الإنشاء</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($employeeDocs as $key => $doc)

                                        @php
                                        $employee_name = DB::table('employees')
                                            ->where('id', $doc->employee_id)
                                            ->value('employee_name');
                                    @endphp

                                        <tr>
                                            <td style="width: 120px; text-align:center;">{{ $key + 1 }}</td>
                                            <td style="width: 120px; text-align:center;">{{ $employee_name }} <br> {{ $doc->employee_company }}</td>
                                            <td style="width: 120px; text-align:center;">{{ $doc->employeedoc_name }} - Expires on: {{ $doc->expiry_date }}</td>
                                            <td style="width: 120px; text-align:center;">{{ $doc->added_by }}</td>
                                            <td style="width: 120px; text-align:center;">{{ \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') }}</td>


                                        </tr>
                                        @endforeach
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
    <!-- End Page-content -->


</div>


@include('layouts.footer')
@endsection
