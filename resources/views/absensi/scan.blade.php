@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Scan QR Code</h1>

    <form method="POST" action="{{ route('absensi.scanQr') }}">
        @csrf
        <div class="mb-4">
            <label for="id" class="block mb-1">ID Siswa</label>
            <input type="text" name="id" class="border p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2">Absensi Hadir</button>
    </form>
</div>
@endsection
