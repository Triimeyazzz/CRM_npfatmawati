@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Daftar Pembayaran</h1>

        {{-- Form Pencarian --}}
        <div class="mb-4">
            <form action="{{ route('pembayaran.index') }}" method="GET" class="flex justify-end">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama siswa..." class="border rounded-l-lg px-4 py-2 w-1/3" />
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-r-lg px-4 py-2">Cari</button>
            </form>
        </div>

        {{-- Tombol untuk membuat pembayaran baru --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('pembayaran.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">Buat Pembayaran Baru</a>
        </div>

        {{-- Tombol untuk kirim notifikasi --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('kirimEmail') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">Kirim Notifikasi</a>
        </div>

        {{-- Ringkasan Keuangan --}}
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h4 class="text-xl font-semibold mb-4">Ringkasan Keuangan</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <p class="text-gray-600"><strong>Total Pemasukan:</strong></p>
                    <p class="text-2xl font-bold text-green-500">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><strong>Total Tagihan:</strong></p>
                    <p class="text-2xl font-bold text-red-500">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><strong>Sisa Tagihan:</strong></p>
                    <p class="text-2xl font-bold text-yellow-500">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-gray-600"><strong>Pemasukan per Bulan:</strong></p>
                <ul class="list-disc list-inside text-gray-700">
                    @foreach ($pemasukanPerBulan as $bulan)
                        <li>{{ $bulan->bulan }}: Rp {{ number_format($bulan->total, 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Tabel Daftar Pembayaran --}}
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
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
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img
                                src="{{ asset('storage/fotos/' . $item->siswa->foto) ?? 'https://via.placeholder.com/100' }}"
                                alt="Foto Siswa" class="w-10 h-10 rounded-full object-cover">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->siswa->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status == 'selesai')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $item->status }}</span>
                                @elseif($item->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $item->status }}</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">{{ $item->status }}</span>
                                @endif
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
@endsection
