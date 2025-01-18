<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Create New Post</h2>
        <form id="createPostForm">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="descripton" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            const apiToken = localStorage.getItem('api_token');
            if (!apiToken) {
                alert('You must log in first.');
                window.location.href = '/';
            }

            $('#createPostForm').on('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                $.ajax({
                    url: '/api/posts',
                    type: 'POST',
                    headers: {
                        Authorization: `Bearer ${apiToken}`
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function () {
                        alert('Post created successfully.');
                        window.location.href = '/allposts';
                    },
                    error: function () {
                        alert('Failed to create post.');
                    }
                });
            });
        });
    </script>
</body>

</html>
