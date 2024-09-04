<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rowContainer = document.getElementById('row-container');
        const tableBody = document.querySelector('table tbody');
        const companyId = '{{ $company->id ?? '' }}'; // افترض أن معرف الشركة متاح في القالب

        function updateDocumentName(selectElement) {
            const documentNameInput = selectElement.closest('.form-row').querySelector('.companydoc_name');
            if (documentNameInput) {
                const selectedText = selectElement.options[selectElement.selectedIndex]?.text || '';
                documentNameInput.value = selectedText;
            } else {
                console.error('لم يتم العثور على إدخال اسم المستند');
            }
        }

        // مستمع الحدث للتعامل مع تغييرات اختيار المستند
        rowContainer.addEventListener('change', function(event) {
            if (event.target.classList.contains('all_document')) {
                updateDocumentName(event.target);
            }
        });

        $('.company_doc_modal').on('hidden.bs.modal', function() {
            $(".add_company_doc")[0].reset();
            $('.company_doc_id').val('');
        });

        $('#all_company_doc').DataTable().clear().destroy();

        $('#all_company_doc').DataTable({
            "ajax": {
                "url": "{{ url('show_doc') }}",
                "type": "GET",
                "data": function (d) {
                    d.company_id = $('.company_id').val();  // إضافة company_id كمعامل
                }
            },
            "bFilter": true,
            // "sDom": 'fBtlpi',
            'pagingType': 'numbers',
            "ordering": true,
            "language": {
                search: ' ',
                sLengthMenu: '_MENU_',
                searchPlaceholder: 'بحث',
                info: "_START_ - _END_ من _TOTAL_ عناصر",
            },
            initComplete: (settings, json) => {
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
                    show_notification('error', 'يرجى إدخال اسم المستند');
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
                        show_notification('success', 'تم تحديث المستند بنجاح');
                        $('#company_doc_modal').modal('hide');
                        $('#all_company_doc').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل في تحديث المستند');
                        $('#all_company_doc').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            } else if (id == '') {
                if (title == "") {
                    show_notification('error', 'يرجى إدخال اسم المستند');
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
                        show_notification('success', 'تم إضافة المستند بنجاح');
                        $('.company_doc_modal').modal('hide');
                        $(".add_company_doc")[0].reset();
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل في إضافة المستند');
                        $('#all_company_doc').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
        });

    });

    function edit_company_doc(id) {

        console.log(id);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            dataType: 'JSON',
            url: "{{ url('edit_doc') }}",
            method: "POST",
            data: { id: id, _token: csrfToken },
            success: function(fetch) {

                if (fetch != "") {

                    $(".all_document").val(fetch.all_document);
                    $(".companydoc_name").val(fetch.companydoc_name);
                    $(".expiry_date").val(fetch.expiry_date);
                    $(".company_doc_id").val(fetch.id);
                    $(".modal-title").html('تحديث');
                }
            },
            error: function(html) {

                show_notification('error', 'فشل في تعديل المستند');
                console.log(html);
                return false;
            }
        });
    }

    function del_company_doc(id) {
        Swal.fire({
            title: 'هل أنت متأكد من الحذف؟',
            text: 'حذف',
            type: "warning",
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
                    url: "{{ url('delete_doc') }}",
                    type: 'POST',
                    data: { id: id, _token: csrfToken },
                    error: function() {

                        show_notification('error', 'فشل في حذف المستند');
                    },
                    success: function(data) {
                        $('#all_company_doc').DataTable().ajax.reload();
                        show_notification('success', 'تم حذف المستند بنجاح');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'تم الحفاظ على البيانات');
            }
        });
    }

</script>
