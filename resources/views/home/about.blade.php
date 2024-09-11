@extends('layouts.homelayout')

@section('title', 'New Primagama Fatmawati | About')

@section('content')
    <div class="bg-gray-100 text-gray-800 p-8">
        <section class="max-w-7xl mx-auto">
            {{-- Hero Section --}}
            <div class="relative mb-12 h-96 overflow-hidden rounded-2xl shadow-lg">
                <img src="{{ asset('images/spanduk 459x217 cmyk.jpg') }}" alt="Hero" class="w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-500 opacity-70"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <h2 class="text-5xl font-bold text-white animate-fade-in">Lorem</h2>
                </div>
            </div>

            {{-- Company Introduction --}}
            <div class="flex flex-col md:flex-row items-center mb-12">
                <img src="{{ asset('images/gedung.png') }}" alt="Company" class="w-full md:w-1/2 rounded-lg shadow-lg mb-6 md:mb-0 md:mr-6 transform hover:scale-105 transition duration-300">
                <div>
                    <h2 class="text-4xl font-semibold mb-4 text-gray-900">Perkenalan Perusahaan</h2>
                    <p class="text-lg text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore temporibus nisi corporis recusandae soluta vero exercitationem corrupti! In enim perferendis tenetur officia accusantium, laboriosam consequatur ut? Reprehenderit dolorem labore cupiditate?</p>
                </div>
            </div>

            {{-- History Section --}}
            <div class="mb-12">
                <h2 class="text-4xl font-semibold mb-6 text-gray-900">Sejarah Perusahaan</h2>
                <p class="text-lg mb-6 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum non blanditiis tenetur porro, modi tempore provident voluptatum ex, quidem dignissimos nisi? Mollitia commodi aspernatur vero optio deserunt similique recusandae voluptatibus!</p>
                <div class="space-y-4">
                    <div class="p-4 bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800">In [Year], we achieved [Milestone]</h3>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800">In [Year], we launched [Product/Service]</h3>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800">In [Year], we expanded to [Location]</h3>
                    </div>
                </div>
            </div>

            {{-- Mission Section --}}
            <div class="mb-12">
                <h2 class="text-4xl font-semibold mb-6 text-gray-900">Misi Kami</h2>
                <p class="text-lg text-gray-600">We are committed to delivering the best products and services to our customers while continuously innovating and improving our processes.</p>
            </div>

            {{-- Team Section --}}
            <div class="mb-12">
                <h2 class="text-4xl font-semibold mb-6 text-gray-900">Tim Kami</h2>
                <div class="flex flex-wrap justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-4 transform hover:scale-105 transition duration-300">
                        <img src="{{ asset('images/robot zen.png') }}" alt="Team Member" class="w-full rounded-lg shadow-lg mb-2">
                        <h3 class="text-xl font-semibold text-gray-800">Raifan</h3>
                        <p class="text-gray-600">CEO</p>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-4 transform hover:scale-105 transition duration-300">
                        <img src="{{ asset('images/robot zen.png') }}" alt="Team Member" class="w-full rounded-lg shadow-lg mb-2">
                        <h3 class="text-xl font-semibold text-gray-800">Trimei</h3>
                        <p class="text-gray-600">CTO</p>
                    </div>
                    {{-- Add more team members as needed --}}
                </div>
            </div>

            {{-- Values Section --}}
            <div class="mb-12">
                <h2 class="text-4xl font-semibold mb-6 text-gray-900">Kelebihan Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Integrity</h3>
                        <p class="text-gray-600">We uphold the highest standards of integrity in all our actions.</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Innovation</h3>
                        <p class="text-gray-600">We continuously seek new and innovative ways to improve our products and services.</p>
                    </div>
                    <div class="p-6 bg-white rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Customer Focus</h3>
                        <p class="text-gray-600">Our customers are at the center of everything we do.</p>
                    </div>
                </div>
            </div>

            {{-- Video Section --}}
            <div class="relative overflow-hidden bg-white text-black py-16 rounded-2xl">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-bold text-center mb-12">Video Perusahaan</h1>
                    <div class="text-center mb-8">
                        <button id="play-video" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5">Play</button>
                    </div>
                    <div id="video-container" class="hidden relative w-full md:w-3/4 lg:w-2/3 h-96 mx-auto">
                        <iframe id="video-iframe" class="w-full h-full rounded-lg shadow-lg" src="https://youtu.be/3isFCa3wf2I?si=Ly9SLfJu4XsCPHvv" title="Company Journey" frameborder="0" allowfullscreen></iframe>
                        <div class="text-center mt-8">
                            <button id="close-video" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Google Map Section --}}
        <div class="md:col-span-1 text-center relative top-2">
            <div style="overflow: hidden;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.806268294965!2d106.7925888740973!3d-6.289176161555781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1ead17c309f%3A0xc1f346ea893a18be!2sZENIUS%20CENTER!5e0!3m2!1sid!2sid!4v1720591356159!5m2!1sid!2sid" width="100%" height="450" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

 x
    {{-- Add JavaScript to handle video display --}}
    <script>
        document.getElementById('play-video').onclick = function () {
            document.getElementById('video-iframe').src = '{{ asset('images/wheels-syfy.mp4') }}';
            document.getElementById('video-container').classList.remove('hidden');
        };

        document.getElementById('close-video').onclick = function () {
            document.getElementById('video-iframe').src = '';
            document.getElementById('video-container').classList.add('hidden');
        };
    </script>
@endsection
