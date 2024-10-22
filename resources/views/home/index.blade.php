<!-- resources/views/home.blade.php -->
@extends('layouts.homelayout')

@section('content')
<div class="mx-auto w-full max-w-screen-xl mt-3 p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left Column - Building Info -->
        <div class=" rounded-3xl p-6 ">
            <div class="flex items-start space-x-4">
                <div class="w-1/2">
                    <div class="relative rounded-2xl overflow-hidden">
                        <img 
                            src="{{ asset('images/fatmawati gedung copy 1.png') }}" 
                            alt="Primagama Building"
                            class="w-full h-auto object-cover"
                        >
                    </div>
                </div>
                <div class="w-1/2 mt-7">
                    <h2 class="text-2xl font-bold mb-2 text-purple-800">NEW PRIMAGAMA FATMAWATI</h2>
                    <p class="text-sm text-black">
                        Jl. RS. Fatmawati Raya No.4 J,<br>
                        RT3/RW5, Cilandak Barat,<br>
                        Cilandak, Jakarta Selatan
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Column - Slider -->
        <div class="rounded-3xl overflow-hidden">
            <div class="relative">
                <div class="slider">
                    @foreach(['Spanduk 459x217 cmyk.jpg', 'main4.jpg', 'main2.jpg', 'banner1.jpg', 'main5.jpeg', 'main6.jpeg', 'main7.jpeg', 'main8.jpeg'] as $image)
                        <div>
                            <img 
                                src="{{ asset('images/' . $image) }}" 
                                alt="Primagama Slide"
                                class="w-full h-auto object-cover rounded-3xl"
                            >
                        </div>
                    @endforeach
                </div>
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    @foreach(range(1, 8) as $dot)
                        <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-colors duration-200"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<x-education-facts />
    <div class="bg-gradient-to-br from-purple-100 to-blue-100 text-gray-800 relative z-30 py-16 px-4 sm:px-6 lg:px-8 mt-16">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold mb-4 text-purple-800 animate-pulse">
                    Permasalahan Yang Sering Dihadapi Siswa
                </h1>
                <p class="text-xl text-gray-600">Mari kita jelajahi tantangan umum yang dihadapi para pelajar</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
                <div class="md:col-span-1 text-center relative transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/anakpusing.png') }}" alt="Siswa Bingung" class="w-full max-w-sm mx-auto rounded-full shadow-2xl" />
                </div>
                
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
                        <h2 class="text-2xl font-semibold mb-4 text-purple-700">Tantangan Utama:</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center text-lg">
                                <span class="text-green-500 mr-3 text-2xl">&#10004;</span>
                                <span class="flex-grow">Materi yang dibahas di sekolah sering kurang tuntas</span>
                                <button class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm hover:bg-blue-600 transition-colors duration-300"
                                onclick="openModal('Ini bisa menyebabkan kesenjangan pemahaman dan kesulitan dalam mengikuti pelajaran selanjutnya.')">
                                Info
                            </button>
                            </li>
                            <li class="flex items-center text-lg">
                                <span class="text-green-500 mr-3 text-2xl">&#10004;</span>
                                <span class="flex-grow">Kurang memahami materi yang diajarkan di sekolah</span>
                                <button class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm hover:bg-blue-600 transition-colors duration-300"
                                onclick="openModal('Hal ini dapat mengakibatkan penurunan motivasi belajar dan kepercayaan diri siswa.')">
                                Info
                            </button>
                            
                            </li>
                            <li class="flex items-center text-lg">
                                <span class="text-green-500 mr-3 text-2xl">&#10004;</span>
                                <span class="flex-grow">Sering kesulitan dalam pengerjaan Tugas dan PR</span>
                                <button class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm hover:bg-blue-600 transition-colors duration-300"
                                onclick="openModal('Kesulitan ini dapat menyebabkan stres dan kecemasan pada siswa.')">
                                Info
                            </button>
                            </li>
                            <li class="flex items-center text-lg">
                                <span class="text-green-500 mr-3 text-2xl">&#10004;</span>
                                <span class="flex-grow">Belajar di rumah tidak ada yang bantu mengajari</span>
                                <button class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm hover:bg-blue-600 transition-colors duration-300"
                                onclick="openModal('Kurangnya dukungan di rumah dapat menghambat perkembangan akademik siswa.')">
                                Info
                            </button>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded-r-xl shadow-md">
                        <p class="text-lg text-yellow-800">
                            <strong>Perhatian:</strong> Siswa sering kali tidak memiliki pendamping belajar yang dapat membantu mengatasi kesulitan belajar masing-masing.
                        </p>
                    </div>
                    
                    <div class="text-center mt-8">
                        <button class="bg-purple-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-purple-700 transition-colors duration-300 transform hover:scale-105"
                                onclick="openModal('Kami siap membantu Anda mengatasi tantangan belajar!')">
                            Dapatkan Bantuan Sekarang!
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto">
            <h2 class="text-2xl font-semibold mb-4 text-purple-700">Informasi</h2>
            <p class="text-gray-700 mb-6" id="modal-content">
                Ini adalah informasi terkait masalah yang dihadapi siswa.
            </p>
            <div class="flex justify-end">
                <button onclick="closeModal()" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors duration-300">Tutup</button>
            </div>
        </div>
    </div>
    

    <div class="bg-gradient-to-br from-blue-100 to-purple-100 text-gray-800 relative z-30 py-16 px-4 sm:px-6 lg:px-8 sm:py-24 lg:py-32 mt-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold mb-4 text-purple-800 animate-pulse">
                {{ $contentData[0]['title'] }}
            </h1>
            <p class="text-xl text-gray-600">Temukan keunggulan belajar bersama kami</p>
        </div>

        <div class="space-y-24">
            @foreach($contentData as $index => $data)
                @if($index > 0) <!-- Skip the first item as it's the title -->
                    <div class="bg-white rounded-xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-300" ="{{ $data['aosText'] }}">
                        <div class="md:flex">
                            <div class="md:w-1/3 bg-gradient-to-br from-purple-500 to-indigo-600 text-white p-6 flex items-center justify-center">
                                <img src="{{ $data['imgSrc'] }}" alt="{{ $data['imgAlt'] }}" class="w-40 h-40 object-cover rounded-full border-4 border-white shadow-lg" />
                            </div>
                            <div class="md:w-2/3 p-8">
                                <h2 class="text-3xl font-bold mb-4 text-purple-700">{{ $data['heading'] }}</h2>
                                <p class="text-lg text-gray-600 mb-6">{{ $data['text'] }}</p>
                                <button class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors duration-300" onclick="showMore('{{ $data['id'] }}')">Pelajari Lebih Lanjut</button>
                            </div>
                        </div>
                        <div id="more-{{ $data['id'] }}" class="hidden p-6 bg-purple-50 border-t border-purple-100">
                            <p class="text-gray-700">Informasi tambahan tentang {{ $data['heading'] }} akan ditampilkan di sini. Anda dapat menambahkan detail lebih lanjut, testimoni, atau tautan terkait untuk memberikan informasi yang lebih komprehensif kepada calon siswa.</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Decorative elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-yellow-300 rounded-full opacity-20 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-purple-300 rounded-full opacity-20 animate-pulse"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full opacity-20 animate-pulse"></div>
