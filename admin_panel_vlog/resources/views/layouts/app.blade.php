<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Name</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Your App</a>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Your App &copy; {{ date('Y') }}</span>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
