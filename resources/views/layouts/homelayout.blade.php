<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title', 'Home')</title>
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}" />
</head>
<body>
    @include('components.navbar') <!-- Include the Navbar -->

    <div class="container mx-auto">
        @yield('content')
    </div> 
    @include('home.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    @yield('scripts')
        <script src="{{ asset('js/app.js') }}"></script> <!-- If you have any JS files -->
</body>
</html>
