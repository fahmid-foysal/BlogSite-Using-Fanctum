<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div id="postContainer" class="text-center">
            <h1 id="postTitle"></h1>
            <img id="postImage" class="img-fluid my-4" alt="Post Image" style="max-height: 400px;">
            <p id="postDescription" class="fs-5"></p>
        </div>
        <a href="/allposts" class="btn btn-secondary mt-3">Back to All Posts</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            const apiToken = localStorage.getItem('api_token');
            if (!apiToken) {
                alert('You must log in first.');
                window.location.href = '/';
            }

            // Get Post ID from URL
            const urlParams = new URLSearchParams(window.location.search);
            const postId = urlParams.get('id');

            if (!postId) {
                alert('No post ID provided.');
                window.location.href = '/allposts';
            }

            // Fetch Post Data
            $.ajax({
                url: `/api/posts/${postId}`,
                type: 'GET',
                headers: {
                    Authorization: `Bearer ${apiToken}`
                },
                success: function (response) {
                    const post = response.data.post[0];
                    $('#postTitle').text(post.title);
                    $('#postImage').attr('src', `/uploads/${post.image}`);
                    $('#postDescription').text(post.descripton);
                },
                error: function () {
                    alert('Failed to fetch post data.');
                    window.location.href = '/allposts';
                }
            });
        });
    </script>
</body>

</html>
