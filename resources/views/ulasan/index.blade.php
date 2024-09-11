@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Ulasan</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('ulasan.create') }}"
            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Tambah Ulasan</a>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($ulasan as $item)
                <div class="bg-white shadow-md rounded-lg p-4">
                    @if ($item->pemberi_ulasan)
                        <img src="{{ asset('storage/fotos/' . $item->siswa->foto) }}" alt="{{ $item->siswa->name }} Profile"
                            class="w-12 h-12 rounded-full mb-4">
                        <h2 class="text-lg font-semibold">{{ $item->nama_pemberi_ulasan ?? $item->siswa->name }}
                        </h2>
                    @else
                        <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile"
                            class="w-12 h-12 rounded-full mb-4">
                        <h2 class="text-lg font-semibold">Nama Tidak Tersedia</h2>
                    @endif
                    <div class="flex items-center mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $item->penilaian ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                        @endfor
                        <span class="ml-2 text-gray-600">({{ $item->penilaian }})</span>
                    </div>
                    <p class="text-gray-700 mb-4">{{ $item->komentar }}</p>
                    <form action="{{ route('ulasan.destroy', $item) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus ulasan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
