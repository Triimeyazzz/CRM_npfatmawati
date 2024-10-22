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
                    <div class="flex items-start mb-4">
                        @if ($item->foto_profile)
                            <img src="{{ asset('/storage/foto_profile/' . $item->foto_profile) }}" alt="{{ $item->nama_pemberi_ulasan }} Profile" class="w-12 h-12 rounded-full mr-3">
                        @else
                            <img src="{{ asset('path/to/default/image.png') }}" alt="Default Profile" class="w-12 h-12 rounded-full mr-3">
                        @endif
                        <div>
                            <h2 class="text-lg font-semibold">{{ $item->nama_pemberi_ulasan ?? 'Nama Tidak Tersedia' }}</h2>
                            <span class="text-gray-500">{{ ucfirst($item->tipe_pemberi_ulasan) }}</span>
                        </div>
                    </div>

                    <div class="flex items-center mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $item->penilaian ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                        @endfor
                        <span class="ml-2 text-gray-600">({{ $item->penilaian }})</span>
                    </div>

                    <p class="text-gray-700 mb-4">{{ $item->komentar }}</p>

                    <button onclick="openModal('{{ route('ulasan.destroy', $item) }}')" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600">Hapus</button>
                </div>
            @endforeach
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg p-5 max-w-sm w-full">
                <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
                <p>Apakah Anda yakin ingin menghapus ulasan ini?</p>
                <div class="flex justify-end mt-4">
                    <button onclick="closeModal()" class="text-gray-500 mr-2">Batal</button>
                    <button id="confirmDeleteButton" class="bg-red-500 text-white py-1 px-3 rounded">Hapus</button>
                </div>
            </div>
        </div>

        <div id="modalBackdrop" class="fixed inset-0 bg-black opacity-50 hidden"></div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        let deleteUrl;

        function openModal(url) {
            deleteUrl = url;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('modalBackdrop').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('modalBackdrop').classList.add('hidden');
        }

        document.getElementById('confirmDeleteButton').onclick = function() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}'; // Laravel CSRF token
            form.appendChild(csrfInput);
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        };
    </script>
@endsection
