<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.company_modal').on('hidden.bs.modal', function() {
            $(".add_company")[0].reset();
            $('.company_id').val('');
        });

        $('#all_company').DataTable().clear().destroy();
        $('#all_company').DataTable({
            "sAjaxSource": "{{ url('show_company') }}",
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
            initComplete: (settings, json) => {
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },
        });

        $('.add_company').off().on('submit', function(e) {
            e.preventDefault();
            var formdatas = new FormData($('.add_company')[0]);
            var title = $('.company_name').val();
            var id = $('.company_id').val();

            if (id != '') {
                if (title == "") {
                    show_notification('error', 'يرجى إدخال اسم الشركة');
                    return false;
                }
                var str = $(".add_company").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_company') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var id = data.last_id;
                        var url = base_url + '/document_addition/' + id;
                        show_notification('success', 'تم تحديث البيانات بنجاح');
                        $('#company_modal').modal('hide');
                        $('#all_company').DataTable().ajax.reload();
                        window.open(url, '_blank');
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل تحديث البيانات');
                        $('#all_company').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            } else if (id == '') {
                if (title == "") {
                    show_notification('error', 'يرجى إدخال اسم الشركة');
                    return false;
                }
                var str = $(".add_company").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_company') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var id = data.last_id;
                        var url = base_url + '/document_addition/' + id;
                        $('#all_company').DataTable().ajax.reload();
                        show_notification('success', 'تمت إضافة البيانات بنجاح');
                        $('.company_modal').modal('hide');
                        $(".add_company")[0].reset();
                        window.open(url, '_blank');
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل إضافة البيانات');
                        $('#all_company').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
        });

        function edit(id) {
            console.log(id);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                dataType: 'JSON',
                url: "{{ url('edit_company') }}",
                method: "POST",
                data: {
                    id: id,
                    _token: csrfToken
                },
                success: function(fetch) {
                    if (fetch != "") {
                        $(".company_name").val(fetch.company_name);
                        $(".company_email").val(fetch.company_email);
                        $(".company_phone").val(fetch.company_phone);
                        $(".office_user").val(fetch.office_user).trigger('change');
                        $(".company_address").val(fetch.company_address);
                        $(".company_detail").val(fetch.company_detail);
                        $(".cr_no").val(fetch.cr_no);

                        $(".company_id").val(fetch.company_id);
                        $(".modal-title").html('تحديث');
                    }
                },
                error: function(html) {
                    show_notification('error', 'فشل تعديل البيانات');
                    console.log(html);
                    return false;
                }
            });
        }

        function del(id) {
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
                        url: "{{ url('delete_company') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _token: csrfToken
                        },
                        error: function() {
                            show_notification('error', 'فشل حذف البيانات');
                        },
                        success: function(data) {
                            $('#all_company').DataTable().ajax.reload();
                            show_notification('success', 'تم حذف البيانات بنجاح');
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    show_notification('success', 'تم إلغاء الحذف');
                }
            });
        }

        //employee
        function add_employee(id) {
            $('.employee_company').val(id);
        }

        $('.add_employee').off().on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formdatas = new FormData(this); // Create FormData object from the form
            var title = $('.employee_name').val(); // Get employee name
            var id = $('.employee_id').val(); // Get employee ID

            // Validate form input
            if (title === "") {
                show_notification('error', 'يرجى إدخال اسم الموظف');
                return false; // Exit if validation fails
            }

            // Send AJAX request
            $.ajax({
                type: "POST",
                url: "{{ url('add_employee2') }}", // Set your API endpoint
                data: formdatas,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Include CSRF token
                },
                success: function(data) {
                    var id = data.last_id;
                    var url = base_url + '/employee_document_addition/' + id;
                    show_notification('success', 'تمت إضافة البيانات بنجاح');
                    $('.employee_modal').modal('hide');
                    $(".add_employee")[0].reset();
                    window.open(url, '_blank');
                    return false;
                },
                error: function(data) {
                    show_notification('error',
                    'فشل إضافة البيانات'); // Show error notification
                    $('#all_employee').DataTable().ajax.reload(); // Reload DataTable
                    console.log(data); // Log error for debugging
                }
            });
        });
    });


    //employee3
    function add_employee3(id) {
        $('.employee_company2').val(id);
    }

    $('.add_employee3').off().on('submit', function(e) {


        e.preventDefault(); // Prevent default form submission

        var formdatas = new FormData(this); // Create FormData object from the form
        var title = $('.employee_name').val(); // Get employee name
        var id = $('.employee_id').val(); // Get employee ID

        // Validate form input
        if (title === "") {
            show_notification('error', 'يرجى إدخال اسم الموظف');
            return false; // Exit if validation fails
        }

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: "{{ url('add_employee3') }}", // Set your API endpoint
            data: formdatas,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function(data) {

                var id = data.last_id;
                var url = base_url + '/employee_document_addition/' + id;

                show_notification('success', 'تمت إضافة البيانات بنجاح');
                $('.employee_modal3').modal('hide');
                $(".add_employee3")[0].reset();
                window.open(url, '_blank');
                $('#all_company_employee').DataTable().ajax.reload();
                return false;
            },
            error: function(data) {
                show_notification('error', 'فشل إضافة البيانات'); // Show error notification
                $('#all_company_employee').DataTable().ajax.reload(); // Reload DataTable
                console.log(data); // Log error for debugging
            }
        });
    });





    $(document).ready(function() {
        // Extract the company ID from the URL
        var urlParts = window.location.pathname.split('/');
        var companyId = urlParts[urlParts.length - 1];

        $.ajax({
            url: "{{ url('show_company_doc') }}",
            method: 'GET',
            data: {
                company_id: companyId
            },
            success: function(response) {
                // Clear previous data
                $('#employees-count').text(response.employee_docs.length); // Count of employees
                $('#company-docs-count').text(response.company_docs
                .length); // Count of company documents

                // Calculate total number of employee documents
                let totalEmployeeDocs = response.employee_docs.reduce((total, employee_data) =>
                    total + employee_data.documents.length, 0);
                $('#employee-docs-count').text(totalEmployeeDocs);
                $('#employee_docs_list').empty();
                $('#all_profile_docs tbody').empty();
                $('#renewal-docs-list').empty();
                $('#all_company_employee tbody').empty(); // Clear the employee table

                const today = new Date();
                const threeMonthsInMs = 3 * 30 * 24 * 60 * 60 *
                1000; // Three months in milliseconds

                let expiringSoonCount = 0;
                let expiredCount = 0;

                response.employee_docs.forEach(function(employee_data, index) {
                    let baseUrl = "<?php echo url('employee_document_addition'); ?>";

                    // Generate employee document list
                    let employee_html =
                        `<div class="col-lg-4">
                                        <div class="list-group list-group-flush border border-primary rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="${baseUrl}/${employee_data.employee.id}" id="addButton" class="btn btn-sm btn-info m-2">+</a>
                                                    <h5 class="font-size-13 text-truncate">${employee_data.employee.employee_name}</h5>`;

                    employee_data.documents.forEach(function(doc) {
                        employee_html += `<p class="m-2 text-truncate">${doc.employeedoc_name} - تاريخ الانتهاء
                                        <span class="badge bg-danger-subtle text-primary rounded-pill ms-1 float-end font-size-13">${doc.expiry_date}</span>
                                    </p>`;
                    });

                    employee_html += `</div></div></div></div>`;
                    $('#employee_docs_list').append(employee_html);

                    // Format the created_at date to only display the date part
                    let created_at_date = new Date(employee_data.employee.created_at)
                        .toLocaleDateString('en-GB');

                    // Generate DataTable row
                    let doc_names = "";
                    employee_data.documents.forEach(function(doc) {
                        let expiryDate = new Date(doc.expiry_date);

                        // Calculate the difference in time
                        let timeLeft = expiryDate.getTime() - today.getTime();

                        // Calculate days remaining
                        let daysRemaining = Math.floor(timeLeft / (1000 * 3600 *
                            24));
                        let years = Math.floor(daysRemaining / 365);
                        let months = Math.floor((daysRemaining % 365) / 30);
                        let days = daysRemaining % 30;

                        let formattedExpiryDate = expiryDate.getDate() + '-' + (
                                expiryDate.getMonth() + 1) + '-' + expiryDate
                            .getFullYear();

                        doc_names +=
                            `${doc.employeedoc_name} (تاريخ الانتهاء: ${formattedExpiryDate})<br>`;

                        let itemHtml = "";

                        if (timeLeft <= 0) {
                            // Document has expired
                            expiredCount++;

                            // Set the display text to "Expired" and don't show months left
                            itemHtml = `<a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-13 text-truncate">${employee_data.employee.employee_name}</h5>
                                <p class="mb-0 text-truncate">${doc.employeedoc_name} <span class="text-danger">منتهي</span></p>

                            </div>
                            <div class="fs-1">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                        </div>
                    </a>`;
                        } else if (daysRemaining < 30) {
                            // Document is expiring within less than a month
                            expiringSoonCount++;

                            itemHtml = `<a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-13 text-truncate">${employee_data.employee.employee_name} <br>${doc.employeedoc_name}</h5>
                                <p class="mb-0 text-truncate"> <span class="">${daysRemaining} يوم متبقي < /span></p>

                            </div>
                            <div class="fs-1">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                        </div>
                    </a>`;
                        } else if (timeLeft <= threeMonthsInMs) {
                            // Document is expiring within the next three months but more than 30 days
                            expiringSoonCount++;

                            let remainingTime =
                                `الفترة المتبقية: ${months} شهر، ${days} يوم`;

                            itemHtml = `<a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-13 text-truncate">${employee_data.employee.employee_name} <br>${doc.employeedoc_name}</h5>
                               <p class="mb-0 text-truncate"> <span class=""> ${months} شهر, ${days} يوم متبقي </span></p>
                            </div>
                            <div class="fs-1">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                        </div>
                    </a>`;
                        }

                        if (itemHtml) {
                            $('#renewal-docs-list').append(itemHtml);
                        }
                    });

                    let row_html = `<tr>
                                    <td style="text-align:center;">${index + 1}</td>
                                    <td style="text-align:center;">${employee_data.employee.employee_name}</td>
                                    <td style="text-align:center;">${doc_names}</td>
                                    <td style="text-align:center;">${created_at_date}</td>
                                    <td style="text-align:center;">${employee_data.employee.added_by}</td>
                                    <td style="text-align:center;">
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="del_employee3(${employee_data.employee.id})">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>`;
                    $('#all_company_employee tbody').append(row_html);
                });




                // Populate company documents
                response.company_docs.forEach(function(doc, index) {
                    let createdAtDate = new Date(doc.created_at);
                    let formattedDate = createdAtDate.toLocaleDateString(
                    'en-GB'); // Adjust the locale if needed

                    let doc_html = `<tr>
                                    <td style="text-align:center;">${index + 1}</td>
                                    <td style="text-align:center;">${doc.companydoc_name ?? 'no document available'}</td>
                                    <td style="text-align:center;">${doc.expiry_date}</td>
                                    <td style="text-align:center;">${doc.renewal_period}</td>
                                    <td style="text-align:center;">${formattedDate}</td>
                                    <td style="text-align:center;">${doc.added_by}</td>
                                    <td style="text-align:center;">
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="del_company_doc(${doc.id})">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>`;
                    $('#all_profile_docs tbody').append(doc_html);
                });

                // Display the counts of expiring and expired documents
                $('#expired-count').text(
                expiredCount); // Assuming you have an element with ID 'expired-count'
                $('#expiring-soon-count').text(
                expiringSoonCount); // Assuming you have an element with ID 'expiring-soon-count'

                // Initialize DataTable


                $('#all_company_employee').DataTable({
                    "sAjaxSource": "{{ url('show_company_employee') }}" + "?company_id=" + companyId,
                    "bFilter": true,
                    "sDom": 'fBtlpi',
                    'pagingType': 'numbers',
                    "ordering": true,
                    "language": {
                        search: ' ',
                        sLengthMenu: '_MENU_',
                        searchPlaceholder: 'search',
                        info: "_START_ - _END_ of _TOTAL_ items",
                    },
                    initComplete: (settings, json) => {
                        $('.dataTables_filter').appendTo('#tableSearch');
                        $('.dataTables_filter').appendTo('.search-input');
                    },
                });

            },
            error: function(xhr, status, error) {
                console.error('Error loading documents:', error);
            }
        });


    });

    function del_employee3(id) {
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
                        url: "{{ url('delete_employee3') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _token: csrfToken
                        },
                        error: function() {
                            show_notification('error', 'فشل حذف البيانات');
                        },
                        success: function(data) {
                            $('#all_company_employee').DataTable().ajax.reload();
                            show_notification('success', 'تم حذف البيانات بنجاح');
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    show_notification('success', 'تم إلغاء الحذف');
                }
            });
        }


        function del_company_doc(id) {
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
                        url: "{{ url('delete_company_doc') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _token: csrfToken
                        },
                        error: function() {
                            show_notification('error', 'فشل حذف البيانات');
                        },
                        success: function(data) {
                            $('#all_profile_docs').DataTable().ajax.reload();
                            show_notification('success', 'تم حذف البيانات بنجاح');
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    show_notification('success', 'تم إلغاء الحذف');
                }
            });
        }
</script>
