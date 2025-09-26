@extends('layouts.app')

@section('content')
<div class="card">
    <h2 style="display:inline-block;">Posts</h2>
    <button id="logoutBtn" class="logout-btn">Logout</button>

    <div id="posts" class="mt-4"></div>
</div>

<div class="card">
    <h3>Create Post</h3>
    <form id="postForm">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content"></textarea>
        <button type="submit">Create Post</button>
    </form>
</div>

<script>
let token = localStorage.getItem("token");
if (!token) {
    window.location.href = "/login";
}

// Load posts
async function loadPosts() {
    let res = await fetch("/api/posts");
    let data = await res.json();
    let posts = data.data;
    document.getElementById("posts").innerHTML = posts.map(p => `
        <div class="post">
            <h4>${p.title}</h4>
            <p>${p.content || ''}</p>
            <small>By: ${p.user.name}</small>
        </div>
    `).join("");
}

// Create post
document.getElementById("postForm").addEventListener("submit", async (e) => {
    e.preventDefault();
    let form = e.target;

    let res = await fetch("/api/posts", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + token
        },
        body: JSON.stringify({
            title: form.title.value,
            content: form.content.value
        })
    });

    let data = await res.json();
    if (res.ok) {
        form.reset();
        loadPosts();
    } else {
        alert(JSON.stringify(data.errors || data.message));
    }
});

// Logout
document.getElementById("logoutBtn").addEventListener("click", async () => {
    let res = await fetch("/api/logout", {
        method: "POST",
        headers: { "Authorization": "Bearer " + token }
    });

    if (res.ok) {
        localStorage.removeItem("token");
        window.location.href = "/login";
    } else {
        alert("Failed to logout.");
    }
});

loadPosts();
</script>
@endsection
