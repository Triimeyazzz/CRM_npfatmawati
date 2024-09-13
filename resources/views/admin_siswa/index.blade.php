@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Siswa</h1>
        <a
            href="{{ route('adminsiswa.create') }}"
            class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded transition duration-300"
            aria-label="Tambah Siswa"
        >
            Tambah Siswa
        </a>
    </div>

    <!-- Form Filter -->
    <form action="{{ route('adminsiswa.index') }}" method="GET" class="mb-6 flex flex-col md:flex-row gap-2">
        <div class="flex-grow">
            <input type="text" name="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 transition duration-300 ease-in-out transform hover:scale-105"
                placeholder="Cari nama siswa..." value="{{ request('search') }}">
        </div>

        <div class="flex-grow">
            <select name="kelas" class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2">
                <option value="">Pilih Kelas</option>
                @foreach (['Kelas 4 SD', 'Kelas 5 SD', 'Kelas 6 SD', 'Kelas 7 SMP', 'Kelas 8 SMP', 'Kelas 9 SMP', 'Kelas 10 SMA', 'Kelas 11 SMA', 'Kelas 12 SMA', 'Alumni SMA'] as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
            Cari
        </button>
    </form>

    <!-- Tabel Daftar Siswa -->
    <div class="overflow-x-auto">
        @if($siswa->isEmpty())
            <div class="text-center text-red-500 font-bold py-4">
                Data tidak ditemukan
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200 bg-white border border-gray-200 shadow-md rounded-lg">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Foto</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">QR Code</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Kelas</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($siswa as $item)
                    <tr class="{{ $loop->index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 transition duration-150">
                        <td class="px-4 py-4 whitespace-nowrap">
                            <img
                                src="{{ asset('storage/fotos/' . $item->foto) }}"
                                alt="{{ $item->nama }}"
                                class="w-16 h-16 object-cover rounded-full border-2 border-gray-200"
                            />
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <img src="{{ route('adminsiswa.qrcode', $item->id) }}" alt="QR Code" class="w-24 h-24 object-cover">
                            <a href="{{ route('adminsiswa.qrcode.download', $item->id) }}" class="text-blue-600 hover:text-blue-800 block mt-1">
                                Download QR Code
                            </a>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $item->kelas }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $item->email }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <a href="{{ route('adminsiswa.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" aria-label="Detail {{ $item->nama }}">Detail</a>
                            <a href="{{ route('adminsiswa.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded" aria-label="Edit {{ $item->nama }}">Edit</a>
                            <form action="{{ route('adminsiswa.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" aria-label="Hapus {{ $item->nama }}">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
