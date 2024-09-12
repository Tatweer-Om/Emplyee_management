<script>

    $(document).ready(function() {
        $('#all_expired_documents').DataTable({
            "sAjaxSource": "{{ url('all_expired_docs') }}",
            "bFilter": true,
            "sDom": 'fBtlpi',
            'pagingType': 'numbers',
            "ordering": true,
            "language": {
                search: ' ',
                sLengthMenu: '_MENU_',
                searchPlaceholder: 'بحث',
                info: "_START_ - _END_ من _TOTAL_ العناصر",
            },
            "rowCallback": function(row, data) {
                // Access the doc_status via the data attribute
                var docStatus = $(row).attr('data-status');
                if (docStatus == 2) {
                    // Apply yellow color to the entire row (tr)
                    $(row).css('background-color', 'yellow');

                    // Apply yellow color to all cells (td) within the row
                    $('td', row).css('background-color', 'yellow');
                }
            },
            initComplete: (settings, json) => {
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },
        });

        $('#datepicker-basic').datepicker({
            format: 'dd/mm/yyyy', // or any format you prefer
            autoclose: true,
            todayHighlight: true,
        });
    });

    // <![CDATA[  <-- For SVG support
    if ('WebSocket' in window) {
        (function () {
            function refreshCSS() {
                var sheets = [].slice.call(document.getElementsByTagName("link"));
                var head = document.getElementsByTagName("head")[0];
                for (var i = 0; i < sheets.length; ++i) {
                    var elem = sheets[i];
                    var parent = elem.parentElement || head;
                    parent.removeChild(elem);
                    var rel = elem.rel;
                    if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                    }
                    parent.appendChild(elem);
                }
            }
            var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
            var address = protocol + window.location.host + window.location.pathname + '/ws';
            var socket = new WebSocket(address);
            socket.onmessage = function (msg) {
                if (msg.data == 'reload') window.location.reload();
                else if (msg.data == 'refreshcss') refreshCSS();
            };
            if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                console.log('التحديث التلقائي مفعل.');
                sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
            }
        })();
    }
    else {
        console.error('يرجى ترقية المتصفح. هذا المتصفح لا يدعم WebSocket للتحديث التلقائي.');
    }
    // ]]>


    function show_notification(type, msg) {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right', // Set position to top-right
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };
        if (type == "success") {
            toastr.success(msg, type);
        } else if (type == "error") {
            toastr.error(msg, type);
        } else if (type == "warning") {
            toastr.warning(msg, type);
        }
    }



    function renew_docs(id, type) {
        Swal.fire({
            title: 'هل تريد تجديد الوثائق؟',
            text: 'تجديد',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'تجديد',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('renew_docs_request') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        type: type,
                        _token: csrfToken
                    },
                    error: function() {
                        show_notification('error', 'فشل تجديد الوثائق');
                    },
                    success: function(data) {
                        $('#all_expired_documents').DataTable().ajax.reload();
                        show_notification('success', 'بدأت عملية التجديد');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'تم إلغاء التجديد');
            }
        });
    }

    function finish_renew(id, type) {
        $('.docs_id').val(id);
        $('.docs_type').val(type);
    }

    // Handle form submission
    $('#add_employee_status').on('submit', function(e) {
        e.preventDefault();
        if ($('.new_expiry').val() == "") {
            show_notification('error', 'يرجى اختيار تاريخ انتهاء صلاحية جديد');
            return false;
        }

        $.ajax({
            url: '{{ route("update_employee_doc") }}', // Route to handle form submission
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                show_notification('success', 'تم تحديث البيانات بنجاح'); // Display success message
                $('#renew_modal').modal('hide'); // Hide the modal
                $('#all_expired_documents').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.log('خطأ في AJAX: ' + status + ' ' + error);
            }
        });
    });



    //renewed

    $('#all_renewed_documents').DataTable({
            "sAjaxSource": "{{ url('all_renewed_docs') }}",
            "bFilter": true,
            "sDom": 'fBtlpi',
            'pagingType': 'numbers',
            "ordering": true,
            "language": {
                search: ' ',
                sLengthMenu: '_MENU_',
                searchPlaceholder: 'بحث',
                info: "_START_ - _END_ من _TOTAL_ العناصر",
            },
            "rowCallback": function( data) {
                // Access the doc_status via the data attribute

            },
            initComplete: (settings, json) => {
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },
        });
    //under_process

    $('#all_expired_documents2').DataTable({
            "sAjaxSource": "{{ url('all_expired_docs2') }}",
            "bFilter": true,
            "sDom": 'fBtlpi',
            'pagingType': 'numbers',
            "ordering": true,
            "language": {
                search: ' ',
                sLengthMenu: '_MENU_',
                searchPlaceholder: 'بحث',
                info: "_START_ - _END_ من _TOTAL_ العناصر",
            },
            "rowCallback": function(row, data) {
                // Access the doc_status via the data attribute
                var docStatus = $(row).attr('data-status');
                if (docStatus == 2) {
                    // Apply yellow color to the entire row (tr)
                    $(row).css('background-color', 'yellow');

                    // Apply yellow color to all cells (td) within the row
                    $('td', row).css('background-color', 'yellow');
                }
            },
            initComplete: (settings, json) => {
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },
        });
    function renew_docs2(id, type) {
        Swal.fire({
            title: 'هل تريد تجديد الوثائق؟',
            text: 'تجديد',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'تجديد',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('renew_docs_request2') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        type: type,
                        _token: csrfToken
                    },
                    error: function() {
                        show_notification('error', 'فشل تجديد الوثائق');

                    },
                    success: function(data) {
                        $('#all_expired_documents2').DataTable().ajax.reload();
                        show_notification('success', 'بدأت عملية التجديد');

                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'تم إلغاء التجديد');
            }
        });
    }

    function finish_renew2(id, type) {
        $('.docs_id').val(id);
        $('.docs_type').val(type);
    }

    // Handle form submission
    $('#add_employee_status2').on('submit', function(e) {
        e.preventDefault();
        if ($('.new_expiry').val() == "") {
            show_notification('error', 'يرجى اختيار تاريخ انتهاء صلاحية جديد');
            return false;
        }

        $.ajax({
            url: '{{ route("update_employee_doc2") }}', // Route to handle form submission
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                show_notification('success', 'تم تحديث البيانات بنجاح'); // Display success message
                $('#renew_modal').modal('hide'); // Hide the modal
                $('#all_expired_documents2').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.log('خطأ في AJAX: ' + status + ' ' + error);
            }
        });
    });

    //end

    $(document).ready(function() {
        $('.logout').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('logout') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Redirect to the login page or homepage
                    show_notification('success', 'لقد قمت بتسجيل الخروج');
                    window.location.href = '/login';
                },
                error: function(xhr) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });



    </script>
