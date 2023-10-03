<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center mt-3">Login</h1>
            <form id="loginForm" class="w-50 mt-3">
                @csrf
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div>
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
            </form>
        </div>

        <div id="response" class="mt-3"></div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'postlogin',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        // $('#message').html(response.message);
                        if (response.token) {
                            Swal.fire(
                            'Success!',
                            'Successfully login!',
                            'success'
                            )
                            // Redirect to dashboard or desired page on successful login
                            window.location.href = 'dashboard';
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON;
                        $('#message').html(errors.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...error',
                            text: 'Something went wrong!',
                            footer: errors.message
                        })
                    }
                });
            });
        });

    </script>

</body>
</html>
