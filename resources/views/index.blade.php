<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navbar or Header -->
    @include('partials.header')

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.footer')

    @stack('scripts')
</body>
</html>
