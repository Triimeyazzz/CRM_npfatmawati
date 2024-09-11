@extends('layouts.siswalayout')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Selamat Datang, {{ $siswaInfo['nama'] }}</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
<!-- Profile Card -->
<div class="bg-white rounded-lg shadow-lg p-6 lg:col-span-1 transition-transform transform hover:scale-105 hover:shadow-xl border-l-4 border-t-4 border-b-4 border-purple-500">
    <h2 class="text-2xl font-semibold mb-6 text-purple-600 text-center border-b-2 border-purple-300 pb-2">Profile</h2>
    <div class="space-y-4">
        <div class="flex flex-col items-center mb-6 bg-cover bg-center p-6" style="background-image: url('{{ asset('images/abc.png') }}');">
            <img src="{{ asset('storage/fotos/' . $siswaInfo['foto']) }}" alt="{{ $siswaInfo['nama'] }}"
                class="w-32 h-32 rounded-full mb-4 border-4 border-purple-500 shadow-lg">
            <p class="font-bold text-xl text-white">{{ $siswaInfo['nama'] }}</p>
            <p class="text-sm text-white italic">{{ $siswaInfo['kelas'] }}</p>
            <!-- QR Code Section -->
        </div>
        <div class="mt-4 flex justify-center">
            <div class="relative">
                <!-- QR Code Image -->
                <img src="{{ route('adminsiswa.qrcode', $siswaInfo['id']) }}" 
                     alt="QR Code" 
                     class="w-24 h-24 border-2 border-purple-500 rounded shadow-md cursor-pointer" 
                     id="qr-code" 
                     onclick="openModal()">
        
                <p class="text-sm text-center text-gray-600 mt-1">QR Code untuk Absen</p>
            </div>
        </div>
        
        <!-- Modal for Enlarged QR Code -->
        <div id="qr-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" onclick="closeModal()">
            <div class="bg-white p-4 rounded shadow-lg" onclick="event.stopPropagation();">
                <img src="{{ route('adminsiswa.qrcode', $siswaInfo['id']) }}" alt="QR Code" class="w-64 h-64 border-2 border-purple-500 rounded shadow-md">
            </div>
        </div>
        
        <div class="space-y-3">
            @foreach ([
                'email', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_telpon', 
                'kota', 'no_wa', 'instagram', 'nama_sekolah', 'alamat_sekolah', 'kurikulum', 
                'nama_ayah', 'pekerjaan_ayah', 'no_telp_hp_ayah', 'no_wa_id_line_ayah', 
                'email_ayah', 'nama_ibu', 'pekerjaan_ibu', 'no_telp_hp_ibu', 'no_wa_id_line_ibu', 
                'kelas', 'email_ibu', 'mulai_bimbingan', 'jam_bimbingan', 'hari_bimbingan'] as $field)
                <div class="flex justify-between text-sm text-gray-700">
                    <span class="font-medium text-purple-600">{{ ucwords(str_replace('_', ' ', $field)) }}:</span>
                    <span class="text-gray-800">{{ $siswaInfo[$field] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Payment Information Card -->
                    <div class="bg-white rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 border-t-4 border-r-4 border-purple-500">
                        <h2 class="text-2xl font-semibold mb-4 text-purple-600">Payment Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm font-medium">Total Tagihan</p>
                                <p class="text-lg text-gray-800">Rp {{ number_format($pembayaranInfo['totalTagihan'], 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Total Yang Sudah Dibayarkan</p>
                                <p class="text-lg text-gray-800">Rp {{ number_format($pembayaranInfo['totalBayar'], 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium">Sisa Tagihan</p>
                                <p class="text-lg text-gray-800">Rp {{ number_format($pembayaranInfo['sisaTagihan'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="bg-green-500 h-full"
                                    style="width: {{ $pembayaranInfo['totalTagihan'] > 0 ? ($pembayaranInfo['totalBayar'] / $pembayaranInfo['totalTagihan']) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Table -->
                    <div class="bg-white rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 border-r-4 border-purple-500">
                        <h2 class="text-2xl font-semibold mb-4 text-purple-600">Absensi Terbaru</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($absensiInfo as $absensi)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $absensi['tanggal'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 rounded-full text-xs 
                                                @if ($absensi['status'] == 'Hadir') bg-green-200 text-green-800
                                                @elseif($absensi['status'] == 'Izin') bg-yellow-200 text-yellow-800
                                                @else bg-red-200 text-red-800 @endif">
                                                    {{ $absensi['status'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('siswa.attendance') }}" class="block mt-4 text-blue-500 hover:text-blue-700">Lihat Lebih Lengkap</a>
                        </div>
                    </div>

                    <!-- Try-Out Results -->
                    <div class="bg-white rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 border-b-4 border-r-4 border-purple-500">
                        <h2 class="text-2xl font-semibold mb-4 text-purple-600">Statistik Try-Out</h2>
                        <div id="tryOutChart" class="mb-6" style="height: 300px;"></div>
                        <div class="space-y-4">
                            @foreach ($tryOutInfo as $tryOut)
                                <div class="border-t pt-4">
                                    <h3 class="font-semibold text-lg mb-2 text-gray-800">{{ $tryOut['mata_pelajaran'] }} -
                                        {{ $tryOut['tanggal_pelaksanaan']->format('d M Y') }}</h3>
                                    <p class="mb-2">Average Score: <span class="font-medium text-purple-600">{{ number_format($tryOut['average_score'], 2) }}</span></p>
                                    <h4 class="font-medium text-sm mb-1">Subtopics:</h4>
                                    <ul class="list-disc list-inside pl-4 space-y-1">
                                        @foreach ($tryOut['subtopics'] as $index => $subtopic)
                                            @if ($index < 3) <!-- Show only the first 3 subtopics -->
                                                <li class="text-sm text-gray-700">
                                                    {{ $subtopic['sub_mata_pelajaran'] }}: <span class="font-medium">{{ $subtopic['skor'] }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    @if (count($tryOut['subtopics']) > 3) <!-- Check if there are more than 3 subtopics -->
                                        <a href="javascript:void(0);" class="text-purple-600 hover:underline" onclick="openSubtopicsModal('{{ json_encode($tryOut['subtopics']) }}')">View More</a>
                                    @endif
                                </div>
                            @endforeach
                            <!-- Subtopics Modal -->
<div id="subtopics-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" onclick="closeSubtopicsModal()">
    <div class="bg-white p-4 rounded shadow-lg" onclick="event.stopPropagation();">
        <h3 class="font-semibold text-lg mb-2 text-gray-800">Subtopics</h3>
        <ul id="subtopics-list" class="list-disc list-inside pl-4 space-y-1"></ul>
        <button onclick="closeSubtopicsModal()" class="mt-4 px-4 py-2 bg-gray-300 rounded">Close</button>
    </div>
</div>

                            <!-- Subtopics Modal End -->
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Try-Out Chart
            var tryOutData = @json($tryOutInfo);
            var series = tryOutData.map(function(tryOut) {
                return {
                    name: tryOut.mata_pelajaran,
                    data: [{
                        x: tryOut.tanggal_pelaksanaan,
                        y: tryOut.average_score,
                        subtopics: tryOut.subtopics
                    }]
                };
            });

            var tryOutOptions = {
                chart: {
                    type: 'bar',
                    height: 300,
                    zoom: {
                        type: 'xy'
                    }
                },
                series: series,
                xaxis: {
                    type: 'datetime',
                },
                yaxis: {
                    title: {
                        text: 'Skor Rata-Rata'
                    }
                },
                tooltip: {
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        var data = w.config.series[seriesIndex].data[dataPointIndex];
                        var content = '<div class="p-2">';
                        content += '<strong>' + w.config.series[seriesIndex].name + '</strong><br>';
                        content += 'Date: ' + new Date(data.x).toLocaleDateString() + '<br>';
                        content += 'Average Score: ' + data.y.toFixed(2) + '<br>';
                        content += '<strong>Subtopics:</strong><br>';
                        data.subtopics.forEach(function(subtopic) {
                            content += subtopic.sub_mata_pelajaran + ': ' + subtopic.skor + '<br>';
                        });
                        content += '</div>';
                        return content;
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#tryOutChart"), tryOutOptions);
            chart.render();
        });

        function openSubtopicsModal(subtopics) {
        // Parse the subtopics JSON string into an object
        const subtopicsData = JSON.parse(subtopics);
        const subtopicsList = document.getElementById('subtopics-list');
        
        // Clear any existing subtopics in the list
        subtopicsList.innerHTML = '';

        // Add each subtopic to the list in the modal
        subtopicsData.forEach(function(subtopic) {
            const li = document.createElement('li');
            li.classList.add('text-sm', 'text-gray-700');
            li.textContent = `${subtopic.sub_mata_pelajaran}: ${subtopic.skor}`;
            subtopicsList.appendChild(li);
        });

        // Show the modal
        document.getElementById('subtopics-modal').classList.remove('hidden');
    }

    function closeSubtopicsModal() {
        document.getElementById('subtopics-modal').classList.add('hidden');
    }

        function openModal() {
        document.getElementById('qr-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('qr-modal').classList.add('hidden');
    }
    </script>
@endpush
