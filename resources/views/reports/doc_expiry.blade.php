@extends('layouts.header')
@section('main')
    @push('title')
        <title>  Documents Expiry Report</title>
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
                                <li class="breadcrumb-item active"> تقرير انتهاء صلاحية الوثائق</li>
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
                            <form action="{{ route('doc_expiry') }}" method="post">
                                @csrf
                                <div class="row">
                                    

                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-1 mb-4">

                                            <div class="input-group">
                                                <input type="date" class="form-control date_from" id="date_from" name="date_from" placeholder="from date"
                                                    value="{{ old('date_from', $sdate ?? '') }}">
                                            </div>

                                            <div class="input-group">
                                                <input type="date" class="form-control to_date" id="to_date" name="to_date" placeholder="to date"
                                                    value="{{ old('date_to', $edate ?? '') }}">
                                            </div>

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
                                <table id="example" class="table align-middle  dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">
                                            <th style="width: 120px; text-align:center;">الرقم التسلسلي</th>
                                            <th style="width: 120px; text-align:center;">اسم الشركة</th>
                                            <th style="width: 120px; text-align:center;">اسم الموظف</th>
                                            <th style="width: 120px; text-align:center;">الوثائق وتاريخ الانتهاء</th>
                                            <th style="width: 120px; text-align:center;">أضيف بواسطة</th>
                                            <th style="width: 120px; text-align:center;">تاريخ الإنشاء</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        @php $sno=1; @endphp
                                        @foreach($companyDocs as $key => $doc)
                                        <tr>
                                            <td style="width: 120px; text-align:center;">{{ $sno }}</td>
                                            <td style="width: 120px; text-align:center;"> {{ $doc->company_name ?? '' }}</td>
                                            <td style="width: 120px; text-align:center;"> - </td>
                                            <td style="width: 120px; text-align:center;">{{ $doc->companydoc_name }} - Expires on: {{ $doc->expiry_date }}</td>
                                            <td style="width: 120px; text-align:center;">{{ $doc->added_by }}</td>
                                            <td style="width: 120px; text-align:center;">{{ \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') }}</td>


                                        </tr>
                                        @php $sno++; @endphp
                                        @endforeach
                                        @foreach($employeeDocs as $key => $edoc)

                                        @php
                                        $employee_name = DB::table('employees')
                                            ->where('id', $edoc->employee_id)
                                            ->value('employee_name');
                                    @endphp

                                        <tr>
                                            <td style="width: 120px; text-align:center;">{{ $sno }}</td>
                                            <td style="width: 120px; text-align:center;">{{ $edoc->employee_company }}</td>
                                            <td style="width: 120px; text-align:center;">{{ $employee_name }} </td>
                                            <td style="width: 120px; text-align:center;">{{ $edoc->employeedoc_name }} - Expires on: {{ $edoc->expiry_date }}</td>
                                            <td style="width: 120px; text-align:center;">{{ $edoc->added_by }}</td>
                                            <td style="width: 120px; text-align:center;">{{ \Carbon\Carbon::parse($edoc->created_at)->format('Y-m-d') }}</td>


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
