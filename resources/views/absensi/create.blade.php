<!-- resources/views/absensi/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-extrabold text-purple-700 mb-6">Buat Absen</h1>

    <form action="{{ route('absensi.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-lg mb-6">
        @csrf

        <div class="mb-4">
            <label for="tanggal" class="block text-gray-700">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
        </div>

        <div class="mb-4">
            <label for="kelas" class="block text-gray-700">Pilih Kelas:</label>
            <select name="kelas" id="kelas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                <option value="">Pilih Kelas</option>
                @foreach($classes as $kelas)
                    <option value="{{ $kelas }}">{{ $kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="search" class="block text-gray-700">Cari Siswa:</label>
            <input type="text" name="search" id="search" value="{{ old('search') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
        </div>

        <div class="mb-4">
            <label for="hari_bimbingan" class="block text-gray-700">Pilih Hari Bimbingan:</label>
            <select name="hari_bimbingan[]" id="hari_bimbingan" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 h-32">
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Siswa:</h2>
        @foreach($siswa as $s)
            <div class="bg-gray-100 border border-gray-200 rounded-xl shadow-lg p-4 mb-4">
                <div class="flex justify-between mb-2">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $s->nama }}</h3>
                        <p class="text-sm text-gray-600">{{ $s->kelas }}</p>
                    </div>
                    <button type="button" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 add-attendance" data-id="{{ $s->id }}">Tambah</button>
                </div>
                <div class="attendance-details hidden mt-2">
                    <select name="absensi[{{ $s->id }}][status]" class="border border-gray-300 rounded-lg px-4 py-2">
                        <option value="Hadir">Hadir</option>
                        <option value="Tidak Hadir">Tidak Hadir</option>
                    </select>
                    <input type="text" name="absensi[{{ $s->id }}][keterangan]" placeholder="Keterangan" class="border border-gray-300 rounded-lg px-4 py-2" />
                    <input type="hidden" name="absensi[{{ $s->id }}][siswa_id]" value="{{ $s->id }}" />
                </div>
            </div>
        @endforeach

        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg w-full hover:bg-green-700 transition duration-300 ease-in-out">Simpan</button>
    </form>
</div>

<script>
    document.querySelectorAll('.add-attendance').forEach(button => {
        button.addEventListener('click', function() {
            const attendanceDetails = this.closest('.bg-gray-100').querySelector('.attendance-details');
            attendanceDetails.classList.toggle('hidden');
        });
    });
</script>
@endsection
