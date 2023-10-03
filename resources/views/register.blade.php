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
            <h1 class="text-center mt-3">Registration By API</h1>
            <p class="text-end"><a class="btn btn-success" href="{{route('login')}}">Login</a></p>
            <form id="register-form" class="w-50 mt-3">
                @csrf
                <div>
                    <label for="role_id" class="form-label">Select Role</label>
                    <select class="form-select" name="role_id" id="role_id"
                        aria-label="Floating label select example">
                        <option selected disabled value="">...Select Roles...</option>
                        @isset($roles)
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div>
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div>
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <label for="mobile" class="form-label">Mobile:</label>
                    <input type="number" class="form-control" name="mobile" id="mobile">
                </div>
                <div>
                    <label for="profile" class="form-label">Profile:</label>
                    <input type="file" class="form-control" name="profile" id="profile">
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>
        </div>

        <div id="response" class="mt-3"></div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#register-form').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '/api/register',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        $('#response').text(response.message);
                        Swal.fire(
                            'Success!',
                            'Successfully Register!',
                            'success'
                            )
                    },
                    error: function (error) {
                        $('#response').text(error.responseJSON.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...error',
                            text: 'Something went wrong!',
                            footer: error.responseJSON.message
                        })
                    }
                });
            });
        });
    </script>

</body>
</html>
