<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>User Profile</h2>
        <div id="userDetails" class="mt-3">
            
        </div>
        <button id="backButton" class="btn btn-secondary mt-3">Back to Posts</button>
    </div>

    <script>
        $(document).ready(function () {
            const apiToken = localStorage.getItem('api_token');
            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');

            if (!apiToken || !email) {
                alert('Invalid request.');
                window.location.href = '/allposts';
            }

            // Fetch user details
            $.ajax({
                url: `/api/user/${email}`,
                type: 'GET',
                headers: {
                    Authorization: `Bearer ${apiToken}`
                },
                success: function (response) {
                    const user = response.data;
                    $('#userDetails').html(`
                        <p><strong>Name:</strong> ${user.name}</p>
                        <p><strong>Email:</strong> ${user.email}</p>
                    `);
                },
                error: function () {
                    alert('Failed to fetch user details.');
                    window.location.href = '/allposts';
                }
            });

            // Back to posts
            $('#backButton').on('click', function () {
                window.location.href = '/allposts';
            });
        });
    </script>
</body>

</html>
