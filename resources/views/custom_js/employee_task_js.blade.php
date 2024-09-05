<script>
    $(document).ready(function() {

        $('#add_employee4').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
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
            success: function(response) {
                populateCompanyTable(response);
                populateEmployeeTable(response);
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


        // Function to populate the company table

        function populateCompanyTable(data) {
            companyTable.clear(); // مسح بيانات الجدول الحالية

            let companies = data.companies;
            let companyDocuments = data.company_documents;

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
                if (years > 0) result += `${years} سنة${years > 1 ? '' : ''} `;
                if (months > 0) result += `${months} شهر${months > 1 ? '' : ''} `;
                if (days > 0) result += `${days} يوم${days > 1 ? '' : ''} `;

                return result + 'متبقي';
            }

            $.each(companies, function(index, company) {
                let documents = companyDocuments[company.id] || []; // تأكد أن documents هو مصفوفة

                if (documents.length > 0) {
                    $.each(documents, function(docIndex, document) {
                        let statusDisplay = document.doc_status ?
                            `<div class="badge badge-soft-success font-size-12">${document.doc_status}</div>` :
                            `<div class="badge badge-soft-warning font-size-12">${getRemainingTime(document.expiry_date)}</div>`;

                        let row = [
                            docIndex === 0 ? index + 1 : '',
                            docIndex === 0 ? company.company_name : '',
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
                                   href="#"
                                   data-document-id="${document.id}"
                                   data-source="company"> <!-- تمت إضافة مصدر بيانات السمة -->
                                   تاريخ
                                </a>
                            </li>
                        </ul>
                    </div>`
                        ];
                        companyTable.row.add(row).draw();
                    });
                } else {
                    let row = [
                        index + 1,
                        company.company_name,
                        'لم يتم العثور على مستندات',
                        '',
                        ''
                    ];
                    companyTable.row.add(row).draw();
                }
            });
        }



        // Function to populate the employee table
        function populateEmployeeTable(data) {
            employeeTable.clear(); // مسح بيانات الجدول الحالية

            let employees = data.employees;
            let employeeDocuments = data.employee_documents;
            let companies = data.companies; // على افتراض أن أسماء الشركات قد تم تمريرها

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
                if (years > 0) result += `${years} سنة${years > 1 ? '' : ''} `;
                if (months > 0) result += `${months} شهر${months > 1 ? '' : ''} `;
                if (days > 0) result += `${days} يوم${days > 1 ? '' : ''} `;

                return result + 'متبقي';
            }

            $.each(employees, function(index, employee) {
                // تأكد أن المستندات هي دائماً مصفوفة، حتى لو لم تكن معرفة
                let documents = employeeDocuments[employee.id] || [];

                let companyObj = {};
                companies.forEach(company => {
                    companyObj[company.id] = company.company_name;
                });

                // الحصول على اسم الشركة للموظف، والافتراضي هو 'شركة غير معروفة'
                let companyName = companyObj[employee.employee_company] || 'شركة غير معروفة';

                if (documents.length > 0) {
                    $.each(documents, function(docIndex, document) {
                        let statusDisplay = document.doc_status ?
                            `<div class="badge badge-soft-success font-size-12">${document.doc_status}</div>` :
                            `<div class="badge badge-soft-warning font-size-12">${getRemainingTime(document.expiry_date)}</div>`;

                        let row = [
                            docIndex === 0 ? index + 1 : '',
                            docIndex === 0 ?
                            `${employee.employee_name}<br><small>${companyName}</small>` :
                            '',
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
                            </li>
                        </ul>
                    </div>`
                        ];
                        employeeTable.row.add(row).draw();
                    });
                } else {
                    let row = [
                        index + 1,
                        `${employee.employee_name}<br><small>${companyName}</small>`,
                        'لم يتم العثور على مستندات',
                        '',
                        ''
                    ];
                    employeeTable.row.add(row).draw();
                }
            });
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

                    const statusMap = {
                        1: 'قيد المعالجة',
                        2: 'قيد المعالجة',
                        3: 'هناك مشكلة'
                    };

                    let status = statusMap[doc.doc_status] || 'حالة غير معروفة';

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


    });
</script>
