@extends('layouts.header')
@section('main')
    @push('title')
        <title>تقرير مهام الموظفين</title>
    @endpush

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">التقارير</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">تقرير مهام الموظفين</a></li>
                                <li class="breadcrumb-item active">التقارير</li>
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
                            <form action="{{ route('employee_task_report') }}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-1 mb-4">

                                            <div class="input-group">
                                                <input type="date" class="form-control date_from" id="date_from" name="date_from" placeholder="من تاريخ"
                                                    value="{{ old('date_from', $sdate ?? '') }}">
                                            </div>

                                            <div class="input-group">
                                                <input type="date" class="form-control to_date" id="to_date" name="to_date" placeholder="إلى تاريخ"
                                                    value="{{ old('date_to', $edate ?? '') }}">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="d-flex align-items-center gap-1 mb-4">
                                            <select class="user_id form-control" searchable name="user_id" id="choices-single-groups">
                                                <option value="">اختر الشركة</option>
                                                 @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id', $user_id) == $user->id ? 'selected' : '' }}>
                                                        {{ $user->user_name ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="mb-4">
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
                                            <th style="width: 120px; text-align:center;">اسم الموظف</th>
                                            <th style="width: 120px; text-align:center;">الشركات</th>
                                            <th style="width: 120px; text-align:center;">المستندات</th>
                                            <th style="width: 120px; text-align:center;">تاريخ الإنشاء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sno=1; @endphp
                                        @foreach($companyDocs as $key => $doc)
                                        @php
                                            $employee_count = DB::table('employees')->where('employee_company', $doc->company_id)->count();
                                            $employee_doc_count = DB::table('employee_docs')->where('employee_company_id', $doc->company_id)->count();
                                            $company_doc_count = DB::table('company_docs')->where('company_id', $doc->company_id)->count();
                                        @endphp
                                        <tr>
                                            <td style="width: 120px; text-align:center;">{{ $sno }}</td>
                                            <td style="width: 120px; text-align:center;">
                                                <a href="{{ url('employee_task_page', $doc->user_id) }}" class="text-decoration-none">
                                                    {{ $doc->added_by ?? 'غير معروف' }}
                                                </a>
                                            </td>
                                            <td style="width: 120px; text-align:center;">
                                                <a href="{{ url('company_profile/' . $doc->company_id) }}" class="text-decoration-none">
                                                    {{ $doc->company_name ?? 'غير متوفر' }}
                                                </a>
                                                <br>
                                                مستندات الشركة: {{ $company_doc_count ?? '0' }}
                                            </td>
                                            <td style="width: 120px; text-align:center;">
                                                الموظفون المضافون: {{ $employee_count ?? '' }} <br>
                                                مستندات الموظفين: {{ $employee_doc_count ?? '' }}
                                            </td>
                                            <td style="width: 120px; text-align:center;">
                                                {{ \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') }}
                                            </td>
                                        </tr>
                                        @php $sno++; @endphp
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
