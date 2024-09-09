@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tambah Ulasan</h1>

    <form action="{{ route('ulasan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nama_pemberi_ulasan" class="block text-sm font-medium text-gray-700">Nama Pemberi Ulasan</label>
            <input type="text" name="nama_pemberi_ulasan" id="nama_pemberi_ulasan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('nama_pemberi_ulasan')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tipe_pemberi_ulasan" class="block text-sm font-medium text-gray-700">Tipe Pemberi Ulasan</label>
            <select name="tipe_pemberi_ulasan" id="tipe_pemberi_ulasan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="alumni">Alumni</option>
                <option value="orang_tua">Orang Tua</option>
                <option value="lainnya">Lainnya</option>
                <option value="siswa">Siswa</option>
            </select>
            @error('tipe_pemberi_ulasan')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="foto_profile" class="block text-sm font-medium text-gray-700">Foto Profil (optional)</label>
            <input type="file" name="foto_profile" id="foto_profile" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('foto_profile')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Penilaian</label>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" name="penilaian" id="star{{ $i }}" value="{{ $i }}" class="hidden" required>
                    <label for="star{{ $i }}" class="cursor-pointer text-2xl text-gray-400 hover:text-yellow-500 transition-colors duration-200">
                        <i class="fas fa-star"></i>
                    </label>
                @endfor
            </div>
            @error('penilaian')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="komentar" class="block text-sm font-medium text-gray-700">Komentar</label>
            <textarea name="komentar" id="komentar" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            @error('komentar')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan Ulasan</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    // Handle star click events
    const stars = document.querySelectorAll('label');
    const radioButtons = document.querySelectorAll('input[name="penilaian"]');

    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            // Set the radio button to checked
            const radioButton = radioButtons[index];
            radioButton.checked = true;

            // Change star colors
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.remove('text-gray-400');
                    s.classList.add('text-yellow-500');
                } else {
                    s.classList.remove('text-yellow-500');
                    s.classList.add('text-gray-400');
                }
            });
        });
    });
</script>
@endsection
