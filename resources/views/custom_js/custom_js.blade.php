
<script>

$(document).ready(function() {
    $('#all_expired_documents').DataTable({
    "sAjaxSource": "{{ url('all_expired_docs') }}",
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
    "rowCallback": function(row, data) {
        // Access the doc_status via the data attribute
        var docStatus = $(row).attr('data-status');
        if (docStatus == 2) {
            // Apply yellow color to the entire row (tr)
            $(row).css('background-color', 'yellow');

            // Apply yellow color to all cells (td) within the row
            $('td', row).css('background-color', 'yellow');
        }
    },
    initComplete: (settings, json) => {
        $('.dataTables_filter').appendTo('#tableSearch');
        $('.dataTables_filter').appendTo('.search-input');
    },
});


    $('#datepicker-basic').datepicker({
        format: 'mm/dd/yyyy', // or any format you prefer
        autoclose: true,
        todayHighlight: true,
    });
});
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>


    function show_notification(type, msg) {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right', // Set position to top-right
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };
        if (type == "success") {
            toastr.success(msg, type);
        } else if (type == "error") {
            toastr.error(msg, type);
        } else if (type == "warning") {
            toastr.warning(msg, type);
        }
    }

    $('.login_user').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            var username = $('#username').val().trim();
            var password = $('#password').val().trim();

            // Validate form fields
            if (username === '') {
                show_notification('error', 'Invalid Username');
                return; // Stop form submission
            }

            if (password === '') {
                show_notification('error', 'Invalid Password');
                return; // Stop form submission
            }

            $.ajax({
                url: "{{ route('login_user') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    username: username,
                    password: password
                },
                success: function(response) {
                    if (response.status === 1) {

                        window.location.href = response.redirect_url;
                        show_notification('success', 'Login success');
                    } else {
                        show_notification('error', 'Login error');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    show_notification('error', 'Login error');
                }
            });
        });

    function renew_docs(id,type) {
        Swal.fire({
            title: 'Do you want to renew documents',
            text: 'Renew',
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Renew',
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function(result) {
            if (result.value) {
                // $('#global-loader').show();
                // before_submit();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('renew_docs_request') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        type: type,
                        _token: csrfToken
                    },
                    error: function() {
                        // $('#global-loader').hide();
                        // after_submit();
                        show_notification('error', '<?php echo trans('messages.renew_docs_failed_lang', [], session('locale')); ?>');
                    },
                    success: function(data) {
                        // $('#global-loader').hide();
                        // after_submit();
                        $('#all_expired_documents').DataTable().ajax.reload();
                        show_notification('success', '<?php echo trans('messages.renew_process_start_lang', [], session('locale')); ?>');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                show_notification('success', '<?php echo trans('messages.safe_lang', [], session('locale')); ?>');
            }
        });
    }

    function finish_renew(id,type) {
        $('.docs_id').val(id)
        $('.docs_type').val(type)
    }
    // Handle form submission
    $('#add_employee_status').on('submit', function(e) {
        e.preventDefault();
        if($('.new_expiry').val()=="")
        {
            show_notification('error', 'Please select new expiry date');
            return false;
        }
        if($('.doc_name').val()=="")
        {
            show_notification('error', 'Please select doc name');
            return false;
        }
         
        $.ajax({
            url: '{{ route("update_employee_doc") }}', // Route to handle form submission
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                show_notification('success', 'Data updated successfully'); // Display success message
                $('#renew_modal').modal('hide'); // Hide the modal
                $('#all_expired_documents').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + error);
            }
        });
    });
</script>
