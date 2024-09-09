@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Ulasan</h1>

    <form action="{{ route('ulasan.update', $ulasan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Penilaian</label>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" name="penilaian" id="edit_star{{ $i }}" value="{{ $i }}" class="hidden" {{ $ulasan->penilaian == $i ? 'checked' : '' }} required>
                    <label for="edit_star{{ $i }}" class="cursor-pointer text-2xl text-gray-400 hover:text-yellow-500">
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
            <textarea name="komentar" id="komentar" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $ulasan->komentar }}</textarea>
            @error('komentar')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Perbarui Ulasan</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    document.querySelectorAll('input[name="penilaian"]').forEach((input) => {
        input.addEventListener('change', function() {
            const value = this.value;
            const stars = document.querySelectorAll('label');
            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.remove('text-gray-400');
                    star.classList.add('text-yellow-500');
                } else {
                    star.classList.remove('text-yellow-500');
                    star.classList.add('text-gray-400');
                }
            });
        });
    });

    // Trigger change event for initially checked star
    document.querySelector(`input[name="penilaian"]:checked`).dispatchEvent(new Event('change'));
</script>
@endsection
