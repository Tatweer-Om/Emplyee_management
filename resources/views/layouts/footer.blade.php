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
 <div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center p-3">

            <h5 class="m-0 me-2">Theme Customizer</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="m-0" />

        <div class="p-4">
            <h6 class="mb-3">Layout</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout" id="layout-vertical" value="vertical">
                <label class="form-check-label" for="layout-vertical">Vertical</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout" id="layout-horizontal" value="horizontal">
                <label class="form-check-label" for="layout-horizontal">Horizontal</label>
            </div>

            <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light" value="light">
                <label class="form-check-label" for="layout-mode-light">Light</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark">
                <label class="form-check-label" for="layout-mode-dark">Dark</label>
            </div>

            <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                <label class="form-check-label" for="layout-width-fuild">Fluid</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                <label class="form-check-label" for="layout-width-boxed">Boxed</label>
            </div>

            <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                <label class="form-check-label" for="layout-position-fixed">Fixed</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-position" id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
            </div>

            <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                <label class="form-check-label" for="topbar-color-light">Light</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                <label class="form-check-label" for="topbar-color-dark">Dark</label>
            </div>

            <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

            <div class="form-check sidebar-setting">
                <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                <label class="form-check-label" for="sidebar-size-default">Default</label>
            </div>
            <div class="form-check sidebar-setting">
                <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                <label class="form-check-label" for="sidebar-size-compact">Compact</label>
            </div>
            <div class="form-check sidebar-setting">
                <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
            </div>

            <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

            <div class="form-check sidebar-setting">
                <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                <label class="form-check-label" for="sidebar-color-light">Light</label>
            </div>
            <div class="form-check sidebar-setting">
                <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                <label class="form-check-label" for="sidebar-color-dark">Dark</label>
            </div>
            <div class="form-check sidebar-setting">
                <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                <label class="form-check-label" for="sidebar-color-brand">Brand</label>
            </div>

            <h6 class="mt-4 mb-3 pt-2">Direction</h6>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr" value="ltr">
                <label class="form-check-label" for="layout-direction-ltr">LTR</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl" value="rtl">
                <label class="form-check-label" for="layout-direction-rtl">RTL</label>
            </div>

        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

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
        @elseif ($route == 'branch')
        @include('custom_js.branch_js')
        @elseif ($route == 'user')
        @include('custom_js.user_js')
        @elseif ($route == 'employee')
        @include('custom_js.employee_js')
        @elseif ($route == 'document')
        @include('custom_js.document_js')
        @elseif ($route == 'document_addition')
        @include('custom_js.document_js')
        @endif


</body>


<!-- Mirrored from themesbrand.com/minia/layouts/index-rtl.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:36:48 GMT -->
</html>
