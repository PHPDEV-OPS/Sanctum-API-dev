<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 12 Sanctum Demo</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav>
        <h1>Sanctum Demo</h1>
        <div class="links">
            <a href="/register">Register</a>
            <a href="/login">Login</a>
            <a href="/posts">Posts</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
