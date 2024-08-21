
<script>

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

        $(document).ready(function() {
            // Check if the alert exists
            var alert = $('#error-alert');
            if (alert.length) {
                // Hide the alert after 3 seconds
                setTimeout(function() {
                    alert.fadeOut('slow');
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });


</script>
