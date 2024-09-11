<!-- resources/views/layouts/siswalayout.blade.php -->
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
<body class="bg-gray-100">
    @include('components.navbar') 

    <!-- Display the logged-in student's name and photo -->
    @auth('siswa')
        <div class="flex items-center p-4 bg-blue-800 text-white shadow-md">
            <img src="{{ asset('storage/fotos/' . $siswaInfo['foto']) }}" alt="{{ $siswaInfo['nama'] }}"
            class="w-12 h-12 rounded-full mr-3 border-2 border-white">
            <div>
                <span class="font-semibold text-lg">{{ Auth::user()->nama }}</span>
                <p class="text-sm">Masuk sebagai siswa</p>
                <form method="POST" action="{{ route('logout') }}" >
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            </div>
        </div>
    @endauth


    <div class="container mx-auto py-6">
        @yield('content')
    </div> 

    @include('home.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    @yield('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}"></script> <!-- If you have any JS files -->
</body>
</html>