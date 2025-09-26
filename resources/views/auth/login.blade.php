@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Login</h2>
    <form id="loginForm">
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don’t have an account? <a href="/register">Register</a></p>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        console.log("Form submitted...");

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        try {
            let res = await fetch("{{ url('/api/login') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email, password })
            });

            let data = await res.json();
            console.log("Response:", data);

            if (res.ok) {
                localStorage.setItem("token", data.data.access_token);
                window.location.href = "/posts";
            } else {
                alert(data.message || "Login failed");
            }
        } catch (err) {
            console.error("Error parsing response:", err);
            alert("Something went wrong. Check console.");
        }
    });
});
</script>
@endsection
