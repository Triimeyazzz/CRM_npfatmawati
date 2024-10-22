<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin NP FATMAWATI</title>
    <link rel="shortcut icon" href="{{ asset('images/Reverse.png') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AOS Library for animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: all 0.3s ease-in-out;
        }
        .sidebar-collapsed {
            transform: translateX(-100%);
        }
        .menu-item {
            transition: all 0.2s ease-in-out;
        }
        .menu-item:hover {
            background-color: rgba(99, 102, 241, 0.1);
            color: #4F46E5;
        }
        .menu-item.active {
            background-color: #4F46E5;
            color: white;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar Toggle Button -->
        <button id="sidebarToggle" class="fixed top-4 left-4 z-50 bg-white p-2 rounded-full shadow-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <i class="fas fa-bars text-gray-600"></i>
        </button>

        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar bg-white w-64 min-h-screen flex flex-col fixed left-0 top-0 bottom-0 shadow-xl z-40">
            <div class="flex items-center justify-center h-16 border-b border-gray-200 px-4">
                <a href="/">
                    <img src="{{ asset('images/Logo Color.png') }}" alt="Primagama Logo" class="h-10">
                </a>
            </div>
            <div class="flex items-center space-x-4 px-4 py-6 border-b border-gray-200">
                <img src="{{ asset('storage/profile_picture' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                    class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500">
                <div>
                    <span class="block font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="text-sm text-indigo-600">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>
            <ul class="space-y-2 flex-1 overflow-y-auto p-4">
                <!-- Menu items -->
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('dashboard') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fas fa-tachometer-alt inline-block"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('profile.edit') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fas fa-user-edit inline-block"></i>
                        <span class="ml-3">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('users.index') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fas fa-user-shield inline-block"></i>
                        <span class="ml-3">Admin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminsiswa.index') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('adminsiswa.index') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span class="ml-3">Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tryout.index') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('tryout.index') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fa-solid fa-marker"></i>
                        <span class="ml-3">Try out</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pembayaran.index') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('pembayaran.index') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fa-solid fa-money-bill"></i>
                        <span class="ml-3">Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ulasan.index') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('ulasan.index') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fa-solid fa-star"></i>
                        <span class="ml-3">Ulasan </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('absensi.index') }}"
                        class="block px-6 py-3 rounded-lg text-gray-700 bg-gradient-to-r from-white to-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 ease-in-out active:bg-gray-200
                        {{ request()->routeIs('absensi.index') ? 'border-b-2 border-purple-500' : '' }}">
                        <i class="fa-solid fa-book"></i>
                        <span class="ml-3">Absensi </span>
                    </a>
                </li>
                <!-- Add other menu items similarly -->
            </ul>
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">Logout</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <main id="mainContent" class="flex-1 p-8 ml-64 transition-all duration-300 ease-in-out">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white rounded-lg shadow-md p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Initialize AOS
        AOS.init();

        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('ml-64');
            mainContent.classList.toggle('ml-0');
        });

        // Responsive sidebar behavior
        function checkWindowSize() {
            if (window.innerWidth < 768) {
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-0');
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                mainContent.classList.add('ml-64');
                mainContent.classList.remove('ml-0');
            }
        }

        window.addEventListener('resize', checkWindowSize);
        checkWindowSize(); // Initial check
    </script>
</body>
</html>