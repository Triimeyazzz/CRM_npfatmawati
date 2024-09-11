@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Siswa</h1>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <img src="{{ route('adminsiswa.qrcode', $siswa->id) }}" alt="QR Code" style="width: 100px; height: 100px;">

                <h2 class="text-lg font-semibold">{{ $siswa->nama }}</h2>
                <p class="text-gray-500">ID: {{ $siswa->id }}</p>
            </div>
            <div class="p-6 border-t border-gray-200">
                <a href="{{ route('adminsiswa.edit', $siswa->id) }}" class="text-blue-600 hover:underline">Edit</a>
            </div>
        </div>  
    </div>
@endSection