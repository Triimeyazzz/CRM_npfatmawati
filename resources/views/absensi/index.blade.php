@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6 sticky top-0 bg-white z-10 p-4 shadow-md">
        <h1 class="text-3xl font-bold text-purple-800">Daftar Absensi</h1>
        <div class="flex space-x-4">
            <a href="{{ route('absensi.scan') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700 transition">
                Scan Absen
            </a>
            <a href="{{ route('absensi.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700 transition">
                Buat Absen
            </a>
            <a href="{{ route('absensi.export.excel') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg shadow hover:bg-orange-700 transition">
                Ekspor ke Excel
            </a>
            <a href="{{ route('absensi.export.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                Ekspor ke PDF
            </a>
        </div>
    </div>

    <div class="bg-yellow-100 shadow-md rounded-lg p-6 mb-6">
        <form action="{{ route('absensi.index') }}" method="GET" class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 mb-4 ">
            <input type="text" name="search" placeholder="Cari Nama Siswa..." value="{{ request('search') }}" class="border p-2 rounded-md w-full">
            <select name="kelas" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 w-full">
                <option value="">Pilih Kelas</option>
                @foreach($classes as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                @endforeach
            </select>
            <select name="bulan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 w-full">
                <option value="">Pilih Bulan</option>
                @foreach(range(1, 12) as $month)
                    <option value="{{ sprintf('%02d', $month) }}" {{ request('bulan') == sprintf('%02d', $month) ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                    </option>
                @endforeach
            </select>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border p-2 rounded-md w-full">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition w-full md:w-auto">
                Filter
            </button>
        </form>
    </div>

    @if(count($absensiGroupedByDate) == 0)
        <p class="text-center text-gray-500">Tidak ada data untuk filter yang dipilih.</p>
    @else
        @foreach($absensiGroupedByDate as $date => $absensis)
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Tanggal: {{ $date }}</h2>
                <table class="min-w-full divide-y divide-gray-200 bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($absensis as $absensi)
                            <tr>
                                <td class="border px-4 py-2 cursor-pointer text-purple-600 hover:text-purple-900" onclick="showStudentAbsences({{ $absensi->siswa_id }})">
                                    {{ $absensi->siswa->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $absensi->siswa->kelas }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 ">{{ $absensi->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $absensi->keterangan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button onclick="confirmDelete({{ $absensi->id }})" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <div class="flex justify-end mt-4">
            <button onclick="deleteAbsensi()" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                Hapus
            </button>
            <button onclick="closeModal('deleteModal')" class="ml-4 bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700 transition">
                Batal
            </button>
        </div>
    </div>
</div>

<!-- Student Absences Modal -->
<div id="studentAbsencesModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full">
        <h3 class="text-lg font-semibold mb-4">Absensi Siswa</h3>
        <table class="min-w-full divide-y divide-gray-200 bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                </tr>
            </thead>
            <tbody id="studentAbsencesContent" class="bg-white divide-y divide-gray-200">
                <!-- Content will be populated here -->
            </tbody>
        </table>
        <button onclick="closeModal('studentAbsencesModal')" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700 transition">
            Tutup
        </button>
    </div>
</div>


@endsection


@push('scripts')
<script>
    let deletingId = null;

    function confirmDelete(id) {
        deletingId = id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function deleteAbsensi() {
        if (deletingId) {
            fetch(`/absensi/${deletingId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Gagal menghapus absensi.');
                    console.error('Delete failed:', response.statusText);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus absensi.');
            });
        }
        closeModal('deleteModal');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function showStudentAbsences(studentId) {
        const absensiData = @json($absensiData);
        const studentAbsences = absensiData.filter(absensi => absensi.siswa_id === studentId);

        const content = studentAbsences.map(absensi => `
            <tr class="${absensi.status === 'Hadir' ? 'bg-green-100' : 'bg-red-100'}">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${absensi.siswa.nama}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${absensi.tanggal}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ${absensi.status === 'Hadir' ? 'text-green-600' : 'text-red-600'}">${absensi.status}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${absensi.keterangan}</td>
            </tr>
        `).join('');

        document.getElementById('studentAbsencesContent').innerHTML = content;
        document.getElementById('studentAbsencesModal').classList.remove('hidden');
    }

    function exportToExcel() {
        // Implement Excel export logic here
       fetch(`/absensi/export/excel`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
        }) 
    }

    function exportToPDF() {
        // Implement PDF export logic here
        fetch(`/absensi/export/pdf`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
        })
    }

    // Remove references to 'interact' if it's not being used
    // If you need to use 'interact', make sure to include the library
    // interact('.draggable').draggable({
    //     // interact options here
    // });
</script>