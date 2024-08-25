@extends('layouts.header')
@section('main')
    @push('title')
        <title>Companies </title>
    @endpush


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Expired Documents</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Expired Documents</a></li>
                                    <li class="breadcrumb-item active">Expired Documents</li>
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
                                 
                                <!-- end row -->

                                <div class="table-responsive">
                                    <table class="table align-middle dt-responsive table-check nowrap"
                                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="all_expired_documents">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th style="text-align: right;">Sr.No</th>
                                                <th style="text-align: right; width: 20px;">Company Name</th>
                                                <th style="text-align: right;">Employee Name</th>
                                                <th style="text-align: right;">Office User</th>
                                                <th style="text-align: right;">Document Name</th>
                                                <th style="text-align: right;">Expiry Date</th>
                                                <th style="text-align: right;">Status</th>
                                                <th style="text-align: right;">Add Date</th>
                                                <th style="text-align: right; width: 20px;">Action</th>

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

        


        


        @include('layouts.footer')
    @endsection
