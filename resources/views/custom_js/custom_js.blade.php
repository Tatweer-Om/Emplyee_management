<script>

    $(document).ready(function() {


      if ($.fn.DataTable.isDataTable('#all_leaves')) {
    $('#all_leaves').DataTable().clear().destroy();
}

$('#all_leaves').DataTable({
    "sAjaxSource": "{{ url('show_leaves') }}",
    "bFilter": true,
    'pagingType': 'numbers',
    "ordering": true,
    "language": {
        search: ' ',
        sLengthMenu: '_MENU_',
        searchPlaceholder: 'بحث',
        info: "_START_ - _END_ من _TOTAL_ العناصر",
    },

    "createdRow": function(row, data, dataIndex) {
        var approvalStatus = data[6]; // Adjust this index if necessary

        // Check if approval_status is 0 and apply green background color
        if (approvalStatus == 0) {
            $(row).find('td').css('background-color', '#d4edda'); // Light green background
        }
    },
    initComplete: (settings, json) => {
        $('.dataTables_filter').appendTo('#tableSearch');
        $('.dataTables_filter').appendTo('.search-input');
    },
});




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



function leave_history(id) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        dataType: 'JSON',
        url: "{{ url('leave_history') }}",  // أو استخدم: "{{ route('leave_history') }}"
        method: "POST",
        data: {
            id: id,
            _token: csrfToken
        },
        success: function(response) {
            // مسح محتوى tbody الحالي
            $('#leaves_history_body').empty();

            // تكرار البيانات في الاستجابة وإنشاء صفوف جدول ديناميكيًا
            $.each(response.data, function(index, leave) {

                var createdAtFormatted = new Date(leave.created_at).toLocaleString('en-GB', {
                    day: 'numeric', month: 'numeric', year: 'numeric',
                    hour: '2-digit', minute: '2-digit', hour12: true
                });

                var approvedAtFormatted = new Date(leave.approved_at).toLocaleString('en-GB', {
                    day: 'numeric', month: 'numeric', year: 'numeric',
                    hour: '2-digit', minute: '2-digit', hour12: true
                });

                // التنسيق الشرطي لحالة الموافقة
                let approvalStatusText = '';
                let approvalInfo = '';  // ستحمل هذه المعلومات كل من الوقت الذي تمت فيه الموافقة والشخص الذي وافق
                let actionButton = '';  // الزر الذي سيتم عرضه بناءً على حالة الطلب

                if (leave.approval_status == 0) {
                    approvalStatusText = '<b style="color:orange;">قيد الانتظار</b>';
                    // زر حذف الطلب إذا كان قيد الانتظار
                    if (leave.employee_id == response.user) {
                        actionButton = `<button class="btn btn-danger" onclick="deleteRequest(${leave.id})">حذف الطلب</button>`;
                    } else {
                        actionButton = `<button class="btn btn-danger" id="rejectButton">قيد الانتظار </button>`;
                    }
                } else if (leave.approval_status == 1) {
                    approvalStatusText = '<b style="color:green;">موافق عليه</b>';
                    approvalInfo = `
                        <span>تاريخ الموافقة:</span> ${approvedAtFormatted} <br>
                        ${leave.approved_by ? `<span>الموافق:</span> ${leave.approved_by}` : ''}
                    `;
                    // زر "تمت الموافقة" إذا كانت الحالة 1
                    actionButton = `<button class="btn btn-success" disabled>تمت الموافقة</button>`;
                } else if (leave.approval_status == 2) {
                    approvalStatusText = '<b style="color:red;">مرفوض</b>';
                    approvalInfo = `
                        <span>تاريخ الرفض:</span> ${approvedAtFormatted} <br>
                        ${leave.approved_by ? `<span>مرفوض بواسطة:</span> ${leave.approved_by}` : ''}
                    `;
                    // زر "مرفوض" إذا كانت الحالة 2
                    actionButton = `<button class="btn btn-warning" disabled>مرفوض</button>`;
                }

                let leaveTypeText = '';
                if (leave.leave_type == 1) {
                    leaveTypeText = 'إجازة مرضية';
                } else if (leave.leave_type == 2) {
                    leaveTypeText = 'إجازة سنوية';
                } else {
                    leaveTypeText = 'نوع إجازة غير معروف'; // الافتراضي أو التعامل مع القيم غير المتوقعة
                }

                var row = `
                    <tr>
                        <td style="text-align:center;">${index + 1}</td>
                        <td style="text-align:center;">${leave.employee_name} <br> ${leave.employee_phone}</td>
                        <td style="text-align:center;"><span>إجمالي الإجازات المخصصة:</span> ${leave.total_leaves} <br><span>الإجازات المتبقية:</span> ${leave.remaining_leaves}</td>
                        <td style="text-align:center;">
                            <span>تاريخ التقديم:</span> ${createdAtFormatted} <br>
                            <span>حالة الموافقة:</span> ${approvalStatusText} <br>
                            ${approvalInfo}
                        </td>
                        <td style="text-align:center;">
                            <span>الإجازات المقدمة:</span> ${leave.duration} <br>
                            <span>نوع الإجازة:</span> <strong>${leaveTypeText}</strong> <br>
                            <span>تاريخ البدء:</span> ${leave.start_date} <br>
                            <span>تاريخ الانتهاء:</span> ${leave.end_date}
                        </td>
                        <td style="text-align:center;">
                            ${actionButton} <!-- عرض الزر حسب حالة الموافقة -->
                        </td>
                    </tr>`;

                // إضافة الصف إلى tbody
                $('#leaves_history_body').append(row);
            });

            // عرض النافذة المنبثقة بعد تحميل البيانات
            $('#employee_leave_history').modal('show');
        },
        error: function(xhr) {
            show_notification('error', 'فشل في استرداد تاريخ الإجازات');
            console.log(xhr);
        }
    });
}


