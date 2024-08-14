<script type="text/javascript">
    $(document).ready(function() {
        $('#user_modal').on('hidden.bs.modal', function() {
            $(".add_user")[0].reset();
            $('.user_id').val('');

        });
        $('#all_user').DataTable().clear().destroy();
        $('#all_user').DataTable({
            "sAjaxSource": "{{ url('show_user') }}",
            "bFilter": true,
            "sDom": 'fBtlpi',
            'pagingType': 'numbers',
            "ordering": true,
            "language": {
                search: ' ',
                sLengthMenu: '_MENU_',
                searchPlaceholder: '<?php echo trans('messages.search_lang',[],session('locale')); ?>',
                info: "_START_ - _END_ of _TOTAL_ items",
                },
            initComplete: (settings, json)=>{
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },

        });

        $('.add_user').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_user')[0]);
            var title=$('.user_name').val();
            var id=$('.user_id').val();

            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.add_user_name_lang',[],session('locale')); ?>'); return false;
                }
                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_user").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_user') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                        $('#user_modal').modal('hide');
                        $('#all_user').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_user').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_user_name_lang',[],session('locale')); ?>'); return false;

                }

                // $('#global-loader').show();
                // before_submit();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var str = $(".add_user").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_user') }}",
                    data: formdatas,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_user').DataTable().ajax.reload();
                        show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                        $('#user_modal').modal('hide');
                        $(".add_user")[0].reset();
                        return false;
                        },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_user').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });

            }

        });
    });
    function edit(id){
        // $('#global-loader').show();
        // before_submit();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax ({
            dataType:'JSON',
            url : "{{ url('edit_user') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                // $('#global-loader').hide();
                // after_submit();
                if(fetch!=""){

                    $(".user_name").val(fetch.user_name);
                    $(".password").val(fetch.password);
                    $(".user_phone").val(fetch.user_phone);
                    $(".user_detail").val(fetch.user_detail);
                    if (fetch.user_all == 1) {
                     $(".user_all").prop('checked', true);
                } else {
                    $(".user_all").prop('checked', false);
                }
                $(".user_branch").val(fetch.user_branch).trigger('change');
                $(".user_type").val(fetch.user_type).trigger('change');
                    $(".user_id").val(fetch.user_id);

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
            title:  'Are You Sure To delete',
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
                    url: "{{ url('delete_user') }}",
                    type: 'POST',
                    data: {id: id,_token: csrfToken},
                    error: function () {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', 'Delete Failed');
                    },
                    success: function (data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_user').DataTable().ajax.reload();
                        show_notification('success', 'delete success');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'data is safe');
            }
        });
    }




    </script>
