<!-- resources/views/home.blade.php -->
@extends('layouts.homelayout')

@section('content')
    <div class="mx-auto w-full max-w-screen-xl mt-3 rounded-3xl">
        <div class="slider">
            <div>
                <img
                    src="{{ asset('images/spanduk 459x217 cmyk.jpg') }}"
                    alt="spanduk"
                    class="w-full h-auto object-cover rounded-3xl"
                />
            </div>
            <div>
                <img
                    src="{{ asset('images/main4.jpg') }}"
                    alt="another spanduk"
                    class="w-full h-auto object-cover rounded-3xl"
                />
            </div>
            <div>
                <img
                    src="{{ asset('images/main2.jpg') }}"
                    alt="another spanduk"
                    class="w-full h-auto object-cover rounded-3xl"
                />
            </div>
            <div>
                <img
                    src="{{ asset('images/banner1.jpg') }}"
                    alt="spanduk"
                    class="w-full h-auto object-cover rounded-3xl"
                />
            </div>
        </div>
    </div>
    <div class="relative overflow-hidden bg-gray-100 text-black py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8" data-aos="fade-up">
                <h1 class="text-4xl font-bold mb-4 text-purple-900">
                    Skor <span class="text-yellow-400"> PISA 2023</span>
                </h1>
            </div>
            <div class="relative h-96" data-aos="fade-up">
                <canvas id="barChart"></canvas>
            </div>
            <div class="relative overflow-hidden bg-white shadow-lg text-black py-16 rounded-3xl">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-bold text-center mb-12 text-purple-800">
                        Faktor-faktor <span class="text-yellow-400">PISA</span>
                    </h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        <img src="./images/PISA.png" alt="Logo" class="absolute inset-0 w-1/2 opacity-10 m-auto" />
                        @foreach ($dataPisa['description'] as $index => $item)
                            <div
                                data-aos="fade-up"
                                data-aos-delay="{{ $index * 100 }}"
                                class="text-lg mb-8 text-gray-600 bg-white hover:shadow-2xl shadow-xl p-3 text-center rounded-xl"
                            >
                                <h2 class="text-xl font-semibold mb-2">
                                    <b>{{ $item['title'] }}</b>
                                </h2>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white text-gray-800 relative z-30 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center bg-white">
                <div class="md:col-span-3 text-center" data-aos="fade-up">
                    <h1 class="text-4xl font-bold mb-4 text-purple-800">
                        Permasalahan Yang Sering Dihadapi Siswa
                    </h1>
                </div>
                <div class="md:col-span-1 text-center relative top-2" data-aos="fade-right">
                    <img src="{{ asset('images/anakpusing.png') }}" alt="Robot Zenius" class="w-80 mx-auto" />
                </div>
                <div class="md:col-span-2 text-black" data-aos="fade-left">
                    <p class="text-lg mb-8">
                        <ul class="mb-2">
                            <li>
                                <span style="color: #63E6BE; margin-right: 5px;">&#10004;</span>
                                Materi yang dibahas disekolah sering kurang tuntas
                            </li>
                            <li>
                                <span style="color: #63E6BE; margin-right: 5px;">&#10004;</span>
                                Kurang memahami materi yang diajarkan disekolah
                            </li>
                            <li>
                                <span style="color: #63E6BE; margin-right: 5px;">&#10004;</span>
                                Sering kesulitan dalam pengerjaan Tugas dan PR
                            </li>
                            <li>
                                <span style="color: #63E6BE; margin-right: 5px;">&#10004;</span>
                                Belajar dirumah tidak ada yang bantu mengajari
                            </li>
                        </ul>
                        Siswa tidak memiliki pendamping belajar, yang dapat membantu mengatasi kesulitan belajar masing-masing.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 text-gray-800 relative z-30 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="md:col-span-3 text-center" data-aos="fade-up">
                    <h1 class="text-4xl font-bold mb-4">
                        {{ $contentData[0]['title'] }}
                    </h1>
                </div>
            </div>
            <img src="./images/Reverse.png" alt="Logo" class="absolute inset-0 opacity-10 m-auto" />
            @foreach($contentData as $index => $data)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    @if($index % 2 === 0)
                        <div class="md:col-span-1 text-center relative top-2" data-aos="{{ $data['aosImage'] }}">
                            <img src="{{ $data['imgSrc'] }}" alt="{{ $data['imgAlt'] }}" class="w-80 mx-auto" />
                        </div>
                        <div class="md:col-span-2 text-black" data-aos="{{ $data['aosText'] }}">
                            <h1 data-aos="fade-up" class="text-4xl font-bold mb-4">
                                {{ $data['heading'] }}
                            </h1>
                            <p class="text-lg mb-8">
                                {{ $data['text'] }}
                            </p>
                        </div>
                    @else
                        <div class="md:col-span-2 text-black" data-aos="{{ $data['aosText'] }}">
                            <h1 data-aos="fade-up" class="text-4xl font-bold mb-4">
                                {{ $data['heading'] }}
                            </h1>
                            <p class="text-lg mb-8">
                                {{ $data['text'] }}
                            </p>
                        </div>
                        <div class="md:col-span-1 text-center relative top-2" data-aos="{{ $data['aosImage'] }}">
                            <img src="{{ $data['imgSrc'] }}" alt="{{ $data['imgAlt'] }}" class="w-80 mx-auto" />
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mx-auto py-6">
        <h2 class="text-2xl font-bold text-center mb-6">Komponen Belajar</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ($komponenBelajar as $item)
                <div key="{{ $item['id'] }}" class="flex flex-col items-center">
                    <img 
                        src="{{ asset($item['imgSrc']) }}" 
                        alt="{{ $item['imgAlt'] }}" 
                        class="w-20 h-20 object-cover rounded-full mb-2" 
                    />
                    <h3 class="text-sm font-medium text-center">{{ $item['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>

    <div id="contact" class="bg-gray-100 py-16 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center mb-12">Hubungi Kami</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="col-span-2 bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold mb-4">Kirim Pesan</h2>
                    @if(session('success'))
                        <p class="text-green-500 mt-4 text-center">{{ session('success') }}</p>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-600 focus:border-purple-600 sm:text-sm"
                                placeholder="Nama Anda"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-600 focus:border-purple-600 sm:text-sm"
                                placeholder="Email Anda"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea
                                id="message"
                                name="message"
                                rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-600 focus:border-purple-600 sm:text-sm"
                                placeholder="Pesan Anda"
                                required
                            ></textarea>
                        </div>
                        <div class="text-center">
                            <button
                                type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-500 hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                            >
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <h2 class="text-2xl font-semibold mb-4">Hubungi langsung</h2>
                    <p class="text-lg mb-4">
                        Telepon: +62 818936487
                        <br />
                        Email: example@example.com
                        <br />
                        Alamat: Jl. RS. Fatmawati Raya No.3, RT.3/RW.5, Cilandak Bar., Kec. Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12430
                    </p>
                    <a
                        href="https://wa.me/62818936487?text={{ urlencode('Halo aku sudah melihat Penawaran yang ada dan aku sangat tertarik dengan New Primagama Fatmawati') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-white bg-gradient-to-r from-purple-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg px-5 py-2.5 text-center mt-2"
                    >
                        WhatsApp Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="md:col-span-1 text-center relative top-2" data-aos="fade-left">
        <div style="overflow: hidden;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3310.002367157647!2d106.79258077409723!3d-6.289176161555731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1a3b89448c9%3A0x3d08c6224ca74cd0!2sNew%20Primagama%20-%20Fatmawati%20-%20Jakarta%20Selatan!5e1!3m2!1sid!2sid!4v1723790365731!5m2!1sid!2sid"
                width="100%"
                height="450"
                style="border: 0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
    @endsection
    @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function(){
            $('.slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                adaptiveHeight: true,
                fade: true,
            });
        });

        const dataPisa = @json($dataPisa['barData']);
        
        const ctx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataPisa.labels,
                datasets: dataPisa.datasets
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return value;
                            },
                        },
                    },
                },
            },
        });
    
    </script>
@endsection
