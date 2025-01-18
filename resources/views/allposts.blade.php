<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <button id="addPostButton" class="btn btn-primary mb-3">Add New Post</button>
            <button id="logoutButton" class="btn btn-danger mb-3">Logout</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>View</th>
                    <th>Delete</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody id="postsTableBody">
                <!-- Rows will be populated dynamically -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            const apiToken = localStorage.getItem('api_token');
            if (!apiToken) {
                alert('You must log in first.');
                window.location.href = '/';
            }

            // Fetch all posts
            function fetchPosts() {
                $.ajax({
                    url: '/api/posts',
                    type: 'GET',
                    headers: {
                        Authorization: `Bearer ${apiToken}`
                    },
                    success: function (response) {
                        const posts = response.data.post;
                        const tbody = $('#postsTableBody');
                        tbody.empty();
                        posts.forEach(post => {
                            tbody.append(`
                                <tr>
                                    <td>${post.title}</td>
                                    <td>${post.descripton}</td>
                                    <td><button class="btn btn-info view-post" data-id="${post.id}">View</button></td>
                                    <td><button class="btn btn-danger delete-post" data-id="${post.id}">Delete</button></td>
                                    <td><button class="btn btn-link view-author" data-email="${post.author}">${post.author}</button></td>

                                </tr>
                            `);
                        });
                    },
                    error: function () {
                        alert('Failed to fetch posts.');
                    }
                });
            }

            fetchPosts();

            // Redirect to create post page
            $('#addPostButton').on('click', function () {
                window.location.href = '/addpost';
            });

            // Redirect to single post page
            $(document).on('click', '.view-post', function () {
                const postId = $(this).data('id');
                window.location.href = `/singlepost?id=${postId}`;
            });
            // Redirect to user profile page
            $(document).on('click', '.view-author', function () {
                const authorEmail = $(this).data('email');
                window.location.href = `/userprofile?email=${authorEmail}`;
            });


            // Logout functionality
            $('#logoutButton').on('click', function () {
                $.ajax({
                    url: '/api/logout',
                    type: 'POST',
                    headers: {
                        Authorization: `Bearer ${apiToken}`
                    },
                    success: function (response) {
                        alert(response.message);
                        localStorage.removeItem('api_token');
                        window.location.href = '/';
                    },
                    error: function () {
                        alert('Logout failed.');
                    }
                });
            });

            // Delete a post
            $(document).on('click', '.delete-post', function () {
                const postId = $(this).data('id');
                if (confirm('Are you sure you want to delete this post?')) {
                    $.ajax({
                        url: `/api/posts/${postId}`,
                        type: 'DELETE',
                        headers: {
                            Authorization: `Bearer ${apiToken}`
                        },
                        success: function (response) {
                            alert(response.message);
                            fetchPosts();
                        },
                        error: function () {
                            alert('Failed to delete the post.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
