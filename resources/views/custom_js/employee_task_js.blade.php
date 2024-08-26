<script>
 $(document).ready(function() {
    // Initialize DataTables
    let companyTable = $('#company_table').DataTable();
    let employeeTable = $('#employee_table').DataTable();

    // AJAX request to fetch data
    $.ajax({
        url: '{{ route("employee_task") }}', // Replace with your route
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            populateCompanyTable(response);
            populateEmployeeTable(response);
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

        $.each(companies, function(index, company) {
            let documents = companyDocuments[company.id];

            if (documents.length > 0) {
                $.each(documents, function(docIndex, document) {
                    let row = [
                        docIndex === 0 ? index + 1 : '',
                        docIndex === 0 ? company.company_name : '',
                        document.companydoc_name,
                        `<div class="badge badge-soft-success font-size-12">${document.doc_status ?? 'Pending'}</div>`,
                        `<div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item update-status"
                                       href="#"
                                       data-id="${document.id}"
                                       data-document_name="${document.companydoc_name}"
                                       data-expiry_date="${document.expiry_date}"
                                       data-employee_id="${company.id}" // Pass the company ID as employee ID
                                       data-source="company">
                                       Update Status
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="#">Delete Document</a></li>
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

        $.each(employees, function(index, employee) {
            let documents = employeeDocuments[employee.id];
            let employee = employees.find(c => c.id === employee.employee_id);
            let company = companies.find(c => c.id === employee.employee_company); // Find the company by ID
            let companyName = company ? company.company_name : 'Unknown Company';

            if (documents.length > 0) {
                $.each(documents, function(docIndex, document) {
                    let row = [
                        docIndex === 0 ? index + 1 : '',
                        docIndex === 0 ? `${employee.employee_name}<br><small>${companyName}</small>` : '',
                        document.employeedoc_name,
                        `<div class="badge badge-soft-success font-size-12">${document.status ?? 'Pending'}</div>`,
                        `<div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item update-status"
                                       href="#"
                                       data-id="${document.id}"
                                       data-document_name="${document.employeedoc_name}"
                                       data-expiry_date="${document.expiry_date}"
                                       data-employee_id="${employee.id}" // Pass the actual employee ID
                                       data-source="employee">
                                       Update Status
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="#">Delete Document</a></li>
                            </ul>
                        </div>`
                    ];
                    employeeTable.row.add(row).draw();
                });
            } else {
                let row = [
                    index + 1,
                    `${employee.employee_name}<br><small>${companyName}</small>`,
                    'No documents found',
                    '',
                    ''
                ];
                employeeTable.row.add(row).draw();
            }
        });
    }

    // Event listener for the "Update Status" dropdown item
    $('#company_table, #employee_table').on('click', '.update-status', function(e) {
        e.preventDefault();

        // Get the document data (e.g., ID, name, expiry date) - stored in data attributes
        let documentId = $(this).data('id');
        let employeeId = $(this).data('employee_id'); // Get the employee ID
        let documentName = $(this).data('document_name');
        let expiryDate = $(this).data('expiry_date');

        // Set these values in the modal
        $('#employee_id').val(employeeId);
        $('#document_name').val(documentName);
        $('#document_id').val(documentId);
        $('#expiry_date').val(expiryDate);

        // Show the modal
        $('#employee_modal2').modal('show');
    });

    // Handle form submission
    $('#add_employee_status').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("update_employee_doc") }}', // Route to handle form submission
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                show_notification('success', 'Data updated successfully'); // Display success message
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
