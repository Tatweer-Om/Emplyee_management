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

            var id=$('.document_id').val();


            var title=$('.document_name').val();
            var type=$('.document_type').val();



            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_document_name_lang',[],session('locale')); ?>'); return false;
                }
                if(type==""){
                    show_notification('error','PLease Choose Document Type'); return false;
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
                        show_notification('success','data updated');
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
                if(type==""){
                    show_notification('error','PLease Choose Document Type'); return false;
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
                    $(".document_type").val(fetch.document_type).trigger();


                    $(".modal-title").html('Update');
                }
            },
            error: function(html)
            {
                // $('#global-loader').hide();
                // after_submit();
                show_notification('error','data edit failed');
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
            confirmButtonText:  'data deleted',
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








    </script>
