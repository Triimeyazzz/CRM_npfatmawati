@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Daftar Siswa</h1>
            <a
                href="{{ route('adminsiswa.create') }}"
                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded"
            >
                Tambah Siswa
            </a>
        </div>
        
        <!-- Form Filter -->
        <form action="{{ route('adminsiswa.index') }}" method="GET" class="mb-4 flex gap-2">
            <div class="mb-4 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="relative w-full sm:w-auto">
                    <input type="text" name="search"             
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-3 pl-10 transition duration-300 ease-in-out transform hover:scale-105"
                        placeholder="Cari nama siswa..." value="{{ request('search') }}">
                </div>
                
                <!-- Filter Kelas -->
                <select name="kelas" class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2">
                    <option value="">Pilih Kelas</option>
                    <option value="Kelas 4 SD" {{ request('kelas') == 'Kelas 4 SD' ? 'selected' : '' }}>Kelas 4 SD</option>
                    <option value="Kelas 5 SD" {{ request('kelas') == 'Kelas 5 SD' ? 'selected' : '' }}>Kelas 5 SD</option>
                    <option value="Kelas 6 SD" {{ request('kelas') == 'Kelas 6 SD' ? 'selected' : '' }}>Kelas 6 SD</option>
                    <option value="Kelas 7 SMP" {{ request('kelas') == 'Kelas 7 SMP' ? 'selected' : '' }}>Kelas 7 SMP</option>
                    <option value="Kelas 8 SMP" {{ request('kelas') == 'Kelas 8 SMP' ? 'selected' : '' }}>Kelas 8 SMP</option>
                    <option value="Kelas 9 SMP" {{ request('kelas') == 'Kelas 9 SMP' ? 'selected' : '' }}>Kelas 9 SMP</option>
                    <option value="Kelas 10 SMA" {{ request('kelas') == 'Kelas 10 SMA' ? 'selected' : '' }}>Kelas 10 SMA</option>
                    <option value="Kelas 11 SMA" {{ request('kelas') == 'Kelas 11 SMA' ? 'selected' : '' }}>Kelas 11 SMA</option>
                    <option value="Kelas 12 SMA" {{ request('kelas') == 'Kelas 12 SMA' ? 'selected' : '' }}>Kelas 12 SMA</option>
                    <option value="Alumni SMA" {{ request('kelas') == 'Alumni SMA' ? 'selected' : '' }}>Alumni SMA</option>
                </select>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cari</button>
            </div>
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
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">QR Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider border-b border-gray-200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($siswa as $item)
                        <tr class="{{ $loop->index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img
                                    src="{{ asset('storage/fotos/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    class="w-16 h-16 object-cover rounded-full border-2 border-gray-200"
                                />
                            </td>                        
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <img src="{{ route('adminsiswa.qrcode', $item->id) }}" alt="QR Code" style="width: 100px; height: 100px;">
                                <a href="{{ route('adminsiswa.qrcode.download', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                                    Download QR Code
                                </a>
                            </td>
                                                        <td class="px-6 py-4">{{ $item->kelas }}</td>
                            <td class="px-6 py-4">{{ $item->email }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('adminsiswa.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Detail</a>
                                <a href="{{ route('adminsiswa.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                <form action="{{ route('adminsiswa.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Hapus</button>
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