function action(leaveId) {
    // Set the leave ID in the hidden input field
    $('#leave_id').val(leaveId);
    // Open the modal
    $('#action').modal('show');
}

$(document).ready(function() {
    // Approve button click handler
    $('#approveButton').on('click', function() {
        var leaveId = $('#leave_id').val();
        var notes = $('#notes').val(); // Get notes if any

        $.ajax({
            url: "{{ route('leave_approve') }}", // Your route for approval
            method: "POST",
            data: {
                id: leaveId,
                notes: notes,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
    // Handle success response
            show_notification('success', 'تمت الموافقة على الإجازة بنجاح.');
            $('#action').modal('hide');
            $('#all_leaves').DataTable().ajax.reload();

            },
            error: function(xhr) {
                // Handle error response
                show_notification('error', 'فشل في الموافقة على الإجازة.');
                $('#all_leaves').DataTable().ajax.reload();

                console.log(xhr);
            }

        });
    });

    // Reject button click handler
    $('#rejectButton').on('click', function() {
        var leaveId = $('#leave_id').val();
        var notes = $('#notes').val(); // Get notes if any

        $.ajax({
            url: "{{ route('leave_reject') }}", // Your route for rejection
            method: "POST",
            data: {
                id: leaveId,
                notes: notes,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
    // Handle success response
    $('#all_leaves').DataTable().ajax.reload();
    show_notification('success', 'تم رفض الإجازة بنجاح.');
    $('#action').modal('hide');

    // Optionally refresh the leave history or table
        },
        error: function(xhr) {
            // Handle error response
            show_notification('error', 'فشل في رفض الإجازة.');
            $('#all_leaves').DataTable().ajax.reload();

            console.log(xhr);
        }

        });
    });
});


function deleteRequest(id) {
        Swal.fire({
            title: 'هل أنت متأكد من الحذف؟',
            text: 'حذف',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'حذف',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_leave') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        _token: csrfToken
                    },
                    error: function() {
                        show_notification('error', 'فشل حذف البيانات');

                    },
                    success: function(data) {
                        show_notification('success', 'تم حذف البيانات بنجاح');
                        $('#employee_leave_history').modal('hide');

                    }

                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'تم إلغاء الحذف');
            }
        });
    }
    </script>
