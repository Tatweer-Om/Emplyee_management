@extends('layouts.header')
@section('main')
    @push('title')
        <title>تفاصيل المكتب</title>
    @endpush


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Invoice List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                <li class="breadcrumb-item active">Invoice List</li>
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
                            <form action="{{ route('employee_doc_report') }}" method="GET">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-light waves-effect waves-light"><i class="bx bx-plus me-1"></i> Add Invoice</button>
                                        </div>
                                    </div>

                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-1 mb-4">

                                            <div class="input-group">
                                                <input type="date" class="form-control date_from" id="date_from" name="date_from" placeholder="from date"
                                                    value="{{ old('date_from', $sdate ?? '') }}">
                                            </div>

                                            <div class="input-group">
                                                <input type="date" class="form-control to_date" id="to_date" name="date_to" placeholder="to date"
                                                    value="{{ old('date_to', $edate ?? '') }}">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="d-flex align-items-center gap-1 mb-4">
                                            <select class="employee_company form-control" searchable name="company_id" id="choices-single-groups">
                                                <option value="">اختر الشركة</option>
                                                <option value="all" {{ old('company_id', $company_id) === 'all' ? 'selected' : '' }}>All</option>
                                                @foreach($companies as $company)
                                                    <option value="{{ $company->id }}" {{ old('company_id', $company_id) == $company->id ? 'selected' : '' }}>
                                                        {{ $company->company_name ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- end row -->

                            <div class="table-responsive">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">
                                            <th style="width: 120px;">Sr.no</th>
                                            <th>Employee & Company Name</th>
                                            <th>Documents and Expiry</th>
                                            <th>Added By</th>
                                            <th>Created AT</th>
                                            <th style="width: 150px;">Download Pdf</th>
                                            <th style="width: 90px;">Action</th>
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
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee_name }} <br> {{ $doc->employee_company }}</td>
                                            <td>{{ $doc->employeedoc_name }} - Expires on: {{ $doc->expiry_date }}</td>
                                            <td>{{ $doc->added_by }}</td>
                                            <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') }}</td>

                                            <td>
                                                <div>
                                                    <button type="button" class="btn btn-soft-light btn-sm w-xs waves-effect btn-label waves-light">
                                                        <i class="bx bx-download label-icon"></i> Pdf
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                                        <li><a class="dropdown-item" href="#">Print</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
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
