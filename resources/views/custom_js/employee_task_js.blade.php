<script>
    $(document).ready(function() {





        $('#add_leave_modal').on('hidden.bs.modal', function() {
                $(".add_leave")[0].reset();
                $('.leave_id').val('');
                var imagePath = '{{ asset('custom_images/dummy_image/cover-image-icon.png') }}';
            });


            $('.add_leave').off().on('submit', function(e){
                e.preventDefault();
                var formdatas = new FormData($('.add_leave')[0]);
                var start_date=$('.start_date').val();
                var end_date=$('.end_date').val();

                var leave_type = $('.leave_type').val(); // Assuming leave_type is the correct class
                var image = $('#ad_cover').val(); // Getting the uploaded file path

                if (leave_type == 1) { // Check if 'Sick Leave' is selected
                    if (image == "") {
                        show_notification('error', '{{ trans("messages.add_attahment_lang", [], session("locale")) }}');
                        return false; // Stop form submission
                    }
                }
                var id=$('.leave_id').val();

                if(id!='')
                {
                    if(start_date=="" )
                    {
                        show_notification('error','<?php echo trans('messages.start_date',[],session('locale')); ?>'); return false;
                    }

                    if(leave_type=="" )
                    {
                        show_notification('error','<?php echo trans('messages.leave_type',[],session('locale')); ?>'); return false;
                    }
                    if(end_date=="" )
                    {
                        show_notification('error','<?php echo trans('messages.end_date',[],session('locale')); ?>'); return false;
                    }




                    var str = $(".add_leave").serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{ url('update_leave') }}",
                        data: formdatas,
                        contentType: false,
                        processData: false,
                        success: function(data) {

                            show_notification('success','<?php echo trans('messages.data_updated_successful_lang',[],session('locale')); ?>');
                            $('#add_leave_modal').modal('hide');
                            return false;
                        },
                        error: function(data)
                        {

                            show_notification('error','<?php echo trans('messages.data_updated_failed_lang',[],session('locale')); ?>');
                            console.log(data);
                            return false;
                        }
                    });
                }
                else if(id==''){


                    if(start_date=="" )
                    {
                        show_notification('error','<?php echo trans('messages.start_date',[],session('locale')); ?>'); return false;
                    }

                    if(leave_type=="" )
                    {
                        show_notification('error','<?php echo trans('messages.leave_type',[],session('locale')); ?>'); return false;
                    }
                    if(end_date=="" )
                    {
                        show_notification('error','<?php echo trans('messages.end_date',[],session('locale')); ?>'); return false;
                    }


                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var formdatas = new FormData($(".add_leave")[0]); // Create FormData
                    formdatas.append('_token', csrfToken);
                    var str = $(".add_leave").serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{ url('add_leave') }}",
                        data: formdatas,
                        contentType: false,
                        processData: false,
                        success: function(data) {

                            if(data.status==3)

                            {
                                show_notification('error','<?php echo trans('messages.you_dont_have balance',[],session('locale')); ?>');
                                return;
                            }
                            show_notification('success','<?php echo trans('messages.data_added_successful_lang',[],session('locale')); ?>');
                            $('#add_leave_modal').modal('hide');
                            $(".add_leave")[0].reset();
                            return false;
                            },
                        error: function(data)
                        {

                            show_notification('error','<?php echo trans('messages.data_added_failed_lang',[],session('locale')); ?>');
                            console.log(data);
                            return false;
                        }
                    });

                }

            });



        var selectedCompId = '';

        $(document).on('click', 'a[data-bs-toggle="modal"]', function() {
            // Retrieve the 'data-comp-id' attribute value and store it
            selectedCompId = $(this).data('comp-id');
        });

        $('#add_employee4').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            formData += '&comp_id=' + encodeURIComponent(selectedCompId);
            var title = $('.employee_name').val();
            var company = $('.employee_company').val();

            if (title == "") {
                show_notification('error', 'يرجى إضافة اسم الموظف');
                return false;
            }

            if (company === "") {
                show_notification('error', 'يرجى اختيار الشركة.');
                return false;
            }

            $.ajax({
                url: '{{ url('add_employee4') }}', // The URL to send the data to
                type: 'POST', // HTTP method
                data: formData, // Data to send
                success: function(response) {
                    show_notification('success', 'تمت إضافة الموظف بنجاح');
                    window.location.reload();
                    var id = response.last_id;
                    var url = window.open('/employee_document_addition/' + id);



                    $('#add_employee4')[0].reset();
                    $('#employee_modal4').modal('hide');
                },
                error: function(xhr) {
                    show_notification('error', 'فشل إضافة الموظف');
                }
            });
        });

        // add_Company

        $('#add_company2').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            var title = $('.company_name').val();

            if (title == "") {
                show_notification('error', 'يرجى إضافة اسم الشركة');
                return false;
            }

            $.ajax({
                url: '{{ url('add_company4') }}', // The URL to send the data to
                type: 'POST', // HTTP method
                data: formData, // Data to send
                success: function(response) {
                    show_notification('success', 'تمت إضافة الشركة بنجاح');
                    var id = response.last_id;
                    var url = window.open('/document_addition/' + id);
                    $('#add_company2')[0].reset();
                    $('#company_modal5').modal('hide');
                },
                error: function(xhr) {
                    show_notification('error', 'فشل إضافة الشركة');
                }
            });
        });


        //datatable

        // Initialize DataTables
        let companyTable = $('#company_table').DataTable();
        let employeeTable = $('#employee_table').DataTable();
        $(".employee_company").select2({
            dropdownParent: $("#employee_modal4")
        });

        // AJAX request to fetch data
        $.ajax({
            url: '{{ route('employee_task') }}', // استبدل بالمسار الخاص بك
            type: 'GET',
            dataType: 'json',
            data: {
                emp_id: $('#emp_id').val() // Send emp_id along with the request
            },
            success: function(response) {
                populateCompanyTable(response);
                populateEmployeeTable(response);
                populatecomps(response)

                renderRenewalDocuments(response.company_docs, 'شركة');

                const employees = response.employees || [];
                renderRenewalDocuments(response.employee_docs, 'موظف');
                console.log(response.employee_docs, 'موظف');
                console.log(response.company_docs, 'شركة');

                const totalEmployees = response.employees.length;
                const totalEmployeeDocs = response.employee_docs_total
                    .length; // افترض أن response.employee_docs هو مصفوفة
                const totalCompanies = response.companies
                    .length; // افترض أن response.companies هو مصفوفة
                const totalCompanyDocs = response.company_docs_total
                    .length; // افترض أن response.company_docs هو مصفوفة

                // تحديث عناصر HTML
                $('#total-employees').text(totalEmployees);
                $('#employee-docs').html(
                    `${totalEmployeeDocs} <i class="mdi mdi-arrow-up ms-1 text-success"></i> مستندات الموظفين`
                );
                $('#total-companies').text(totalCompanies);
                $('#company-docs').text(totalCompanyDocs);
            },
            error: function(xhr, status, error) {
                console.log('خطأ AJAX: ' + status + error);
            }
        });

        function populateCompanyTable(data) {
    companyTable.clear(); // مسح بيانات الجدول الحالية

    let companies = data.companies;
    let companyDocuments = data.company_documents;
    let serialNumber = 1; // Track the serial number globally
    let allDocuments = []; // Array to store all documents with company info

    // دالة لحساب الوقت المتبقي من تاريخ الانتهاء
    function getRemainingTime(expiryDate) {
        let now = new Date();
        let expiry = new Date(expiryDate);
        let diff = expiry - now;

        if (diff <= 0) return 'منتهي الصلاحية';

        let days = Math.floor(diff / (1000 * 60 * 60 * 24));
        let years = Math.floor(days / 365);
        days -= years * 365;
        let months = Math.floor(days / 30);
        days -= months * 30;

        let result = '';
        if (years > 0) result += `${years} سنة `;
        if (months > 0) result += `${months} شهر `;
        if (days > 0) result += `${days} يوم `;
        else if (diff > 0 && diff <= (1000 * 60 * 60 * 24)) result += 'يوم واحد ';

        return result + 'متبقي';
    }

    // Combine all documents from all companies into one array
    $.each(companies, function(index, company) {
        let documents = companyDocuments[company.id] || []; // تأكد أن documents هو مصفوفة

        if (documents.length > 0) {
            // Attach the company info to each document if documents exist
            $.each(documents, function(docIndex, document) {
                allDocuments.push({
                    company: company,
                    document: document
                });
            });
        } else {
            // Add an entry for companies with no documents
            allDocuments.push({
                company: company,
                document: null // No document for this company
            });
        }
    });

    // Sort all documents by expiry_date in ascending order, placing companies with no documents at the bottom
    allDocuments.sort(function(a, b) {
        if (!a.document && !b.document) return 0;
        if (!a.document) return 1; // Place companies with no documents at the bottom
        if (!b.document) return -1;
        return new Date(a.document.expiry_date) - new Date(b.document.expiry_date);
    });

    // Render the sorted documents into the table
    $.each(allDocuments, function(index, item) {
        let company = item.company;
        let document = item.document;

        if (document) {
            // If the company has documents, display them
            let statusDisplay = document.doc_status ?
                `<div class="badge badge-soft-success font-size-12">${document.doc_status}</div>` :
                `<div class="badge badge-soft-danger font-size-12">${getRemainingTime(document.expiry_date)}</div>`;

            let row = [
                serialNumber++, // Increment the serial number for each document
                company.company_name, // Always show the company name
                document.companydoc_name,
                statusDisplay,
                `<div class="dropdown">
                    <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item update-status"
                                href="javascript:void(0);"
                                style="display:block; text-align:center;"
                                data-document-id="${document.id}"
                                data-source="company">
                                تاريخ
                            </a>
                            <a class="dropdown-item" href="/document_addition/${document.company_id}">
                                إضافة مستند</a>
                            <a class="dropdown-item renew_modal"
                                href="javascript:void(0);"
                                data-document-id="${document.id}"
                                style="display:block; text-align:center;"
                                data-doc-name="${document.companydoc_name}"
                                data-source="2"> تجديد
                            </a>
                        </li>
                    </ul>
                </div>`
            ];

            let tableRow = companyTable.row.add(row).draw();
            // Apply the color class to the newly added row if needed
            $(tableRow.node()).addClass('');
        } else {
            // If the company has no documents, display a placeholder row
            let row = [
                serialNumber++, // Increment the serial number even when there are no documents
                company.company_name,
                ' لا يوجد مستند ',
                '',
                `<div class="dropdown">
                    <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="/document_addition/${company.id}">
                                إضافة مستند</a>
                        </li>
                    </ul>
                </div>`
            ];

            let tableRow = companyTable.row.add(row).draw();
            // Apply a class to distinguish rows without documents if necessary
            $(tableRow.node()).addClass('company-row-no-docs');
        }




    });
}




