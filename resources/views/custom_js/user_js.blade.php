<script type="text/javascript">
    $(document).ready(function() {
        // Reset form and clear user_id when modal is closed
        $('#user_modal').on('hidden.bs.modal', function() {
            $(".add_user")[0].reset();
            $('.user_id').val('');
        });

        // Initialize DataTable
        $('#all_user').DataTable().clear().destroy();
        $('#all_user').DataTable({
            "sAjaxSource": "{{ url('show_user') }}",
            "bFilter": true,
            // "sDom": 'fBtlpi',
            'pagingType': 'numbers',
            "ordering": true,
            "language": {
                search: ' ',
                sLengthMenu: '_MENU_',
                searchPlaceholder: 'البحث',
                info: "_START_ - _END_ من _TOTAL_ عناصر",
            },
            initComplete: (settings, json)=>{
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },
        });

        // Handle form submission for adding/updating user
        $('.add_user').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_user')[0]);
            var title = $('.user_name').val();
            var id = $('.user_id').val();

            if (title === "") {
                show_notification('error', 'يرجى إدخال اسم المستخدم');
                return false;
            }

            var url = id !== '' ? "{{ url('update_user') }}" : "{{ url('add_user') }}";

            $.ajax({
                type: "POST",
                url: url,
                data: formdatas,
                contentType: false,
                processData: false,
                success: function(data) {
                    show_notification('success', id !== '' ? 'تم تحديث البيانات بنجاح' : 'تمت إضافة البيانات بنجاح');
                    $('#user_modal').modal('hide');
                    $('#all_user').DataTable().ajax.reload();
                },
                error: function(data) {
                    show_notification('error', id !== '' ? 'فشل في تحديث البيانات' : 'فشل في إضافة البيانات');
                    $('#all_user').DataTable().ajax.reload();
                }
            });
        });

        // Function to handle edit
        window.edit = function(id) {
            $.ajax({
                dataType: 'JSON',
                url: "{{ url('edit_user') }}",
                method: "POST",
                data: { id: id, _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(fetch) {
                    if (fetch) {
                        $(".user_name").val(fetch.user_name);
                        $(".password").val(fetch.password);
                        $(".user_phone").val(fetch.user_phone);
                        $(".user_email").val(fetch.user_email);
                        $(".leaves").val(fetch.leaves);
                        $(".user_detail").val(fetch.user_detail);
                        $(".user_all").prop('checked', fetch.user_all == 1);
                        $(".user_branch").val(fetch.user_branch).trigger('change');
                        $(".user_type").val(fetch.user_type).trigger('change');
                        $(".user_id").val(fetch.user_id);
                        $(".modal-title").html('تحديث البيانات');
                    }
                },
                error: function(html) {
                    show_notification('error', 'فشل في تحرير البيانات');
                    console.log(html);
                }
            });
        };

        // Function to handle delete


        // Toggle password visibility
    });

    function del(id) {
            Swal.fire({
                title: 'هل أنت متأكد من الحذف؟',
                text: 'حذف',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'حذف',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('delete_user') }}",
                        type: 'POST',
                        data: { id: id, _token: $('meta[name="csrf-token"]').attr('content') },
                        success: function(data) {
                            $('#all_user').DataTable().ajax.reload();
                            show_notification('success', 'تم الحذف بنجاح');
                        },
                        error: function() {
                            show_notification('error', 'فشل في الحذف');
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    show_notification('success', 'البيانات آمنة');
                }
            });
        };
</script>
