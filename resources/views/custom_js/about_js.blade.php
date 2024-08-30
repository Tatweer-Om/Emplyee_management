<script type="text/javascript">
    $(document).ready(function() {
        $('.about_modal').on('hidden.bs.modal', function() {
            $(".add_about")[0].reset();
            $('.about_id').val('');
            // var imagePath = '{{ asset('images/dummy_image/no_image.png') }}';
            // $('#img_tag').attr('src',imagePath);
        });

        $('#all_about').DataTable().clear().destroy();
        $('#all_about').DataTable({
            "sAjaxSource": "{{ url('show_about') }}",
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

        $('.add_about').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_about')[0]);
            var title=$('.about_name').val();
            var id=$('.about_id').val();

            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','يرجى إدخال اسم المكتب'); return false;
                }
                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_about").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_about') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('success','تم تحديث البيانات بنجاح');
                        $('#about_modal').modal('hide');
                        $('#all_about').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','فشل في تحديث البيانات');
                        $('#all_about').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','يرجى إدخال اسم المكتب'); return false;

                }

                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_about").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_about') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_about').DataTable().ajax.reload();
                        show_notification('success','تم إضافة البيانات بنجاح');
                        $('.about_modal').modal('hide');
                        $(".add_about")[0].reset();
                        return false;
                        },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','فشل في إضافة البيانات');
                        $('#all_about').DataTable().ajax.reload();
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
            url : "{{ url('edit_about') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                // $('#global-loader').hide();
                // after_submit();
                if(fetch!=""){
                    // Define a variable for the image path


                    $(".about_name").val(fetch.about_name);

                    $(".about_phone").val(fetch.about_phone);
                    $(".about_address").val(fetch.about_address);
                    $(".about_detail").val(fetch.about_detail);


                    $(".about_id").val(fetch.about_id);
                    $(".modal-title").html('تحديث البيانات');
                }
            },
            error: function(html)
            {
                // $('#global-loader').hide();
                // after_submit();
                show_notification('error','فشل في تحرير البيانات');
                console.log(html);
                return false;
            }
        });
    }

    function del(id) {
        Swal.fire({
            title:  'هل أنت متأكد؟',
            text:  'لن تتمكن من التراجع عن هذا!',
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText:  'نعم، احذفه!',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function (result) {
            if (result.value) {

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('delete_about') }}",
                    type: 'POST',
                    data: {id: id,_token: csrfToken},
                    error: function () {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', 'فشل في حذف البيانات');
                    },
                    success: function (data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_about').DataTable().ajax.reload();
                        show_notification('success', 'تم حذف البيانات بنجاح');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', 'بياناتك آمنة');
            }
        });
    }

</script>
