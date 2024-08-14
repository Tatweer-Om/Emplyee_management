
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $('.employee_modal').on('hidden.bs.modal', function() {
            $(".add_employee")[0].reset();
            $('.employee_id').val('');
            // var imagePath = '{{ asset('images/dummy_image/no_image.png') }}';
            // $('#img_tag').attr('src',imagePath);
        });

        $('#all_employee').DataTable().clear().destroy();
        $('#all_employee').DataTable({
            "sAjaxSource": "{{ url('show_employee') }}",
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

        $('.add_employee').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_employee')[0]);
            var title=$('.employee_name').val();
            var id=$('.employee_id').val();

            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_employee_name_lang',[],session('locale')); ?>'); return false;
                }
                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_employee").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_employee') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                        $('#employee_modal').modal('hide');
                        $('#all_employee').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_employee').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_employee_name_lang',[],session('locale')); ?>'); return false;

                }

                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_employee").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_employee') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_employee').DataTable().ajax.reload();
                        show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                        $('.employee_modal').modal('hide');
                        $(".add_employee")[0].reset();
                        return false;
                        },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_employee').DataTable().ajax.reload();
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
            url : "{{ url('edit_employee') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                // $('#global-loader').hide();
                // after_submit();
                if(fetch!=""){
                    // Define a variable for the image path


                    $(".employee_name").val(fetch.employee_name);
                    $(".employee_email").val(fetch.employee_email);
                    $(".employee_phone").val(fetch.employee_phone);
                    $(".employee_company").val(fetch.employee_company).trigger('change');
                    $(".employee_detail").val(fetch.employee_detail);


                    $(".employee_id").val(fetch.employee_id);
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
                    url: "{{ url('delete_employee') }}",
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
                        $('#all_employee').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }

    </script>
