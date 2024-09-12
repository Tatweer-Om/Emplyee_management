<script type="text/javascript">
    $(document).ready(function() {
        $(".employee_company").select2({
            dropdownParent: $("#employee_modal")
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.employee_modal').on('hidden.bs.modal', function() {
            $(".add_employee")[0].reset();
            $('.employee_id').val('');

        });

        $('#all_employee').DataTable().clear().destroy();
        $('#all_employee').DataTable({
            "sAjaxSource": "{{ url('show_employee') }}",
            "bFilter": true,
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

        $('.add_employee').off().on('submit', function(e) {
            e.preventDefault();
            var formdatas = new FormData($('.add_employee')[0]);
            var title = $('.employee_name').val();
            var id = $('.employee_id').val();
            var employee_company = $('.employee_company').val();

            if(id != '') {
                if(title == "") {
                    show_notification('error', 'الرجاء إضافة اسم الموظف');
                    return false;
                }

                if(employee_company == "") {
                    show_notification('error', 'الرجاء إضافة شركة الموظف');
                    return false;
                }

                var str = $(".add_employee").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_employee') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var id = data.last_id;
                        var url = base_url + '/employee_document_addition/' + id;
                        show_notification('success', 'تم تحديث البيانات بنجاح');
                        $('#employee_modal').modal('hide');
                        $('#all_employee').DataTable().ajax.reload();
                        window.open(url, '_blank');
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل تحديث البيانات');
                        $('#all_employee').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            } else if(id == '') {
                if(title == "") {
                    show_notification('error', 'الرجاء إضافة اسم الموظف');
                    return false;
                }

                if(employee_company == "") {
                    show_notification('error', 'الرجاء إضافة شركة الموظف');
                    return false;
                }

                var str = $(".add_employee").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_employee') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var id = data.last_id;
                        var url = base_url + '/employee_document_addition/' + id;
                        $('#all_employee').DataTable().ajax.reload();
                        show_notification('success', 'تمت إضافة البيانات بنجاح');
                        $('.employee_modal').modal('hide');
                        $(".add_employee")[0].reset();
                        window.open(url, '_blank');
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل إضافة البيانات');
                        $('#all_employee').DataTable().ajax.reload();
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
            url: "{{ url('edit_employee') }}",
            method: "POST",
            data: {id: id, _token: csrfToken},
            success: function(fetch) {
                if(fetch != "") {
                    $(".employee_name").val(fetch.employee_name);
                    $(".employee_email").val(fetch.employee_email);
                    $(".employee_phone").val(fetch.employee_phone);
                    $(".employee_company").val(fetch.employee_company).trigger('change');
                    $(".employee_detail").val(fetch.employee_detail);
                    $(".employee_id").val(fetch.employee_id);
                    $(".modal-title").html('تحديث الموظف');
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
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'حذف',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_employee') }}",
                    type: 'POST',
                    data: {id: id, _token: csrfToken},
                    error: function() {
                        show_notification('error', 'فشل حذف البيانات');
                    },
                    success: function(data) {
                        $('#all_employee').DataTable().ajax.reload();
                        show_notification('success', 'تم حذف البيانات بنجاح');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'البيانات آمنة');
            }
        });
    }
</script>
