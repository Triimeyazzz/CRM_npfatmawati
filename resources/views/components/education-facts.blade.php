<div class="relative min-h-screen bg-gradient-to-br from-yellow-50 to-purple-50 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row items-center gap-4 mb-12">
            <div class="bg-white rounded-xl border-4 border-purple-800 p-6 md:p-8 bayangan">
                <h1 class="text-purple-800 text-3xl md:text-4xl font-bold">
                    Fun Facts
                    <span class="block text-xl text-blue-800 md:text-2xl">about Education in Indonesia</span>
                </h1>
            </div>
            <p class="text-purple-800 text-lg-6 md:text-2xl font-semibold">
                Temukan informasi menarik tentang lanskap pendidikan di Indonesia
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
            <!-- Left Column - Large Did You Know Card -->
            <div class="bg-yellow-400 rounded-3xl p-8 shadow-lg h-fit max-w-lg mx-auto">
                <div class="flex flex-col gap-6">
                    <div class="w-full text-center">
                        <h2 class="text-purple-900 text-3xl font-bold mb-4">Did you know?</h2>
                        <p class="text-purple-900 text-lg">
                            Indonesia memiliki lebih dari 170.000 sekolah dasar, menjadikannya salah satu sistem sekolah terbesar di dunia!
                        </p>
                    </div>
                    <div class="w-2/3">
                        <img src="{{ asset('images/guru.png') }}" alt="Student" class="w-full h-auto rounded-2xl object-cover">
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Other Facts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    [
                        'title' => 'Language Facts',
                        'content' => 'Bahasa Indonesia adalah bahasa pengantar utama, tetapi ada lebih dari 700 bahasa asli di negara ini!'
                    ],
                    [
                        'title' => 'Compulsory Education Program',
                        'content' => 'Pemerintah Indonesia menetapkan program Wajib Belajar 12 Tahun, yang mencakup pendidikan dasar (SD dan SMP) dan pendidikan menengah (SMA atau SMK).'
                    ],
                    [
                        'title' => 'Various Curriculum',
                        'content' => 'Indonesia sering memperbarui kurikulum pendidikan, seperti Kurikulum 2013 yang bertujuan meningkatkan kompetensi siswa dalam hal pengetahuan, keterampilan, dan karakter.'
                    ],
                    [
                        'title' => 'Literacy Rate',
                        'content' => 'Angka melek huruf di Indonesia telah meningkat drastis, mencapai lebih dari 95% di kalangan remaja berusia 15-24 tahun!'
                    ],
                    [
                        'title' => 'University Growth',
                        'content' => 'Jumlah universitas di Indonesia meningkat lebih dari dua kali lipat sejak tahun 1990an!'
                    ],
                    [
                        'title' => 'Educational Diversity',
                        'content' => 'Sistem pendidikan di Indonesia mencakup sekolah negeri, swasta, dan Islam, yang menawarkan beragam pengalaman pendidikan!'
                    ]
                ] as $fact)
                    <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-yellow-400 rounded-lg px-4 py-2 inline-block mb-4">
                            <h3 class="text-purple-900 font-bold border-t-5 border-purple-300">{{ $fact['title'] }}</h3>
                        </div>
                        <p class="text-gray-700">{{ $fact['content'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-purple-200 rounded-full opacity-30"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-yellow-200 rounded-full opacity-30"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-purple-200 rounded-full opacity-30"></div>
</div>

@push('styles')
<style>
    .hover\:shadow-xl:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .bayangan{
        box-shadow: 6px 6px 0px 0px #FFE700;
    }
</style>
@endpush
