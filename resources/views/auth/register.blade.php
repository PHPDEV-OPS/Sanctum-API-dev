@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Register</h2>
    <form id="registerForm" onsubmit="return false;">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="/login">Login</a></p>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        let res = await fetch("{{ url('/api/register') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                name: form.name.value,
                email: form.email.value,
                password: form.password.value,
                password_confirmation: form.password_confirmation.value
            })
        });

        let data = await res.json();
        if (res.ok) {
            localStorage.setItem("token", data.data.access_token);
            window.location.href = "/posts";
        } else {
            alert(JSON.stringify(data.errors || data.message));
        }
    });
});
</script>
@endsection
