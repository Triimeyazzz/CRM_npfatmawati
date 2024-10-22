@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4 md:mb-0">Daftar Siswa</h1>
        <div class="flex space-x-4">
            <a href="{{ route('adminsiswa.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                Tambah Siswa
            </a>
            <a href="{{ route('siswa.export.pdf') }}"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                Export PDF
            </a>
            <a href="{{ route('siswa.export.excel') }}" 
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
            Export Excel</a>

        </div>
    </div>

    <!-- Form Filter -->
    <form action="{{ route('adminsiswa.index') }}" method="GET" class="mb-8 sticky top-0 bg-white p-4 shadow-md">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-grow">
            <input type="text" name="search"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-3 transition duration-300 ease-in-out"
                placeholder="Cari nama siswa..." value="{{ request('search') }}">
        </div>
        <div class="flex-grow">
            <select name="kelas"
                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-3">
                <option value="">Pilih Kelas</option>
                @foreach (['Kelas 4 SD', 'Kelas 5 SD', 'Kelas 6 SD', 'Kelas 7 SMP', 'Kelas 8 SMP', 'Kelas 9 SMP', 'Kelas 10 SMA', 'Kelas 11 SMA', 'Kelas 12 SMA', 'Alumni SMA'] as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
            Cari
        </button>
    </div>
</form>


    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <p class="text-gray-700 text-lg">
            Total Siswa: <span class="font-bold text-purple-600">{{ $total_siswa }}</span>
        </p>
    </div>

    <!-- Bulk Download Button -->
    <form action="{{ route('adminsiswa.qrcode.bulkDownload') }}" method="POST" class="mb-8">
        @csrf
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
            Download QR Terpilih
        </button>

        <div class="overflow-x-auto bg-white rounded-lg shadow-lg mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="select-all"
                                class="form-checkbox h-5 w-5 text-purple-600 rounded focus:ring-purple-500">
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Foto
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            QR Code
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelas
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($siswa as $item)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_ids[]" value="{{ $item->id }}"
                                class="form-checkbox h-5 w-5 text-purple-600 rounded focus:ring-purple-500">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ asset('/storage/photos/' . $item->foto) }}" alt="{{ $item->nama }}"
                                class="w-16 h-16 object-cover rounded-full border-2 border-gray-200">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ route('adminsiswa.qrcode', $item->id) }}" alt="QR Code" class="w-24 h-24 object-cover">
                            <a href="{{ route('adminsiswa.qrcode.download', $item->id) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Download QR Code
                            </a>
                        </td>
                            </form>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->kelas }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('adminsiswa.show', $item->id) }}"
                                class="text-blue-600 hover:text-blue-900 mr-2">Detail</a>
                            <a href="{{ route('adminsiswa.edit', $item->id) }}"
                                class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                            <form action="{{ route('adminsiswa.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-red-500 font-bold">
                            Data tidak ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</div>

<script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endsection