@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">TryOut Index</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($siswas as $siswa)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex items-center p-4">
                <!-- Student photo -->
                <img 
                src="{{ asset('storage/fotos/' . $siswa->foto) ?? 'https://via.placeholder.com/100' }}" 
                alt="{{ $siswa->nama }}" 
                class="h-16 w-16 rounded-full object-cover mr-4">
                
                <div>
                    <h2 class="text-lg font-semibold">{{ $siswa->nama }}</h2>
                    <p class="text-gray-500">ID: {{ $siswa->id }}</p>
                </div>
            </div>

            <div class="p-4 border-t border-gray-200">
                <a href="{{ route('tryout.progress', $siswa->id) }}" class="text-blue-600 hover:underline">View Progress</a>
                <a href="{{ route('tryout.create', $siswa->id) }}" class="text-green-600 hover:underline ml-4">Create TryOut</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
