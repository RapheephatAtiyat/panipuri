<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                var username = $('input[name="username"]').val();
                var password = $('input[name="password"]').val();
                var c_password = $('input[name="c_password"]').val();

                $.ajax({
                    type: 'POST',
                    url: '/api/register',
                    data: JSON.stringify({ username: username, password: password, c_password: c_password }),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        if(response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: "Successfully registered",
                                icon: "success"
                            })
                            return;
                        } else {
                            Swal.fire({
                                title: "Fail!",
                                text: "Username or Password is incorrect",
                                icon: "error"
                            })
                            return;
                        } 
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <form class="bg-white p-8 rounded shadow-md w-96">
        <input type="text" name="username" class="mb-4 p-2 w-full border rounded" placeholder="Username" required>
        <input type="password" name="password" class="mb-4 p-2 w-full border rounded" placeholder="Password" required>
        <input type="password" name="c_password" class="mb-4 p-2 w-full border rounded" placeholder="Confirm Password" required>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-700">Submit</button>
    </form>
</body>
</html>