</div>

    <!-- Learning Components Section -->
<div class="bg-gradient-to-r from-purple-100 to-blue-100 py-16 mt-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12 text-purple-800">Komponen Belajar</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($komponenBelajar as $item)
                <div key="{{ $item['id'] }}" class="flex flex-col items-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-white p-4 rounded-full shadow-lg mb-4">
                        <img 
                            src="{{ asset($item['imgSrc']) }}" 
                            alt="{{ $item['imgAlt'] }}" 
                            class="w-24 h-24 object-cover rounded-full" 
                        />
                    </div>
                    <h3 class="text-lg font-medium text-center text-purple-700">{{ $item['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</div>

<h2 class="text-4xl font-bold text-center mb-12 text-purple-800 mt-16">Ulasan Siswa</h2>
@if($ulasan->isNotEmpty())
    <div class="bg-gradient-to-r from-purple-100 to-blue-100 py-16 mt-16">
        <div class="container mx-auto px-4">
            <div class="slider"> <!-- Use the slider class here -->
                @foreach($ulasan as $review)
                    <div class="flex flex-col items-center transform hover:scale-105 transition-all duration-300 rounded-lg shadow-lg bg-white p-6 m-4">
                        <div class="flex items-center justify-center bg-purple-200 p-4 rounded-full shadow-md mb-4">
                            <img 
                                src="{{ asset('/storage/foto_profile/' . $review->foto_profile) }}" 
                                alt="{{ $review->nama_pemberi_ulasan }}" 
                                class="w-24 h-24 object-cover rounded-full" 
                            />
                        </div>
                        <h3 class="text-lg font-semibold text-center text-purple-800 mb-1">{{ $review->nama_pemberi_ulasan }}</h3>
                        <h5 class="text-sm text-gray-500 mb-2 text-center">{{ $review->tipe_pemberi_ulasan }}</h5>
                        <div class="star-rating flex justify-center mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="star text-lg {{ $i <= $review->penilaian ? 'text-yellow-500' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                        <p class="text-gray-700 text-center comment-preview mb-4" id="comment-preview-{{ $review->id }}" style="transition: height 0.3s ease; overflow: hidden;">
                            {{ Str::limit($review->komentar, 100) }}...
                            <span class="hidden comment-full" id="comment-full-{{ $review->id }}">{{ $review->komentar }}</span>
                        </p>
                        <button class="text-blue-500 hover:underline mt-2 see-more" data-comment-id="{{ $review->id }}">
                            Lihat Selengkapnya
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@else
    <p class="text-center text-gray-500">Tidak ada ulasan yang tersedia.</p>
@endif
<!-- Contact Section -->
<div id="contact" class="bg-gradient-to-br from-purple-600 to-indigo-800 py-16 relative z-20 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-5xl font-bold text-center mb-12 text-white">Hubungi Kami</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="col-span-2 bg-white rounded-lg shadow-xl p-8 transform hover:scale-105 transition-all duration-300">
                <h2 class="text-3xl font-semibold mb-6 text-purple-700">Kirim Pesan</h2>
                @if(session('success'))
                    <p class="text-green-500 mt-4 text-center">{{ session('success') }}</p>
                @endif
                <form action="{{ route('send.message') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 transition-colors duration-300"
                            placeholder="Nama Anda"
                            required
                        />
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 transition-colors duration-300"
                            placeholder="Email Anda"
                            required
                        />
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 transition-colors duration-300"
                            placeholder="Pesan Anda"
                            required
                        ></textarea>
                    </div>
                    <div class="text-center">
                        <button
                            type="submit"
                            class="inline-flex items-center px-8 py-3 border border-transparent text-lg font-medium rounded-full text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-300"
                        >
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-white rounded-lg shadow-xl p-8 text-center transform hover:scale-105 transition-all duration-300">
                <h2 class="text-3xl font-semibold mb-6 text-purple-700">Hubungi Langsung</h2>
                <div class="space-y-4 mb-8">
                    <p class="flex items-center justify-center text-lg">
                        <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        +62 818936487
                    </p>
                    <p class="flex items-center justify-center text-lg">
                        <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        example@example.com
                    </p>
                    <p class="flex items-center justify-center text-lg">
                        <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Jl. RS. Fatmawati Raya No.3, RT.3/RW.5, Cilandak Bar., Kec. Cilandak, Kota Jakarta Selatan, DKI Jakarta 12430
                    </p>
                </div>
                <a
                    href="https://wa.me/62818936487?text={{ urlencode('Halo aku sudah melihat Penawaran yang ada dan aku sangat tertarik dengan New Primagama Fatmawati') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center px-8 py-3 text-lg font-medium rounded-full text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-300"
                >
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    WhatsApp Kami
                </a>
            </div>
        </div>
    </div>
</div>

    <div class="md:col-span-1 text-center relative top-2" ">
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
    
<!-- Include Slick CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

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

        // Handle the "See More" button click
        $('.see-more').click(function() {
            const commentId = $(this).data('comment-id');
            const preview = document.getElementById(`comment-preview-${commentId}`);
            const fullComment = document.getElementById(`comment-full-${commentId}`);

            // Check if fullComment is found
            if (!fullComment) {
                console.error(`Full comment with ID ${commentId} not found.`);
                return; // Exit if not found
            }

            if (fullComment.classList.contains('hidden')) {
                fullComment.classList.remove('hidden');
                preview.innerHTML = fullComment.innerHTML; // Show full comment
                this.textContent = 'Lihat Lebih Sedikit'; // Change button text
            } else {
                fullComment.classList.add('hidden');
                preview.innerHTML = preview.innerHTML.split('...')[0] + '...'; // Limit comment again and add ellipsis
                this.textContent = 'Lihat Selengkapnya'; // Reset button text
            }

            // Adjust height
            setTimeout(() => {
                const newHeight = preview.scrollHeight + 'px';
                preview.style.height = newHeight;
            }, 0);
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
    
        // Add this script to enable the hover effect on list items
        document.querySelectorAll('li').forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.classList.add('bg-purple-100');
                item.classList.add('rounded-lg');
                item.classList.add('p-2');
            });
            item.addEventListener('mouseleave', () => {
                item.classList.remove('bg-purple-100');
                item.classList.remove('rounded-lg');
                item.classList.remove('p-2');
            });
        });
        
        function showMore(id) {
    const moreInfo = document.getElementById(`more-${id}`);
    if (moreInfo.classList.contains('hidden')) {
        moreInfo.classList.remove('hidden');
        moreInfo.classList.add('animate-fade-in-down');
    } else {
        moreInfo.classList.add('hidden');
        moreInfo.classList.remove('animate-fade-in-down');
    }
}

// Add this to your CSS or in a style tag
document.head.insertAdjacentHTML('beforeend', `
<style>
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-down {
    animation: fadeInDown 0.3s ease-out;
}
</style>
`);


document.addEventListener('DOMContentLoaded', (event) => {
    // Add hover effect to learning component items
    const learningItems = document.querySelectorAll('.grid > div');
    learningItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.querySelector('img').classList.add('animate-bounce');
        });
        item.addEventListener('mouseleave', () => {
            item.querySelector('img').classList.remove('animate-bounce');
        });
    });

    // Add animation to form inputs
    const formInputs = document.querySelectorAll('input, textarea');
    formInputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.classList.add('animate-pulse');
        });
        input.addEventListener('blur', () => {
            input.classList.remove('animate-pulse');
        });
    });
});

    Aos.init();

    function openModal(message) {
        document.getElementById('modal-content').textContent = message;
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
    
    const swiper = new Swiper('.ulasan-carousel', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>
@endsection
