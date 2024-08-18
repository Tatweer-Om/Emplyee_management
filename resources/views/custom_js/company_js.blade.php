<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $('.company_modal').on('hidden.bs.modal', function() {
            $(".add_company")[0].reset();
            $('.company_id').val('');
            // var imagePath = '{{ asset('images/dummy_image/no_image.png') }}';
            // $('#img_tag').attr('src',imagePath);
        });

        $('#all_company').DataTable().clear().destroy();
        $('#all_company').DataTable({
            "sAjaxSource": "{{ url('show_company') }}",
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

        $('.add_company').off().on('submit', function(e){
            e.preventDefault();
            var formdatas = new FormData($('.add_company')[0]);
            var title=$('.company_name').val();
            var id=$('.company_id').val();

            if(id!='')
            {
                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_company_name_lang',[],session('locale')); ?>'); return false;
                }
                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_company").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('update_company') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('success','<?php echo trans('messages.data_update_success_lang',[],session('locale')); ?>');
                        $('#company_modal').modal('hide');
                        $('#all_company').DataTable().ajax.reload();
                        return false;
                    },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_update_failed_lang',[],session('locale')); ?>');
                        $('#all_company').DataTable().ajax.reload();
                        console.log(data);
                        return false;
                    }
                });
            }
            else if(id==''){


                if(title=="" )
                {
                    show_notification('error','<?php echo trans('messages.data_add_company_name_lang',[],session('locale')); ?>'); return false;

                }

                // $('#global-loader').show();
                // before_submit();
                var str = $(".add_company").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('add_company') }}",
                    data: formdatas,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_company').DataTable().ajax.reload();
                        show_notification('success','<?php echo trans('messages.data_add_success_lang',[],session('locale')); ?>');
                        $('.company_modal').modal('hide');
                        $(".add_company")[0].reset();
                        return false;
                        },
                    error: function(data)
                    {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error','<?php echo trans('messages.data_add_failed_lang',[],session('locale')); ?>');
                        $('#all_company').DataTable().ajax.reload();
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
            url : "{{ url('edit_company') }}",
            method : "POST",
            data :   {id:id,_token: csrfToken},
            success: function(fetch) {
                // $('#global-loader').hide();
                // after_submit();
                if(fetch!=""){
                    // Define a variable for the image path


                    $(".company_name").val(fetch.company_name);
                    $(".company_email").val(fetch.company_email);
                    $(".company_phone").val(fetch.company_phone);
                    $(".office_user").val(fetch.office_user).trigger('change');
                    $(".company_address").val(fetch.company_address);
                    $(".company_detail").val(fetch.company_detail);
                    $(".cr_no").val(fetch.cr_no);

                    $(".company_id").val(fetch.company_id);
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
                    url: "{{ url('delete_company') }}",
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
                        $('#all_company').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.delete_success_lang',[],session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang',[],session('locale')); ?>');
            }
        });
    }



    //employee
    function add_employee(id) {
    // Set the value of the select box
    $('.employee_company').val(id).trigger('change');

    // Trigger the form submission

}


$('.add_employee').off().on('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    var formdatas = new FormData(this); // Create FormData object from the form
    var title = $('.employee_name').val(); // Get employee name
    var id = $('.employee_id').val(); // Get employee ID

    // Validate form input
    if (title === "") {
        show_notification('error', '<?php echo trans('messages.data_add_employee_name_lang', [], session('locale')); ?>');
        return false; // Exit if validation fails
    }

    // Send AJAX request
    $.ajax({
        type: "POST",
        url: "{{ url('add_employee2') }}", // Set your API endpoint
        data: formdatas,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function(data) {
            $('#all_employee').DataTable().ajax.reload(); // Reload DataTable
            show_notification('success', '<?php echo trans('messages.data_add_success_lang', [], session('locale')); ?>'); // Show success notification
            $('.employee_modal').modal('hide'); // Hide the modal
            $(".add_employee")[0].reset(); // Reset the form
        },
        error: function(data) {
            show_notification('error', '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>'); // Show error notification
            $('#all_employee').DataTable().ajax.reload(); // Reload DataTable
            console.log(data); // Log error for debugging
        }
    });
});



//company_profile_js





    </script>
