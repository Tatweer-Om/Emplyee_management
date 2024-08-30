<script type="text/javascript">
    $(document).ready(function() {
        $('.document_modal').on('hidden.bs.modal', function() {
            $(".add_document")[0].reset();
            $('.document_id').val('');

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
                searchPlaceholder: 'بحث',
                info: "_START_ - _END_ من _TOTAL_ عناصر",
            },
            initComplete: (settings, json)=>{
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },
        });

        $('.add_document').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_document')[0]);

            var id = $('.document_id').val();
            var title = $('.document_name').val();
            var type = $('.document_type').val();

            if(id != '') {
                if(title == "") {
                    show_notification('error', 'يرجى إدخال اسم المستند');
                    return false;
                }
                if(type == "") {
                    show_notification('error', 'يرجى اختيار نوع المستند');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_document') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        show_notification('success', 'تم تحديث البيانات');
                        $('#document_modal').modal('hide');
                        $('#all_document').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل في تحديث البيانات');
                        $('#all_document').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            } else if(id == '') {
                if(title == "") {
                    show_notification('error', 'يرجى إدخال اسم المستند');
                    return false;
                }
                if(type == "") {
                    show_notification('error', 'يرجى اختيار نوع المستند');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_document') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#all_document').DataTable().ajax.reload();
                        show_notification('success', 'تمت إضافة البيانات بنجاح');
                        $('.document_modal').modal('hide');
                        $(".add_document")[0].reset();
                        return false;
                    },
                    error: function(data) {
                        show_notification('error', 'فشل في إضافة البيانات');
                        $('#all_document').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
        });
    });

    function edit(id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            dataType: 'JSON',
            url: "{{ url('edit_document') }}",
            method: "POST",
            data: {id: id, _token: csrfToken},
            success: function(fetch) {
                if(fetch != "") {
                    $(".document_name").val(fetch.document_name);
                    $(".document_detail").val(fetch.document_detail);
                    $(".document_id").val(fetch.document_id);
                    $(".document_type").val(fetch.document_type).trigger();
                    $(".modal-title").html('تحديث');
                }
            },
            error: function(html) {
                show_notification('error', 'فشل في تحرير البيانات');
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
            confirmButtonText: 'تم الحذف',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function (result) {
            if (result.value) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_document') }}",
                    type: 'POST',
                    data: {id: id, _token: csrfToken},
                    error: function () {
                        show_notification('error', 'فشل في الحذف');
                    },
                    success: function (data) {
                        $('#all_document').DataTable().ajax.reload();
                        show_notification('success', 'تم الحذف بنجاح');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'البيانات آمنة');
            }
        });
    }
</script>
