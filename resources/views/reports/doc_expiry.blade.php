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
                        <h4 class="mb-sm-0 font-size-18">Reports</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                <li class="breadcrumb-item active"> Documents Expiry Report</li>
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
                            <form action="{{ route('doc_expiry') }}" method="GET">
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
                                                <input type="date" class="form-control to_date" id="to_date" name="to_date" placeholder="to date"
                                                    value="{{ old('date_to', $edate ?? '') }}">
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </form>

                            <!-- end row -->

                            <div class="table-responsive">
                                <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                    <thead>
                                        <tr class="bg-transparent">
                                            <th style="width: 120px; text-align:center;">Sr.no</th>
                                            <th style="width: 120px; text-align:center;">Documents and Expiry</th>
                                            <th style="width: 120px; text-align:center;">Added By</th>
                                            <th style="width: 120px; text-align:center;">Created AT</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($documents as $key => $doc)
                                        <tr>
                                            <td style="width: 120px; text-align:center;">{{ $key + 1 }}</td>

                                            <td style="width: 120px; text-align:center;">
                                                @if(isset($doc->employee_id))
                                                    {{ DB::table('employees')->where('id', $doc->employee_id)->value('employee_name') }}
                                                    <br>
                                                    {{ $doc->employee_company ?? '' }}
                                                @elseif(isset($doc->company_id))
                                                    {{ DB::table('companies')->where('id', $doc->company_id)->value('company_name') }}
                                                @endif
                                            </td>

                                            <td style="width: 120px; text-align:center;">
                                                {{ $doc->employeedoc_name ?? $doc->companydoc_name }} - Expires on: {{ $doc->expiry_date }}
                                            </td>

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
