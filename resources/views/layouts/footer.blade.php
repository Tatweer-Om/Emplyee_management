 <!-- Right Sidebar -->



 <footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Minia.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- JAVASCRIPT -->
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>
<!-- pace js -->
<script src="{{ asset('libs/pace-js/pace.min.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Plugins js-->
<script src="{{ asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- dashboard init -->
<script src="{{ asset('js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{  asset('plugins/select2/js/custom-select.js')}}"></script>
<script src="{{  asset('select2_js/select2.min.js')}}"></script>

<script src="{{ asset('libs/@fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('libs/@fullcalendar/interaction/main.min.js') }}"></script>

<!-- Calendar init -->
<script src="{{ asset('js/pages/calendar.init.js') }}"></script>

<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<!-- init js -->
<script src="{{ asset('js/pages/invoices-list.init.js') }}"></script>
<script src="{{ asset('js/pages/modal.init.js') }}"></script>

<script src="{{  asset('plugins/toastr/toastr.min.js')}}"></script>
<script src="{{  asset('plugins/toastr/toastr.js')}}"></script>
<script src="{{  asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{  asset('plugins/sweetalert/sweetalerts.min.js')}}"></script>

<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>

<!-- color picker js -->
<script src="{{ asset('libs/%40simonwep/pickr/pickr.min.js')}}"></script>
<script src="{{asset('libs/%40simonwep/pickr/pickr.es5.min.js')}}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js')}}"></script>
  <!-- Sweet Alerts js -->
  <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>

  <!-- Sweet alert init js-->
  <script src="{{ asset('js/pages/sweetalert.init.js')}}"></script>

  <script src="{{  asset('js/pages/select2.min.js')}}"></script>
  <script src="{{asset('libs/flatpickr/flatpickr.min.js')}}"></script>

  <script src="{{asset('js/pages/form-advanced.init.js')}}"></script>


<!-- pace js -->
<script>
      var myModal = document.getElementById('myModal')
            var myInput = document.getElementById('myInput')

            myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
            })
</script>


@include('custom_js.custom_js')


@php
            // Get the current route name
            $routeName = Route::currentRouteName();

            // Split \ route name to get the controller name
            $segments = explode('.', $routeName);

            // Get the controller name (assuming it's the first segment)
            $route = isset($segments[0]) ? $segments[0] : null;

        @endphp


        @if ($route == 'company')
        @include('custom_js.company_js')
        @elseif ($route == 'company_profile')
        @include('custom_js.company_js')
        @elseif ($route == 'branch')
        @include('custom_js.branch_js')
        @elseif ($route == 'user')
        @include('custom_js.user_js')
        @elseif ($route == 'employee')
        @include('custom_js.employee_js')
        @elseif ($route == 'document')
        @include('custom_js.document_js')
        @elseif ($route == 'document_addition')
        @include('custom_js.document_add_js')
        @elseif ($route == 'employee_document_addition')
        @include('custom_js.add_employee_doc_js')
        @elseif ($route == 'about')
        @include('custom_js.about_js')
        @elseif ($route == 'employee_task_page')
        @include('custom_js.employee_task_js')
        @elseif ($route == 'employee_task')
        @include('custom_js.employee_task_js')
        @elseif ($route == 'employee_doc_report')
        @include('custom_js.reports_js')
        @elseif ($route == 'company_doc_report')
        @include('custom_js.reports_js')
        @elseif ($route == 'doc_expiry')
        @include('custom_js.reports_js')
        @elseif ($route == 'employee_task_report')
        @include('custom_js.reports_js')
        @endif
        <script>var base_url= "<?php echo url('/'); ?>"</script>

</body>


<!-- Mirrored from themesbrand.com/minia/layouts/index-rtl.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:36:48 GMT -->
</html>
