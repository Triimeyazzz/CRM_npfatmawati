@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Daftar Absensi</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="mb-4">
        <div class="flex space-x-4">
            <select name="kelas" class="border p-2">
                <option value="">Pilih Kelas</option>
                @foreach ($classes as $class)
                    <option value="{{ $class }}" {{ $selectedClass == $class ? 'selected' : '' }}>
                        {{ $class }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="tanggal" class="border p-2" value="{{ $selectedDate }}">
            <button type="submit" class="bg-blue-500 text-white p-2">Filter</button>
        </div>
    </form>

    <div class="overflow-x-auto">
        @foreach ($absensiGroupedByDate as $date => $absensi)
            <h2 class="font-bold text-lg mt-4">{{ $date }}</h2>
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Nama Siswa</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Keterangan</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensi as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->siswa->name }}</td>
                            <td class="border px-4 py-2">{{ $item->status }}</td>
                            <td class="border px-4 py-2">{{ $item->keterangan }}</td>
                            <td class="border px-4 py-2">
                                <form method="POST" action="{{ route('absensi.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</div>
@endsection
