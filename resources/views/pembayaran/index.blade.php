@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-bold mb-8 text-center text-purple-700">Daftar Pembayaran</h1>

    {{-- Form Pencarian --}}
    <div class="mb-6">
        <form action="{{ route('pembayaran.index') }}" method="GET" class="flex justify-end">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama siswa..." class="border rounded-l-lg px-4 py-2 w-1/3 shadow-sm focus:ring focus:ring-purple-300" />
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-r-lg px-4 py-2 shadow">Cari</button>
        </form>
    </div>

    <div class="flex justify-end mb-6 gap-4">
        <a href="{{ route('pembayaran.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg shadow">Buat Pembayaran Baru</a>
        <a href="{{ route('kirimEmail') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg shadow">Kirim Notifikasi</a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h4 class="text-xl font-semibold mb-4">Ringkasan Keuangan</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                <p class="text-gray-600"><strong>Total Pemasukan:</strong></p>
                <p class="text-2xl font-bold text-green-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                <p class="text-gray-600"><strong>Total Tagihan:</strong></p>
                <p class="text-2xl font-bold text-red-700">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-md">
                <p class="text-gray-600"><strong>Sisa Tagihan:</strong></p>
                <p class="text-2xl font-bold text-yellow-700">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="mt-4">
            <h4 class="text-lg font-semibold mb-2">Pemasukan per Bulan</h4>
            <button id="toggleChartBtn" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg mb-4">Sembunyikan Chart</button>
            <div id="chartContainer">
                <canvas id="pemasukanChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    {{-- Tabel Daftar Pembayaran --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full bg-white divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Tagihan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($pembayaran as $key => $item)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img
                                src="{{ optional($item->siswa)->foto ? asset('storage/fotos/' . $item->siswa->foto) : 'https://via.placeholder.com/100' }}"
                                alt="Foto Siswa" class="w-12 h-12 rounded-full object-cover">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($item->siswa)->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'default' => 'bg-red-100 text-red-800',
                                ];
                                $statusClass = $statusClasses[$item->status] ?? $statusClasses['default'];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('pembayaran.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            <form action="{{ route('pembayaran.cancel', $item->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-900">Batalkan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart.js setup
    const ctx = document.getElementById('pemasukanChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Pemasukan per Bulan',
                data: @json($data),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Toggle chart visibility
    let chartVisible = true;
    $('#toggleChartBtn').on('click', function() {
        chartVisible = !chartVisible;
        $('#chartContainer').toggle(chartVisible);
        $(this).text(chartVisible ? 'Sembunyikan Chart' : 'Tampilkan Chart');
    });
</script>
@endsection 
