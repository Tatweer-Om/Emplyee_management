@extends('layouts.header')
@section('main')
    @push('title')
        <title>{{ $company->company_name ?? '' }} </title>
    @endpush

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row " hidden>
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mt-4">
                                                <h5 class="font-size-14">Classic Demo</h5>
                                                <div class="classic-colorpicker"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-4">
                                                <h5 class="font-size-14">Monolith Demo</h5>
                                                <div class="monolith-colorpicker"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-4">
                                                <h5 class="font-size-14">Nano Demo</h5>
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

                <div class="row" >
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $company->company_name ?? '' }}</h4>
                                <p class="card-title-desc">From This Page Documents For A Company will be Added</p>
                            </div>
                            <div class="card-body">
                                <!-- Dynamic Rows Container -->
                                <div class="company-doc-form" id="row-container">
                                    <!-- Initial Row (Example) -->
                                    <div class="row form-row">
                                        <div class="col-md-6 col-lg-3">
                                            <div class="mb-2">
                                                <label for="choices-single-groups" class="form-label font-size-13">All Documents</label>
                                                <select class="all_document form-control" name="all_document">
                                                    <option value="">Choose a Document</option>
                                                    @foreach($documents as $doc)
                                                    <option value="{{ $doc->id }}">{{ $doc->document_name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="mb-2">
                                                <label class="form-label">Document</label>
                                                <input type="text" class="form-control companydoc_name" name="companydoc_name">
                                            </div>
                                        </div>
                                        <input type="text" name="companydoc_id" class="companydoc_id" hidden>
                                        <input type="text" name="office_user" value="{{ $company->office_user ?? '' }}" class="office_user" hidden>
                                        <input type="text" name="company_id" value="{{ $company->id ?? '' }}" class="company_id" hidden>
                                        <input type="text" name="company_name" value="{{ $company->company_name ?? '' }}" class="company_name" hidden>
                                        <div class="col-lg-3">
                                            <div class="mb-2">
                                                <label class="form-label">Expiry Date</label>
                                                <input type="date" class="form-control" name="expiry_date">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mt-4">
                                            <button type="button" class="btn btn-success submit-row">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 mt-4">
                                        <button type="button" class="btn btn-success add-row">Add New Document</button>
                                    </div>
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
            <table class="table align-middle   dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                <thead>
                    <tr class="bg-transparent">

                        <th style="width: 120px;">Sr.No </th>
                        <th>Document Name</th>
                        <th>Expiry Date</th>
                        <th>Renewl Period</th>
                        <th>Added On</th>
                        <th>Office User</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>

    </div>





    @include('layouts.footer')
    @endsection
