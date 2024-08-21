<script>
    document.addEventListener('DOMContentLoaded', function() {
    const rowContainer = document.getElementById('row-container');
    const tableBody = document.querySelector('table tbody');
    const employeeId = '{{ $employee->id ?? '' }}'; // Assume employee ID is available in the template

    // Function to update the document name input based on the selected document
    function updateDocumentName(selectElement) {
        const documentNameInput = selectElement.closest('.form-row').querySelector('.employeedoc_name');
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



    // add document employee

    $('.employee_doc_modal').on('hidden.bs.modal', function() {
            $(".add_employee_doc")[0].reset();
            $('.employee_doc_id').val('');
            // var imagePath = '{{ asset('images/dummy_image/no_image.png') }}';
            // $('#img_tag').attr('src',imagePath);
        });

        $('#all_employee_doc').DataTable().clear().destroy();
        $('#all_employee_doc').DataTable({
         "ajax": {
        "url": "{{ url('show_employeedoc') }}",
        "type": "GET",
        "data": function (d) {
            d.employee_id = $('.employee_id').val();  // Add employee_doc_id as a parameter
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

 $('.add_employee_doc').off().on('submit', function(e) {
    e.preventDefault();
    var formdatas = new FormData($('.add_employee_doc')[0]);
    var title = $('.employeedoc_name').val();
    var id = $('.employee_doc_id').val();

    if (id != '') {
        if (title == "") {
            show_notification('error', '<?php echo trans('messages.data_add_employee_doc_name_lang',[],session('locale')); ?>');
            return false;
        }
        var str = $(".add_employee_doc").serialize();
        $.ajax({
            type: "POST",
            url: "{{ url('add_employeedoc') }}",
            data: formdatas,
            contentType: false,
            processData: false,
            success: function(data) {
                show_notification('success', '<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                $('#employee_doc_modal').modal('hide');
                $('#all_employee_doc').DataTable().ajax.reload();
                $(".add_employee_doc")[0].reset();
                return false;
            },
            error: function(data) {
                show_notification('error', '<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                $('#all_employee_doc').DataTable().ajax.reload();
                console.log(data);
                return false;
            }
        });
    } else if (id == '') {
        if (title == "") {
            show_notification('error', '<?php echo trans('messages.data_add_employee_doc_name_lang',[],session('locale')); ?>');
            return false;
        }
        var str = $(".add_employee_doc").serialize();
        $.ajax({
            type: "POST",
            url: "{{ url('add_employeedoc') }}",
            data: formdatas,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#all_employee_doc').DataTable().ajax.reload();
                show_notification('success', '<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                $('.employee_doc_modal').modal('hide');
                $(".add_employee_doc")[0].reset();
                return false;
            },
            error: function(data) {
                show_notification('error', '<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                $('#all_employee_doc').DataTable().ajax.reload();
                console.log(data);
                return false;
            }
        });
    }
});

    });



    function edit_employeedoc(id){




        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax ({
            dataType:'JSON',
            url : "{{ url('edit_employeedoc') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                // $('#global-loader').hide();
                // after_submit();
                if(fetch!=""){
                    // Define a variable for the image path


                    $(".all_document").val(fetch.all_document);
                    $(".employeedoc_name").val(fetch.employeedoc_name);
                    $(".expiry_date").val(fetch.expiry_date);
                    $(".employee_doc_id").val(fetch.id);
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

    function del_employee_doc(id) {
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
                        $('#all_employee_doc').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }



</script>
