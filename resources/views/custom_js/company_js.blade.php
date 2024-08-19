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
            // var imagePath = '{{ asset('images/dummy_image/no_image.png') }}';
            // $('#img_tag').attr('src',imagePath);
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
                searchPlaceholder: 'search',
                info: "_START_ - _END_ of _TOTAL_ items",
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
                    show_notification('error', '<?php echo trans('messages.data_add_company_name_lang', [], session('locale')); ?>');
                    return false;
                }
                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_company").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_company') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('success', '<?php echo trans('messages.data_update_success_lang', [], session('locale')); ?>');
                        $('#company_modal').modal('hide');
                        $('#all_company').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', '<?php echo trans('messages.data_update_failed_lang', [], session('locale')); ?>');
                        $('#all_company').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            } else if (id == '') {


                if (title == "") {
                    show_notification('error', '<?php echo trans('messages.data_add_company_name_lang', [], session('locale')); ?>');
                    return false;

                }

                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_company").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_company') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_company').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.data_add_success_lang', [], session('locale')); ?>');
                        $('.company_modal').modal('hide');
                        $(".add_company")[0].reset();
                        return false;
                    },
                    error: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>');
                        $('#all_company').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });

            }

        });
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
                // $('#global-loader').hide();
                // after_submit();
                if (fetch != "") {
                    // Define a variable for the image path


                    $(".company_name").val(fetch.company_name);
                    $(".company_email").val(fetch.company_email);
                    $(".company_phone").val(fetch.company_phone);
                    $(".office_user").val(fetch.office_user).trigger('change');
                    $(".company_address").val(fetch.company_address);
                    $(".company_detail").val(fetch.company_detail);
                    $(".cr_no").val(fetch.cr_no);

                    $(".company_id").val(fetch.company_id);
                    $(".modal-title").html('<?php echo trans('messages.update_lang', [], session('locale')); ?>');
                }
            },
            error: function(html) {
                // $('#global-loader').hide();
                // after_submit();
                show_notification('error', '<?php echo trans('messages.edit_failed_lang', [], session('locale')); ?>');
                console.log(html);
                return false;
            }
        });
    }

    function del(id) {
        Swal.fire({
            title: 'Are You sure to Delete',
            text: 'Delete',
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Delete',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                // $('#global-loader').show();
                // before_submit();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_company') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        _token: csrfToken
                    },
                    error: function() {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', '<?php echo trans('messages.delete_failed_lang', [], session('locale')); ?>');
                    },
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_company').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang', [], session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang', [], session('locale')); ?>');
            }
        });
    }



    //employee
    function add_employee(id) {
        // Set the value of the select box
        $('.employee_company').val(id).trigger('change');

        // Trigger the form submission

    }


    $('.add_employee').off().on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var formdatas = new FormData(this); // Create FormData object from the form
        var title = $('.employee_name').val(); // Get employee name
        var id = $('.employee_id').val(); // Get employee ID

        // Validate form input
        if (title === "") {
            show_notification('error', '<?php echo trans('messages.data_add_employee_name_lang', [], session('locale')); ?>');
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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function(data) {
                $('#all_employee').DataTable().ajax.reload(); // Reload DataTable
                show_notification('success', '<?php echo trans('messages.data_add_success_lang', [], session('locale')); ?>'); // Show success notification
                $('.employee_modal').modal('hide'); // Hide the modal
                $(".add_employee")[0].reset(); // Reset the form
            },
            error: function(data) {
                show_notification('error', '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>'); // Show error notification
                $('#all_employee').DataTable().ajax.reload(); // Reload DataTable
                console.log(data); // Log error for debugging
            }
        });
    });



    //company_profile_js





    // function loadCompanyDocs(companyId) {
    //     console.log('Selected Company ID:', companyId);

    //     $.ajax({
    //         url: "{{ url('show_company_doc') }}", // The route that will handle the request
    //         type: "POST", // Use "POST" to send data securely
    //         data: {
    //             company_id: companyId, // Pass the companyId
    //             _token: '{{ csrf_token() }}' // Include the CSRF token for security
    //         },
    //         success: function(response) {


    //             // Clear and destroy the existing DataTable instance
    //             var table = $('#all_profile_docs').DataTable();
    //             table.clear().destroy();

    //             // Initialize DataTable with the new data
    //             $('#all_profile_docs').DataTable({
    //                 "data": response.aaData,

    //                 "bFilter": true,
    //                 "sDom": 'fBtlpi',
    //                 'pagingType': 'numbers',
    //                 "ordering": true,
    //                 "language": {
    //                     search: ' ',
    //                     sLengthMenu: '_MENU_',
    //                     searchPlaceholder: 'search',
    //                     info: "_START_ - _END_ of _TOTAL_ items",
    //                 },
    //                 "initComplete": function(settings, json) {
    //                     $('.dataTables_filter').appendTo('#tableSearch');
    //                     $('.dataTables_filter').appendTo('.search-input');
    //                 }
    //             });

    //             // Redirect to the company profile page
    //             window.location.href = 'company_profile/' + companyId;
    //         },
    //         error: function(xhr, status, error) {
    //             // Handle errors here
    //             console.log('Error:', error);
    //         }
    //     });
    // }

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

                const today = new Date();

            // Define the three months period (90 days)
            const threeMonthsInMs = 3 * 30 * 24 * 60 * 60 * 1000;

            response.employee_docs.forEach(function(employee_data) {
                employee_data.documents.forEach(function(doc) {
                    const expiryDate = new Date(doc.expiry_date);
                    const timeLeft = expiryDate - today;

                    // Check if the document is expiring within three months
                    if (timeLeft <= threeMonthsInMs) {
                        const remainingMonths = Math.ceil(timeLeft / (30 * 24 * 60 * 60 * 1000));

                        const itemHtml = `<a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="font-size-13 text-truncate">${employee_data.employee.employee_name}</h5>
                                                        <p class="mb-0 text-truncate">${doc.employeedoc_name} <span class="">/${remainingMonths} months Left</span></p>
                                                    </div>
                                                    <div class="fs-1">
                                                        <i class="mdi mdi-calendar"></i>
                                                    </div>
                                                </div>
                                            </a>`;

                        $('#renewal-docs-list').append(itemHtml);
                    }
                });
            });

                // Populate employee documents
                response.employee_docs.forEach(function(employee_data, index) {
                    let employee_html =
                        `<div class="col-lg-4">
                                                <div class="list-group list-group-flush border border-primary rounded">
                                                    <a href="javascript: void(0);" class="list-group-item text-muted pb-3 pt-0 px-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="font-size-13 text-truncate">${employee_data.employee.employee_name}</h5>`;
                    employee_data.documents.forEach(function(doc) {
                        employee_html += `<p class="mb-0 text-truncate">${doc.employeedoc_name}-تاريخ الانتهاء
                                                <span class="badge bg-danger-subtle text-primary rounded-pill ms-1 float-end font-size-13">${doc.expiry_date}</span>
                                              </p>`;
                    });
                    employee_html += `</div></div></a></div></div>`;
                    $('#employee_docs_list').append(employee_html);
                });

                // Populate company documents
                response.company_docs.forEach(function(doc, index) {
                    let createdAtDate = new Date(doc.created_at);
                    let formattedDate = createdAtDate.toLocaleDateString(
                    'en-GB'); // You can adjust the locale as needed

                    let doc_html = `<tr>
                                        <td style="text-align:center;">${index + 1}</td>
                                        <td style="text-align:center;">${doc.companydoc_name}</td>
                                        <td style="text-align:center;">${doc.expiry_date}</td>
                                        <td style="text-align:center;">${doc.renewal_period}</td>
                                        <td style="text-align:center;">${formattedDate}</td>
                                        <td style="text-align:center;">${doc.added_by}</td>
                                        <td style="text-align:center;">
                                           <div class="dropdown" style="text-align:center";>
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="edit_company_doc(' . $value->id . ')">Edit</a></li>
                            <li><a class="dropdown-item"  href="javascript:void(0);" onclick="printdocument(' . $value->document_id . ')">Print</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="del_company_doc(' . $value->id . ')">Delete</a></li>
                        </ul>
                    </div>
                                        </td>
                                    </tr>`;
                    $('#all_profile_docs tbody').append(doc_html);
                });
                $('.badge-primary-subtle').eq(0).text(response.employee_docs
                .length); // Update with the actual count
                $('.badge-primary-subtle').eq(1).text(response.company_docs
                .length); // Update with the actual count
                $('.badge-primary-subtle').eq(2).text(response.employee_docs.reduce((total, data) =>
                    total + data.documents.length, 0)); // Total employee docs
            },
            error: function(xhr, status, error) {
                console.error('Error loading documents:', error);
            }
        });
    });
</script>
