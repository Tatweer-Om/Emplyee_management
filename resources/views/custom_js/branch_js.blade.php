<script type="text/javascript">
   $(document).ready(function() {
    // Reset the form when the modal is hidden
    $('.branch_modal').on('hidden.bs.modal', function() {
        $(".add_branch")[0].reset();
        $('.branch_id').val('');
    });

    // Initialize DataTable
    $('#all_branch').DataTable().clear().destroy();
    $('#all_branch').DataTable({
        "sAjaxSource": "{{ url('show_branch') }}",
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
        initComplete: (settings, json) => {
            $('.dataTables_filter').appendTo('#tableSearch');
            $('.dataTables_filter').appendTo('.search-input');
        },
    });

    // Handle form submission
    $('.add_branch').off().on('submit', function(e){
        e.preventDefault();
        var formdatas = new FormData($('.add_branch')[0]);
        var title = $('.branch_name').val();

        // Validate form inputs
        if (title == "") {
            show_notification('error', '<?php echo trans('messages.data_add_branch_name_lang', [], session('locale')); ?>');
            return false;
        }

        // Determine the action based on whether branch_id is present
        var url = $('.branch_id').val() ? "{{ url('update_branch') }}" : "{{ url('add_branch') }}";

        $.ajax({
            type: "POST",
            url: url,
            data: formdatas,
            contentType: false,
            processData: false,
            success: function(data) {
                show_notification('success', '<?php echo trans('messages.data_add_success_lang', [], session('locale')); ?>');
                $('#branch_modal').modal('hide');
                $('#all_branch').DataTable().ajax.reload();
                $(".add_branch")[0].reset();
            },
            error: function(data) {
                show_notification('error', '<?php echo trans('messages.data_add_failed_lang', [], session('locale')); ?>');
                $('#all_branch').DataTable().ajax.reload();
                console.log(data);
            }
        });
    });
});

// Edit branch function
function edit(id) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        dataType: 'JSON',
        url: "{{ url('edit_branch') }}",
        method: "POST",
        data: {id: id, _token: csrfToken},
        success: function(fetch) {
            if (fetch) {
                $(".branch_name").val(fetch.branch_name);
                $(".branch_phone").val(fetch.branch_phone);
                $(".branch_address").val(fetch.branch_address);
                $(".branch_detail").val(fetch.branch_detail);
                $(".branch_id").val(fetch.branch_id);
                $(".modal-title").html('<?php echo trans('messages.update_lang', [], session('locale')); ?>');
            }
        },
        error: function(html) {
            show_notification('error', '<?php echo trans('messages.edit_failed_lang', [], session('locale')); ?>');
            console.log(html);
        }
    });
}

// Delete branch function
function del(id) {
    Swal.fire({
        title: '<?php echo trans('messages.sure_lang', [], session('locale')); ?>',
        text: '<?php echo trans('messages.delete_lang', [], session('locale')); ?>',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: '<?php echo trans('messages.delete_it_lang', [], session('locale')); ?>',
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('delete_branch') }}",
                type: 'POST',
                data: {id: id, _token: csrfToken},
                success: function(data) {
                    $('#all_branch').DataTable().ajax.reload();
                    show_notification('success', '<?php echo trans('messages.delete_success_lang', [], session('locale')); ?>');
                },
                error: function() {
                    show_notification('error', '<?php echo trans('messages.delete_failed_lang', [], session('locale')); ?>');
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            show_notification('success', '<?php echo trans('messages.safe_lang', [], session('locale')); ?>');
        }
    });
}


    </script>
