
<script>

$(document).ready(function() {
    
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


</script>
