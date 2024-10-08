<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin NP FATMAWATI</title>
    <link rel="shortcut icon" href="{{ asset('images/reverse.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>
    
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        .sidebar-collapsed {
            transform: translateX(-100%);
            opacity: 0;
            pointer-events: none; /* Prevent mouse events */
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 40;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100 ">
        <!-- Sidebar Toggle Button -->
        <button id="sidebarToggle" class="draggable fixed top-4  z-50 bg-white p-2 rounded-md shadow-md">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar bg-white w-64 min-h-screen flex flex-col fixed left-0 top-0 bottom-0 transition-transform duration-300 ease-in-out transform z-10">
            <div class="flex items-center justify-between h-16 border-b border-gray-200 px-4">
                <img src="{{ asset('images/logo color.png') }}" alt="Primagama Logo" class="h-10">
            </div>
            <div class="flex items-center space-x-4 px-4 py-6 border-b border-gray-200">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                    class="w-12 h-12 rounded-full">
                <div>
                    <span class="block font-semibold">{{ Auth::user()->name }}</span>
                    <span class="text-sm text-gray-500">{{ ucfirst(Auth::user()->role) }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
            <ul class="space-y-2 flex-1 overflow-y-auto p-3">
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
            </ul>
        </nav>

        <!-- Main Content -->
        <main id="mainContent" class="flex-1 p-8 transition-all duration-300 ease-in-out"> <!-- Add transition for smooth movement -->
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // Toggle sidebar
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');

        // Start with sidebar open
        sidebar.classList.remove('sidebar-collapsed');
        mainContent.classList.add('ml-64');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('ml-64'); // Adjust for main content when sidebar is open
            mainContent.classList.toggle('ml-0');   // Adjust for main content when sidebar is closed
        });

        // Make the toggle button draggable
        interact('.draggable')
            .draggable({
                listeners: {
                    move(event) {
                        const target = event.target;
                        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                        target.style.transform = `translate(${x}px, 0)`;
                        target.setAttribute('data-x', x);
                        
                        // Adjust sidebar position based on drag distance
                        if (x > 100) {
                            sidebar.classList.remove('sidebar-collapsed');
                            mainContent.classList.remove('ml-0');
                            mainContent.classList.add('ml-64');
                        } else if (x < -100) {
                            sidebar.classList.add('sidebar-collapsed');
                            mainContent.classList.remove('ml-64');
                            mainContent.classList.add('ml-0');
                        }
                    },
                },
            });
    </script>
</body>

</html>
