<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Sanctum with jQuery Ajax</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional Bootstrap JavaScript for components like modals -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <button id="loginButton" class="btn btn-primary w-100">Login</button>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">Don't have an account? <a href="/signup">Sign up</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("#loginButton").on('click',function(){
               const email = $("#email").val();
               const password = $("#password").val();
               
               $.ajax({
                url : '/api/login',
                type : 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    email : email,
                    password : password,
                }),
                success: function(response){
                    console.log(response);
                    console.log(response.email);

                    localStorage.setItem('api_token', response.token);
                    window.location.href = "/allposts";
                },
                error: function(xhr,status,error){
                    alert('Error: '+xhr.responseText)
                }
               })

            });
        });
    </script>

</body>

</html>
