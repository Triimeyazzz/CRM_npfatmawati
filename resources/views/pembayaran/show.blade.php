@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-4">Detail Pembayaran</h1>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold">Nama Siswa: <span class="font-normal">{{ $pembayaran->siswa->nama }}</span></h3>
            <p class="text-gray-700">Jumlah Tagihan: <span class="font-bold text-green-600">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</span></p>
            <p class="text-gray-700">Total Cicilan Dibayar: <span class="font-bold text-blue-600">Rp {{ number_format($totalCicilan, 0, ',', '.') }}</span></p>
            <p class="text-gray-700">Sisa Cicilan: <span class="font-bold text-red-600">Rp {{ number_format($sisaCicilan, 0, ',', '.') }}</span></p>
            <p class="text-gray-700">Status: <span class="font-bold {{ $pembayaran->status == 'selesai' ? 'text-green-500' : ($pembayaran->status == 'pending' ? 'text-yellow-500' : 'text-red-500') }}">{{ ucfirst($pembayaran->status) }}</span></p>
        </div>

        <h4 class="text-2xl font-semibold mb-2">Cicilan:</h4>
        <div class="bg-white shadow-lg rounded-lg p-4">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">Jumlah</th>
                        <th class="py-2 px-4 text-left">Dibayar Pada</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran->cicilan as $cicilan)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ number_format($cicilan->jumlah, 0, ',', '.') }}</td>
                            <td class="py-2 px-4">{{ $cicilan->dibayar_pada }}</td>
                            <td class="py-2 px-4">
                                <form action="{{ route('pembayaran.cicilan.destroy', $cicilan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form action="{{ route('pembayaran.bayarCicilan', $pembayaran->id) }}" method="POST" class="mt-6 bg-white shadow-lg rounded-lg p-4">
            @csrf
            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Cicilan</label>
                <input type="number" name="jumlah" id="jumlah" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400 transition duration-150 ease-in-out" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md shadow-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Bayar Cicilan
            </button>
        </form>

        <a href="{{ route('pembayaran.index') }}" class="mt-3 inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-md transition duration-200 ease-in-out">Kembali</a>
    </div>
@endsection
