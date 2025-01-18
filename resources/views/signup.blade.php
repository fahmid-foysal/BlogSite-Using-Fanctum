<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Sign Up</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <button id="signupButton" class="btn btn-primary w-100">Sign Up</button>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">Already have an account? <a href="/">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#signupButton").on('click', function() {
                const name = $("#name").val();
                const email = $("#email").val();
                const password = $("#password").val();

                $.ajax({
                    url: '/api/signup',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        name: name,
                        email: email,
                        password: password,
                    }),
                    success: function(response) {
                        if (response.status) {
                            alert("User Created Successfully");
                            window.location.href = "/"; // Redirect to login page after signup
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>
