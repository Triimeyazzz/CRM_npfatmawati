@extends('layouts.siswalayout')

@section('title', 'Attendance')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Catatan Kehadiran</h1>

        <form method="GET" action="{{ route('siswa.attendance') }}" class="mb-4">
            <label for="month-filter" class="block text-gray-700 font-semibold mb-2">Tampilkan Berdasarkan Bulan:</label>
            <input 
                type="month" 
                id="month-filter" 
                name="month" 
                value="{{ request('month', $selectedMonth) }}" 
                class="border border-gray-300 p-2 rounded"
            />
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Filter</button>
        </form>

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="border border-gray-300 p-3">Tanggal</th>
                        <th class="border border-gray-300 p-3">Status</th>
                        <th class="border border-gray-300 p-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @if($absensiInfo->count() > 0)
                        @foreach($absensiInfo as $index => $record)
                            <tr class="hover:bg-gray-100 transition {{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="border border-gray-300 p-3">
                                    {{ \Carbon\Carbon::parse($record['tanggal'])->format('d M Y') }}
                                </td>
                                <td class="border border-gray-300 p-3 font-semibold {{ $record['status'] === 'Hadir' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $record['status'] }}
                                </td>
                                <td class="border border-gray-300 p-3">{{ $record['keterangan'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colSpan="3" class="text-center p-4 text-gray-500">Tidak ada Absensi pada Bulan yang dipilih.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
