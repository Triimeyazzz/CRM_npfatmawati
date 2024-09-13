<nav class="bg-gradient-to-r from-purple-950 to-blue-800 p-4 sticky top-0 z-50 transition-all duration-300 ease-in-out"
    id="main-nav">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-lg font-bold pl-4">
            <a href="{{ route('home') }}" class="flex items-center transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('images/Logo White.png') }}" class="h-11" alt="Logo" />
            </a>
        </div>
        <div class="lg:hidden">
            <button id="navbar-toggle"
                class="text-white focus:outline-none transition-transform duration-300 hover:scale-110"
                onclick="toggleNavbar()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <div id="navbar" class="lg:flex lg:flex-grow items-center hidden">
            <div class="lg:flex lg:items-center lg:justify-end lg:flex-grow">
                <div class="flex flex-col lg:flex-row lg:space-x-8 lg:items-center lg:space-y-0 space-y-4">
                    @php
                        $navItems = [
                            ['route' => 'home', 'name' => 'Home'],
                            ['route' => 'home.about', 'name' => 'About Us'],
                            ['href' => '#contact', 'name' => 'Contact'],
                        ];

                        // Check if the user is logged in as a 'siswa'
                        if (Auth::guard('siswa')->check()) {
                            $navItems[] = ['route' => 'siswa.dashboard', 'name' => 'Siswa Dashboard'];
                            $navItems[] = ['route' => 'siswa.attendance', 'name' => 'Absensi'];
                        }
                        // Check if the user is logged in as admin
                        elseif (Auth::check()) {
                            $navItems[] = ['route' => 'dashboard', 'name' => 'Admin Dashboard'];
                        }
                        // If no user is logged in
                        else {
                            $navItems[] = ['route' => 'login', 'name' => 'Login'];
                        }
                    @endphp

                    @foreach ($navItems as $item)
                        <a href="{{ isset($item['route']) ? route($item['route']) : $item['href'] }}"
                            class="text-yellow-400 hover:text-yellow-200 transition-all duration-300 ease-in-out transform hover:scale-110 {{ isset($item['route']) && request()->routeIs($item['route']) ? 'border-b-2 border-purple-500' : '' }}">
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleNavbar() {
        const navbar = document.getElementById('navbar');
        navbar.classList.toggle('hidden');
        navbar.classList.toggle('animate-fade-in-down');
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Shrink navbar on scroll
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('main-nav');
        if (window.scrollY > 100) {
            nav.classList.add('py-2');
            nav.classList.remove('p-4');
        } else {
            nav.classList.add('p-4');
            nav.classList.remove('py-2');
        }
    });

    // Add this to your CSS or in a <style> tag
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    `;
    document.head.appendChild(style);
</script>
