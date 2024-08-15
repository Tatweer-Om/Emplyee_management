<script>
     document.addEventListener('DOMContentLoaded', function() {
    const rowContainer = document.getElementById('row-container');
    const tableBody = document.querySelector('table tbody');
    const companyId = '{{ $company->id ?? '' }}'; // Assume company ID is available in the template

    // Function to update the document name input based on the selected document
    function updateDocumentName(selectElement) {
        const documentNameInput = selectElement.closest('.form-row').querySelector('.companydoc_name');
        if (documentNameInput) {
            const selectedText = selectElement.options[selectElement.selectedIndex]?.text || '';
            documentNameInput.value = selectedText;
        } else {
            console.error('Document name input not found');
        }
    }

    // Event listener to handle document selection changes
    rowContainer.addEventListener('change', function(event) {
        if (event.target.classList.contains('all_document')) {
            updateDocumentName(event.target);
        }
    });

    // Function to add a new row to the form
    function addNewRow() {
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'form-row');
        newRow.innerHTML = `
            <div class="col-md-6 col-lg-3">
                <div class="mb-2">
                    <label for="choices-single-groups" class="form-label font-size-13">All Documents</label>
                    <select class="all_document form-control" name="all_document">
                        <option value="">Choose a Document</option>
                        @foreach($documents as $doc)
                        <option value="{{ $doc->id }}">{{ $doc->document_name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="mb-2">
                    <label class="form-label">Document</label>
                    <input type="text" class="form-control companydoc_name" name="companydoc_name">
                </div>
            </div>
            <input type="text" name="companydoc_id" class="companydoc_id" hidden>
            <input type="text" name="office_user" value="{{ $company->office_user ?? '' }}" class="office_user" hidden>
            <input type="text" name="company_id" value="${companyId}" class="company_id" hidden>
            <input type="text" name="company_name" value="{{ $company->company_name ?? '' }}" class="company_name" hidden>
            <div class="col-lg-3">
                <div class="mb-2">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" class="form-control" name="expiry_date">
                </div>
            </div>
            <div class="col-lg-3 mt-4">
                <button type="button" class="btn btn-success submit-row">Submit</button>
            </div>
        `;
        rowContainer.appendChild(newRow);
    }

    document.querySelector('.add-row').addEventListener('click', addNewRow);

    // Event listener for form submission and row updates
    rowContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('submit-row')) {
            const formRow = event.target.closest('.form-row');
            if (formRow) {
                const formData = new FormData();
                formRow.querySelectorAll('input, select').forEach(input => {
                    formData.append(input.name, input.value);
                });

                fetch('{{ route("add_doc") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        show_notification('success', 'Data added successfully');
                    } else if (data.status === 2) {
                        show_notification('success', 'Data updated successfully');
                    } else {
                        show_notification('error', 'Failed to add data');
                    }
                    populateTable(); // Refresh table after submission
                })
                .catch(error => {
                    console.error('Error:', error);
                    show_notification('error', 'An error occurred while processing your request');
                });
            }
        }
    });

    // Function to populate the table with document data
    function populateTable() {
    fetch(`{{ route("get_docs") }}?company_id=${companyId}`) // Pass company_id as a query parameter
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = '';
            data.forEach((doc, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${doc.companydoc_name}</td>
                        <td>${doc.expiry_date}</td>
                        <td>${doc.remaining_time}</td>
                        <td>${doc.added_by}</td>
                        <td>${doc.office_user}</td>
                        <td>

                            <button class="btn btn-danger delete-row" data-id="${doc.id}">Delete</button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        });
}

    // Load the table data on page load
    populateTable();

    // Event listener for edit and delete actions in the table
    tableBody.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-row')) {
            const docId = event.target.getAttribute('data-id');
            if (docId) {
                fetch(`{{ route("get_doc", ":id") }}`.replace(':id', docId)) // Fetch single document details
                    .then(response => response.json())
                    .then(doc => {
                        document.querySelector('.companydoc_id').value = doc.companydoc_id;
                        document.querySelector('.company_name').value = doc.company_name;
                        document.querySelector('.office_user').value = doc.office_user;
                        document.querySelector('.all_document').value = doc.all_document;
                        document.querySelector('.companydoc_name').value = doc.companydoc_name;
                        document.querySelector('input[name="expiry_date"]').value = doc.expiry_date;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                console.error('Document ID is missing');
            }
        }

        if (event.target.classList.contains('delete-row')) {
            const docId = event.target.getAttribute('data-id');
            if (docId) {
                fetch(`{{ route("delete_doc", ":id") }}`.replace(':id', docId), { // Delete document
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(() => {
                    show_notification('success', 'Document deleted successfully');
                    populateTable(); // Refresh table after deletion
                })
                .catch(error => {
                    console.error('Error:', error);
                    show_notification('error', 'An error occurred while deleting the document');
                });
            } else {
                console.error('Document ID is missing');
            }
        }
    });
});
</script>
