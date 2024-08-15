<script type="text/javascript">
    $(document).ready(function() {
        $('.document_modal').on('hidden.bs.modal', function() {
            $(".add_document")[0].reset();
            $('.document_id').val('');
            // var imagePath = '{{ asset('images/dummy_image/no_image.png') }}';
            // $('#img_tag').attr('src',imagePath);
        });

        $('#all_document').DataTable().clear().destroy();
        $('#all_document').DataTable({
            "sAjaxSource": "{{ url('show_document') }}",
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
            initComplete: (settings, json)=>{
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },

        });
        $('.add_document').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_document')[0]);
            var title=$('.document_name').val();
            var id=$('.document_id').val();

            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_document_name_lang',[],session('locale')); ?>'); return false;
                }
                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_document").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_document') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                        $('#document_modal').modal('hide');
                        $('#all_document').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_document').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_document_name_lang',[],session('locale')); ?>'); return false;

                }

                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_document").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_document') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_document').DataTable().ajax.reload();
                        show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                        $('.document_modal').modal('hide');
                        $(".add_document")[0].reset();
                        return false;
                        },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_document').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });

            }

        });
    });



    function edit(id){

        console.log(id);


        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax ({
            dataType:'JSON',
            url : "{{ url('edit_document') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                // $('#global-loader').hide();
                // after_submit();
                if(fetch!=""){
                    // Define a variable for the image path


                    $(".document_name").val(fetch.document_name);
                    $(".document_detail").val(fetch.document_detail);


                    $(".document_id").val(fetch.document_id);
                    $(".modal-title").html('<?php echo trans('messages.update_lang',[],session('locale')); ?>');
                }
            },
            error: function(html)
            {
                // $('#global-loader').hide();
                // after_submit();
                show_notification('error','<?php echo trans('messages.edit_failed_lang',[],session('locale')); ?>');
                console.log(html);
                return false;
            }
        });
    }

    function del(id) {
        Swal.fire({
            title:  '<?php echo trans('messages.sure_lang',[],session('locale')); ?>',
            text:  '<?php echo trans('messages.delete_lang',[],session('locale')); ?>',
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText:  '<?php echo trans('messages.delete_it_lang',[],session('locale')); ?>',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function (result) {
            if (result.value) {

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_document') }}",
                    type: 'POST',
                    data: {id: id,_token: csrfToken},
                    error: function () {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', '<?php echo trans('messages.delete_failed_lang',[],session('locale')); ?>');
                    },
                    success: function (data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_document').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }







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

    // document.querySelector('.add-row').addEventListener('click', addNewRow);


    // add document company 
    
    $('.company_doc_modal').on('hidden.bs.modal', function() {
            $(".add_company_doc")[0].reset();
            $('.company_doc_id').val('');
            // var imagePath = '{{ asset('images/dummy_image/no_image.png') }}';
            // $('#img_tag').attr('src',imagePath);
        });

        $('#all_company_doc').DataTable().clear().destroy();
        
        $('#all_company_doc').DataTable({
    "ajax": {
        "url": "{{ url('show_doc') }}",
        "type": "GET",
        "data": function (d) {
            d.company_id = $('.company_id').val();  // Add company_doc_id as a parameter
        }
    },
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
    initComplete: (settings, json)=>{
        $('.dataTables_filter').appendTo('#tableSearch');
        $('.dataTables_filter').appendTo('.search-input');
    },
});

        $('.add_company_doc').off().on('submit', function(e) {
    e.preventDefault();
    var formdatas = new FormData($('.add_company_doc')[0]);
    var title = $('.companydoc_name').val();
    var id = $('.company_doc_id').val();

    if (id != '') {
        if (title == "") {
            show_notification('error', '<?php echo trans('messages.data_add_company_doc_name_lang',[],session('locale')); ?>');
            return false;
        }
        var str = $(".add_company_doc").serialize();
        $.ajax({
            type: "POST",
            url: "{{ url('add_doc') }}",
            data: formdatas,
            contentType: false,
            processData: false,
            success: function(data) {
                show_notification('success', '<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                $('#company_doc_modal').modal('hide');
                $('#all_company_doc').DataTable().ajax.reload();
                return false;
            },
            error: function(data) {
                show_notification('error', '<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                $('#all_company_doc').DataTable().ajax.reload();
                console.log(data);
                return false;
            }
        });
    } else if (id == '') {
        if (title == "") {
            show_notification('error', '<?php echo trans('messages.data_add_company_doc_name_lang',[],session('locale')); ?>');
            return false;
        }
        var str = $(".add_company_doc").serialize();
        $.ajax({
            type: "POST",
            url: "{{ url('add_doc') }}",
            data: formdatas,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#all_company_doc').DataTable().ajax.reload();
                show_notification('success', '<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                $('.company_doc_modal').modal('hide');
                $(".add_company_doc")[0].reset();
                return false;
            },
            error: function(data) {
                show_notification('error', '<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                $('#all_company_doc').DataTable().ajax.reload();
                console.log(data);
                return false;
            }
        });
    }
});

    });



    function edit_company_doc(id){

        console.log(id);


        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax ({
            dataType:'JSON',
            url : "{{ url('edit_doc') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                // $('#global-loader').hide();
                // after_submit();
                if(fetch!=""){
                    // Define a variable for the image path


                    $(".all_document").val(fetch.all_document);
                    $(".companydoc_name").val(fetch.companydoc_name);
                    $(".expiry_date").val(fetch.expiry_date); 
                    $(".company_doc_id").val(fetch.id);
                    $(".modal-title").html('<?php echo trans('messages.update_lang',[],session('locale')); ?>');
                }
            },
            error: function(html)
            {
                // $('#global-loader').hide();
                // after_submit();
                show_notification('error','<?php echo trans('messages.edit_failed_lang',[],session('locale')); ?>');
                console.log(html);
                return false;
            }
        });
    }

    function del_company_doc(id) {
        Swal.fire({
            title:  'Are You sure to Delete',
            text:  'Delete',
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText:  'Delete',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function (result) {
            if (result.value) {
                // $('#global-loader').show();
                // before_submit();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_doc') }}",
                    type: 'POST',
                    data: {id: id,_token: csrfToken},
                    error: function () {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', '<?php echo trans('messages.delete_failed_lang',[],session('locale')); ?>');
                    },
                    success: function (data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_company_doc').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }



    // Event listener for form submission and row updates
    // rowContainer.addEventListener('click', function(event) {
    //     if (event.target.classList.contains('submit-row')) {
    //         const formRow = event.target.closest('.form-row');
    //         if (formRow) {
    //             const formData = new FormData();
    //             formRow.querySelectorAll('input, select').forEach(input => {
    //                 formData.append(input.name, input.value);
    //             });

    //             fetch('{{ route("add_doc") }}', {
    //                 method: 'POST',
    //                 body: formData,
    //                 headers: {
    //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //                 }
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.status === 1) {
    //                     show_notification('success', 'Data added successfully');
    //                 } else if (data.status === 2) {
    //                     show_notification('success', 'Data updated successfully');
    //                 } else {
    //                     show_notification('error', 'Failed to add data');
    //                 }
    //                 populateTable(); // Refresh table after submission
    //             })
    //             .catch(error => {
    //                 console.error('Error:', error);
    //                 show_notification('error', 'An error occurred while processing your request');
    //             });
    //         }
    //     }
    // });

    // Function to populate the table with document data
//     function populateTable() {
//     fetch(`{{ route("get_docs") }}?company_id=${companyId}`) // Pass company_id as a query parameter
//         .then(response => response.json())
//         .then(data => {
//             tableBody.innerHTML = '';
//             data.forEach((doc, index) => {
//                 const row = `
//                     <tr>
//                         <td>${index + 1}</td>
//                         <td>${doc.companydoc_name}</td>
//                         <td>${doc.expiry_date}</td>
//                         <td>${doc.remaining_time}</td>
//                         <td>${doc.added_by}</td>
//                         <td>${doc.office_user}</td>
//                         <td>

//                             <button class="btn btn-danger delete-row" data-id="${doc.id}">Delete</button>
//                         </td>
//                     </tr>
//                 `;
//                 tableBody.insertAdjacentHTML('beforeend', row);
//             });
//         });
// }

    // Load the table data on page load
    // populateTable();

    // Event listener for edit and delete actions in the table
    // tableBody.addEventListener('click', function(event) {
    //     if (event.target.classList.contains('edit-row')) {
    //         const docId = event.target.getAttribute('data-id');
    //         if (docId) {
    //             fetch(`{{ route("get_doc", ":id") }}`.replace(':id', docId)) // Fetch single document details
    //                 .then(response => response.json())
    //                 .then(doc => {
    //                     document.querySelector('.companydoc_id').value = doc.companydoc_id;
    //                     document.querySelector('.company_name').value = doc.company_name;
    //                     document.querySelector('.office_user').value = doc.office_user;
    //                     document.querySelector('.all_document').value = doc.all_document;
    //                     document.querySelector('.companydoc_name').value = doc.companydoc_name;
    //                     document.querySelector('input[name="expiry_date"]').value = doc.expiry_date;
    //                 })
    //                 .catch(error => console.error('Error:', error));
    //         } else {
    //             console.error('Document ID is missing');
    //         }
    //     }

    //     if (event.target.classList.contains('delete-row')) {
    //         const docId = event.target.getAttribute('data-id');
    //         if (docId) {
    //             fetch(`{{ route("delete_doc", ":id") }}`.replace(':id', docId), { // Delete document
    //                 method: 'DELETE',
    //                 headers: {
    //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //                 }
    //             })
    //             .then(response => response.json())
    //             .then(() => {
    //                 show_notification('success', 'Document deleted successfully');
    //                 populateTable(); // Refresh table after deletion
    //             })
    //             .catch(error => {
    //                 console.error('Error:', error);
    //                 show_notification('error', 'An error occurred while deleting the document');
    //             });
    //         } else {
    //             console.error('Document ID is missing');
    //         }
    //     }
    // });
// });










    </script>
