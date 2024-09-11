<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-gradient-to-r from-purple-950 to-blue-800 p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-lg font-bold pl-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo White.png') }}" class="h-11" alt="Logo" />
            </a>
        </div>
        <div class="lg:hidden">
            <button
                id="navbar-toggle"
                class="text-white focus:outline-none focus:text-white"
                onclick="toggleNavbar()"
            >
                <svg
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M4 6h16M4 12h16m-7 6h7"
                    />
                </svg>
            </button>
        </div>
        <div id="navbar" class="lg:flex lg:flex-grow items-center hidden">
            <div class="lg:flex lg:items-center lg:justify-end lg:flex-grow">
                <div class="flex flex-col lg:flex-row lg:space-x-8 lg:items-center lg:space-y-4 space-y-4">
                    <a href="{{ route('home') }}" class="text-yellow-400 hover:text-yellow-200">Home</a>
                    <a href="{{ route('home.about') }}" class="text-yellow-400 hover:text-yellow-200">About Us</a>
                    <a href="#contact" class="text-yellow-400 hover:text-yellow-200">Contact</a>
                    @if(Auth::check())
                        {{-- <a href="{{ route('siswa.dashboard') }}" class="text-yellow-400 hover:text-yellow-200">Siswa Dashboard</a> --}}
                    @else
                        <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-200">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleNavbar() {
        const navbar = document.getElementById('navbar');
        navbar.classList.toggle('hidden');
    }
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
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
</script>