function populateEmployeeTable(data) {
    employeeTable.clear(); // Clear the current table data

    let employees = data.employees;
    let employeeDocuments = data.employee_documents;
    let companies = data.companies; // Assuming company names are passed
    let serialNumber = 1; // Track the serial number globally

    // Function to calculate remaining time from expiry date
    function getRemainingTime(expiryDate) {
        let now = new Date();
        let expiry = new Date(expiryDate);
        let diff = expiry - now;

        if (diff <= 0) return 'منتهي الصلاحية';

        let days = Math.floor(diff / (1000 * 60 * 60 * 24));
        let years = Math.floor(days / 365);
        days -= years * 365;
        let months = Math.floor(days / 30);
        days -= months * 30;

        let result = '';
        if (years > 0) result += `${years} سنة `;
        if (months > 0) result += `${months} شهر `;
        if (days > 0) result += `${days} يوم `;
        else if (diff > 0 && diff <= (1000 * 60 * 60 * 24)) result += 'يوم واحد ';

        return result + 'متبقي';
    }

    // Build a mapping of company IDs to company names
    let companyObj = {};
    companies.forEach(company => {
        companyObj[company.id] = company.company_name;
    });

    // Combine all employee documents into one array
    let combinedDocuments = [];

    $.each(employees, function(index, employee) {
        let documents = employeeDocuments[employee.id] || [];
        let companyName = companyObj[employee.employee_company] || 'شركة غير معروفة';

        if (documents.length > 0) {
            // If documents exist, loop through them and add to the combinedDocuments array
            $.each(documents, function(docIndex, document) {
                combinedDocuments.push({
                    employee: employee,
                    document: document,
                    companyName: companyName
                });
            });
        } else {
            // If no documents found, add a placeholder entry for the employee
            combinedDocuments.push({
                employee: employee,
                document: null,
                companyName: companyName
            });
        }
    });

    // Sort the combined documents by expiry date in ascending order, putting those with no documents at the bottom
    combinedDocuments.sort(function(a, b) {
        if (!a.document && !b.document) return 0;
        if (!a.document) return 1; // Place employees with no documents at the bottom
        if (!b.document) return -1;
        return new Date(a.document.expiry_date) - new Date(b.document.expiry_date);
    });

    // Render the sorted documents into the table
    $.each(combinedDocuments, function(index, entry) {
        let employee = entry.employee;
        let document = entry.document;
        let companyName = entry.companyName;

        if (document) {
            let statusDisplay = document.doc_status ?
                `<div class="badge badge-soft-success font-size-12">${document.doc_status}</div>` :
                `<div class="badge badge-soft-danger font-size-12">${getRemainingTime(document.expiry_date)}</div>`;

            let row = [
                serialNumber++,
                `<a class="dropdown-item" href="/employee_document_addition/${employee.id}">${employee.employee_name} </a><small>${companyName}</small>`,
                document.employeedoc_name,
                statusDisplay,
                `<div class="dropdown">
                    <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item update-status"
                               href="#"
                               data-document-id="${document.id}"
                               data-source="employee">
                               تاريخ
                            </a>
                            <a class="dropdown-item" href="/employee_document_addition/${employee.id}">إضافة مستند</a>
                            <a class="dropdown-item renew_modal"
                               href="#"
                               data-document-id="${document.id}"
                               data-doc-name="${document.employeedoc_name}"
                               data-source="1">
                              تجديد
                            </a>
                        </li>
                    </ul>
                </div>`
            ];
            employeeTable.row.add(row).draw();
        } else {
            // Render a row for employees without documents
            let row = [
                serialNumber++,
                `<a class="dropdown-item" href="/employee_document_addition/${employee.id}">${employee.employee_name} </a><br><small>${companyName}</small>`,
                'لا يوجد مستند',
                '',
                `<div class="dropdown">
                    <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="/employee_document_addition/${employee.id}">إضافة مستند</a>
                        </li>
                    </ul>
                </div>`
            ];
            employeeTable.row.add(row).draw();
        }
    });
}



        function populatecomps(data) {
            let companies = data.companies;

            // Ensure companies is an array and is defined
            if (Array.isArray(companies) && companies.length > 0) {
                let html = ''; // Initialize HTML as an empty string

                // Iterate over each company
                let sr = 1;
                companies.forEach(comp => {
                    // Build the HTML string for each company
                    html += `<tr>
                 <td style="text-align:center;">${sr++}</td>
                        <td style="text-align:center;">${comp.company_name}</td>
                        <td style="text-align:center;">${comp.added_by}</td>
                        <td style="text-align:center;">${new Date(comp.created_at).toLocaleDateString()}</td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>

                                        <a class="dropdown-item" href="/document_addition/${comp.id || ''}">
                                           إضافة مستند
                                        </a>
                                        <a data-bs-toggle="modal" class="dropdown-item" data-bs-target="#employee_modal4" data-comp-id="${comp.id || ''}">
إضافة عامل                                            </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>`;
                });

                // Append or set the HTML in the target element (replace 'your-table-body-id' with your actual table body ID)
                document.getElementById('comps_all_tbody').innerHTML = html;
            } else {
                console.error('Companies is not defined or is not an array');
            }
        }


        function renderRenewalDocuments(docs, type) {
            const docsList = $('#renewl_list');

            if (!docs || docs.length === 0) {
                const noDocsItem = $('<li class="activity-list activity-border"></li>');
                noDocsItem.html(`<div class="text-center">لا يوجد مستندات ${type} قيد التجديد.</div>`);
                docsList.append(noDocsItem);
                return;
            } else {

                docs.forEach(doc => {

                    const documentName = doc.companydoc_name || doc.employeedoc_name ||
                        'مستند غير مسمى';
                    const holderName = doc.company_name || doc.employee_name || 'اسم غير معروف';

                    let company_name = '';
                    if (type === 'موظف') {
                        company_name = doc.employee_company || 'شركة غير معروفة';
                    }

                    let status = (doc.doc_status === 2) ? 'قيد المعالجة' : '';


                    console.log(`مستند: ${documentName}, الحالة: ${status}`);

                    const listItem = $('<li class="activity-list activity-border"></li>');

                    listItem.html(`
            <div class="activity-icon avatar-md">
                <span class="avatar-title bg-primary-subtle text-primary rounded-circle">
                    <i class="mdi mdi-file-document-outline font-size-24"></i>
                </span>
            </div>
            <div class="timeline-list-item">
                <div class="d-flex">
                    <div class="flex-grow-1 overflow-hidden me-4">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                aria-valuemax="100" style="width: 50%"></div>
                        </div>
                    </div>
                    <div class="flex-shrink-0 text-end me-3">
                        <h6 class="mb-1">${holderName}</h6>
                        <h6 class="mb-1">${documentName}</h6>
                        ${company_name ? `<h6 class="mb-1">${company_name}</h6>` : ''}
                        <div class="font-size-13">${status}</div>
                    </div>
                </div>
            </div>
        `);
                    docsList.append(listItem);

                });

            }
        }


        // Event listener for the "Update Status" dropdown item
        $('#company_table, #employee_table').on('click', '.update-status', function(e) {
            e.preventDefault();

            // Get the document data (e.g., ID, name, expiry date) - stored in data attributes
            let documentId = $(this).data('id');
            let employeeId = $(this).data('employee_id'); // Get the employee ID
            let documentName = $(this).data('document_name');
            let expiryDate = $(this).data('expiry_date');
            let source = $(this).data('source'); // Get the source (company or employee)

            // Set these values in the modal
            $('#employee_id').val(employeeId);
            $('#document_name').val(documentName);
            $('#document_id').val(documentId);
            $('#expiry_date').val(expiryDate);
            $('#update_source').val(source); // Store the source in a hidden field

            // Show the modal
            $('#employee_modal2').modal('show');
        });


        $(document).on('click', '.update-status', function(e) {
            e.preventDefault();

            // Get the document ID and source from the data attributes
            let documentId = $(this).data('document-id');
            let source = $(this).data('source'); // Assuming you have a data-source attribute

            // Call the function to fetch document history with both documentId and source
            fetchDocumentHistory(documentId, source);
        });

        function fetchDocumentHistory(documentId, source) {
            $.ajax({
                url: '{{ route('document_history') }}', // رابط المسار الخاص بك هنا
                type: 'GET',
                data: {
                    id: documentId,
                    source: source // تضمين المصدر في بيانات الطلب
                },
                success: function(response) {
                    // تعبئة النموذج بالبيانات المستلمة
                    populateModalWithHistory(response.data);

                    // عرض النموذج
                    $('#employee_modal2').modal('show');
                },
                error: function(xhr) {
                    console.log("حدث خطأ: " + xhr.status + " " + xhr.statusText);
                }
            });
        }

        function populateModalWithHistory(data) {
            // مسح أي صفوف موجودة في جسم الجدول
            let tableBody = $('#all_profile_docs tbody');
            tableBody.empty();

            // التحقق مما إذا كانت هناك بيانات تاريخ
            if (data.length > 0) {
                // التكرار عبر كل سجل تاريخ
                data.forEach(function(item, index) {
                    // التحقق مما إذا كانت new_expiry فارغة والتعامل معها وفقًا لذلك
                    let newExpiry = item.new_expiry ? `انتهاء الصلاحية الجديد: ${item.new_expiry}` :
                        'انتهاء الصلاحية الجديد: لم تتم إضافته بعد';
                    let statusText = item.status == 1 ? 'قيد المعالجة' : item.status == 2 ?
                        'مكتمل' : 'حالة غير معروفة';
                    let createdAt = new Date(item.created_at);
                    let formattedDate = createdAt.toLocaleDateString('en-GB'); // تنسيق كـ dd-mm-yyyy
                    let formattedTime = createdAt.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit'
                    }); // تنسيق كـ hh:mm AM/PM

                    // إنشاء صف جدول لكل سجل تاريخ
                    let tableRow = `
            <tr>
                <td style="text-align:center;">${index + 1}</td>
                <td style="text-align:center;">${item.doc_name}</td>
                <td style="text-align:center;">
                    تاريخ انتهاء الصلاحية القديم: ${item.old_expiry} <br> ${newExpiry}
                </td>
                <td style="text-align:center;">${statusText}</td>
                <td style="text-align:center; white-space: pre-line;">${item.notes}</td>
                <td style="text-align:center;">${formattedDate} ${formattedTime}</td>
                <td style="text-align:center;">${item.added_by}</td>
            </tr>
        `;
                    // إلحاق الصف بجسم الجدول
                    tableBody.append(tableRow);
                });
            } else {
                // إذا لم يكن هناك تاريخ، عرض رسالة
                let emptyRow = `
        <tr>
            <td colspan="7" class="text-center">لا يوجد تاريخ متاح لهذا المستند.</td>
        </tr>
    `;
                tableBody.append(emptyRow);
            }
        }




        // Handle the click event for the renew_modal link
        // Handle the initial click on the 'renew_modal' link
        $(document).on('click', '.renew_modal', function(e) {
            e.preventDefault();

            // Get document details from data attributes
            let documentId = $(this).data('document-id');
            let documentName = $(this).data('doc-name');
            let source = $(this).data('source');

            // Call the function to populate and show the modal
            showRenewModal(documentId, documentName, source);
        });

        // Function to show the renewal modal
        function showRenewModal(documentId, documentName, source) {
            $.ajax({
                url: '{{ route('document_renew') }}', // Your route URL for fetching document details
                type: 'GET',
                data: {
                    id: documentId,
                    source: source // Include source in the request data
                },
                success: function(response) {
                    // Ensure response contains the expected data
                    let expiryDate = response.data.expiry_date || 'Not available';
                    let documentExpiryDate = expiryDate; // Adjust if needed

                    // Populate the modal with received data
                    $('#renew_modal .modal-body').html(`
                <div class="row">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">اسم المستند: ${documentName}</span>
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">تاريخ الانتهاء: ${documentExpiryDate}</span>
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <button class="btn btn-success" id="confirm-renew-btn" data-source="${source}" data-document-id="${documentId}">تجديد</button>
                            </div>
                        </div><!-- نهاية محتوى الكارد -->
                    </div><!-- نهاية الكارد -->
                </div>
            `);


                    // Show the modal
                    $('#renew_modal').modal('show');
                },
                error: function(xhr) {
                    console.log("Error occurred: " + xhr.status + " " + xhr.statusText);
                }
            });
        }

        // Handle the renewal confirmation
        $(document).on('click', '#confirm-renew-btn', function(e) {
            e.preventDefault();

            let documentId = $(this).data('document-id');
            let source = $(this).data('source');

            // Perform the renewal action
            $.ajax({
                url: '{{ route('document_renew_confirm') }}', // Your route URL for confirming renewal
                type: 'POST',
                data: {
                    id: documentId,
                    source: source,
                    _token: '{{ csrf_token() }}' // Include CSRF token for POST requests
                },
                success: function(response) {
                    // Handle success response (e.g., update the table, show a success message)
                    show_notification('success', 'تمت إضافة الشركة بنجاح');
                    $('#renew_modal').modal('hide');
                    window.location.reload();
                    // Optionally, you can refresh the table or show a success message
                },
                error: function(xhr) {
                    show_notification('error', 'تمت إضافة الشركة بنجاح');
                    console.log("Error occurred: " + xhr.status + " " + xhr.statusText);
                    window.location.reload();
                }
            });
        });



    });

    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('start_date');
        const toDateInput = document.getElementById('end_date');
        const daysInput = document.getElementById('days');
        const daysContainer = document.getElementById('days_container');

        function calculateDays() {
            const startDate = new Date(startDateInput.value);
            const toDate = new Date(toDateInput.value);

            // Ensure both dates are valid
            if (startDate && toDate && startDate <= toDate) {
                const diffTime = Math.abs(toDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Including both start and end days
                daysInput.value = diffDays;

                // Show the duration input
                daysContainer.style.display = 'block';
            } else {
                // Hide the duration input if dates are invalid or not filled
                daysContainer.style.display = 'none';
                daysInput.value = '';
            }
        }

        // Attach event listeners to both date inputs
        startDateInput.addEventListener('change', calculateDays);
        toDateInput.addEventListener('change', calculateDays);
    });



    document.getElementById('ad_cover').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('ad_cover_preview');
        const fileNameElement = document.getElementById('file_name'); // Reference to file name display element
        const fileReader = new FileReader();

        if (file) {
            // Display the file name
            fileNameElement.textContent = file.name;

            // Check if the uploaded file is an image
            if (file.type.startsWith('image/')) {
                fileReader.onload = function(e) {
                    // Show the uploaded image
                    preview.src = e.target.result;
                    preview.alt = 'Uploaded Image';
                };
                fileReader.readAsDataURL(file);
            }
            // Check if the uploaded file is a PDF
            else if (file.type === 'application/pdf') {
                // Show the PDF icon instead of the image
                preview.src = "{{ asset('images/pdf.jpg') }}"; // Use your PDF icon image path
                preview.alt = 'PDF File';
            }
            // If another file type, you can handle it as needed
            else {
                preview.src = "{{ asset('images/cover-image-icon.png') }}"; // Default icon
                preview.alt = 'Upload Cover';
                fileNameElement.textContent = ''; // Clear file name if unsupported type
                alert('Unsupported file type. Please upload an image or a PDF.');
            }
        } else {
            fileNameElement.textContent = ''; // Clear file name if no file is selected
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const leaveTypeSelect = document.getElementById('leave_type');
        const fileUploadSection = document.getElementById('ad_cover_container');

        leaveTypeSelect.addEventListener('change', function () {
            const selectedValue = leaveTypeSelect.value;

            if (selectedValue === '1') { // Show file upload for Sick Leave
                fileUploadSection.style.display = 'block';
            } else { // Hide file upload for other leave types
                fileUploadSection.style.display = 'none';
            }
        });
    });





</script>
