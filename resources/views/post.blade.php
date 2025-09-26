<!DOCTYPE html>
<html>
<head>
    <title>Laravel Sanctum API Demo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Posts</h1>
    <div id="posts"></div>

    <h2>Create Post</h2>
    <form id="postForm">
        <input type="text" name="title" placeholder="Title" required><br><br>
        <textarea name="content" placeholder="Content"></textarea><br><br>
        <button type="submit">Create Post</button>
    </form>

    <script>
        let token = ""; // will set after login

        // Fetch posts
        async function loadPosts() {
            let res = await fetch("http://127.0.0.1:8000/api/posts");
            let data = await res.json();
            document.getElementById("posts").innerHTML = data.data.map(p => `
                <p><strong>${p.title}</strong><br>${p.content || ''} (by ${p.user.name})</p>
            `).join("");
        }

        // Handle post creation
        document.getElementById("postForm").addEventListener("submit", async (e) => {
            e.preventDefault();
            let form = e.target;
            let body = {
                title: form.title.value,
                content: form.content.value
            };

            let res = await fetch("http://127.0.0.1:8000/api/posts", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer " + token
                },
                body: JSON.stringify(body)
            });

            let data = await res.json();
            alert(data.message || "Error");
            loadPosts();
        });

        // Login first (replace with real email/password)
        async function login() {
            let res = await fetch("http://127.0.0.1:8000/api/login", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email: "test@example.com", password: "password" })
            });

            let data = await res.json();
            token = data.data.access_token;
            console.log("Logged in! Token:", token);
            loadPosts();
        }

        login();
    </script>
</body>
</html>
