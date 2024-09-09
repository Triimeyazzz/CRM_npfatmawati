@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-8">Buat Pembayaran Baru</h1>

        <form action="{{ route('pembayaran.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto space-y-6">
            @csrf
            <div class="mb-6">
                <label for="siswa_id" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <select name="siswa_id" id="siswa_id" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400 transition duration-150 ease-in-out" required>
                    <option value="">Pilih Siswa</option>
                    @foreach ($siswa as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Tagihan</label>
                <input type="number" name="jumlah" id="jumlah" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400 transition duration-150 ease-in-out" required>
            </div>

            <div class="mb-6">
                <label for="tgl_jatuh_tempo" class="block text-sm font-medium text-gray-700">Tanggal Jatuh Tempo</label>
                <input type="date" name="tgl_jatuh_tempo" id="tgl_jatuh_tempo" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400 transition duration-150 ease-in-out" required>
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-md shadow-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500">
                Simpan
            </button>
        </form>
    </div>
@endsection
