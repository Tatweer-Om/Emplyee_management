<script>
    $(document).ready(function() {
        // Initialize DataTables
        let companyTable = $('#company_table').DataTable();
        let employeeTable = $('#employee_table').DataTable();

        // AJAX request to fetch data
        $.ajax({
            url: '{{ route('employee_task') }}', // Replace with your route
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                populateCompanyTable(response);
                populateEmployeeTable(response);
                renderRenewalDocuments(response.company_docs, 'Company');
                // get_employee(response.employees, 'employees');
                // get_company(response.companies, 'companies');
                const employees = response.employees || [];
                renderRenewalDocuments(response.employee_docs, 'Employee');
                console.log(response.employee_docs, 'Employee');
                console.log(response.company_docs, 'Company');

                const totalEmployees = response.employees.length;
                const totalEmployeeDocs = response.employee_docs_total
                .length; // Assuming response.employee_docs is an array
                const totalCompanies = response.companies
                .length; // Assuming response.companies is an array
                const totalCompanyDocs = response.company_docs_total
                .length; // Assuming response.company_docs is an array

                // Update the HTML elements
                $('#total-employees').text(totalEmployees);
                $('#employee-docs').html(
                    ${totalEmployeeDocs} <i class="mdi mdi-arrow-up ms-1 text-success"></i> Employee Documents
                    );
                $('#total-companies').text(totalCompanies);
                $('#company-docs').text(totalCompanyDocs);

            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + error);
            }
        });

        // Function to populate the company table

        function populateCompanyTable(data) {
            companyTable.clear(); // Clear existing table data

            let companies = data.companies;
            let companyDocuments = data.company_documents;

            // Function to calculate remaining time from the expiry date
            function getRemainingTime(expiryDate) {
                let now = new Date();
                let expiry = new Date(expiryDate);
                let diff = expiry - now;

                if (diff <= 0) return 'Expired';

                let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                let years = Math.floor(days / 365);
                days -= years * 365;
                let months = Math.floor(days / 30);
                days -= months * 30;

                let result = '';
                if (years > 0) result += `${years} year${years > 1 ? 's' : ''} `;
                if (months > 0) result += `${months} month${months > 1 ? 's' : ''} `;
                if (days > 0) result += `${days} day${days > 1 ? 's' : ''} `;

                return result + 'remaining';
            }

            $.each(companies, function(index, company) {
                let documents = companyDocuments[company.id];

                if (documents.length > 0) {
                    $.each(documents, function(docIndex, document) {
                        let statusDisplay = document.status ?
                            <div class="badge badge-soft-success font-size-12">${document.status}</div> :
                            <div class="badge badge-soft-warning font-size-12">${getRemainingTime(document.expiry_date)}</div>;

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

                                   History
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
                        'No documents found',
                        '',
                        ''
                    ];
                    companyTable.row.add(row).draw();
                }
            });
        }


        // Function to populate the employee table
        function populateEmployeeTable(data) {
            employeeTable.clear(); // Clear existing table data

            let employees = data.employees;
            let employeeDocuments = data.employee_documents;
            let companies = data.companies; // Assuming companies are passed with their names

            // Function to calculate remaining time from the expiry date
            function getRemainingTime(expiryDate) {
                let now = new Date();
                let expiry = new Date(expiryDate);
                let diff = expiry - now;

                if (diff <= 0) return 'Expired';

                let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                let years = Math.floor(days / 365);
                days -= years * 365;
                let months = Math.floor(days / 30);
                days -= months * 30;

                let result = '';
                if (years > 0) result += `${years} year${years > 1 ? 's' : ''} `;
                if (months > 0) result += `${months} month${months > 1 ? 's' : ''} `;
                if (days > 0) result += `${days} day${days > 1 ? 's' : ''} `;

                return result + 'remaining';
            }

            $.each(employees, function(index, employee) {

                let documents = employeeDocuments[employee.id];

                let companyObj = {};
                companies.forEach(company => {
                    companyObj[company.id] = company.company_name;
                });

                // Get the company name for the employee, defaulting to 'Unknown Company'
                let companyName = companyObj[employee.employee_company] || 'Unknown Company';


                if (documents.length > 0) {
                    $.each(documents, function(docIndex, document) {
                        let statusDisplay = document.status ?
                            <div class="badge badge-soft-success font-size-12">${document.status}</div> :
                            <div class="badge badge-soft-warning font-size-12">${getRemainingTime(document.expiry_date)}</div>;

                        let row = [
                            docIndex === 0 ? index + 1 : '',
                            docIndex === 0 ?
                            ${employee.employee_name}<br><small>${companyName}</small> :
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
                                   History
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
                        ${employee.employee_name}<br><small>${companyName}</small>,
                        'No documents found',
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
                noDocsItem.html(<div class="text-center">No ${type} documents under renewal.</div>);
                docsList.append(noDocsItem);
                return;
            } else {

                docs.forEach(doc => {


                    const documentName = doc.companydoc_name || doc.employeedoc_name ||
                        'Unnamed Document';
                    const holderName = doc.company_name || doc.employee_name || 'Unnamed Name';

                    let company_name = '';
                    if (type === 'Employee') {
                        company_name = doc.employee_company || 'Unnamed Company';
                    }


                    const statusMap = {
                        1: 'Under Process',
                        2: 'Received',
                        3: 'Some Issue'
                    };

                    let status = statusMap[doc.doc_status] || 'Unknown Status';

                    console.log(Document: ${documentName}, Status: ${status});

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
                                ${company_name ? <h6 class="mb-1">${company_name}</h6> : ''}
                                <div class="font-size-13">${status}</div>
                            </div>
                        </div>
                    </div>
                `);
                    docsList.append(listItem);

                });

            }

            // Loop through each document and append it to the list


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

        // Handle form submission
        $('#add_employee_status').on('submit', function(e) {
            e.preventDefault();

            let source = $('#update_source').val(); // Get the source from the hidden field

            $.ajax({
                url: '{{ route('update_employee_doc') }}', // Route to handle form submission
                type: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    show_notification('success',
                        'Data updated successfully'); // Display success message
                    $('#employee_modal2').modal('hide'); // Hide the modal
                    // Optionally, you may want to refresh the tables or update the UI
                    companyTable.ajax.reload(); // Reload the company table
                    employeeTable.ajax.reload(); // Reload the employee table
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ' + status + error);
                }
            });
        });


    });
</script>