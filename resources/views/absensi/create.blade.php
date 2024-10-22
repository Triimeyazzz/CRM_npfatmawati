@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Tambah Absensi Siswa</h1>

    <!-- Form Pencarian -->
    <form action="{{ route('absensi.create') }}" method="GET" class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas" id="kelas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class }}" {{ $class === $selectedClass ? 'selected' : '' }}>{{ $class }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" name="nama" id="nama" value="{{ request('nama') }}" placeholder="Cari nama siswa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cari
                </button>
            </div>
        </div>
    </form>

    <!-- Form Absensi -->
    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <div class="space-y-6" id="absensiContainer">
            @foreach($siswa as $index => $s)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Data Absensi untuk {{ $s->nama }}
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <input type="hidden" name="absensi[{{ $index }}][siswa_id]" value="{{ $s->id }}">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <input type="date" name="absensi[{{ $index }}][tanggal]" required class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" value="{{ date('Y-m-d') }}">
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <select name="absensi[{{ $index }}][status]"  class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Pilih Status</option>
                                    <option value="hadir">Hadir</option>
                                    <option value="tidak hadir">Tidak Hadir</option>
                                </select>
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <textarea name="absensi[{{ $index }}][keterangan]" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan keterangan (opsional)"></textarea>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Simpan Absensi
            </button>
        </div>
    </form>
</div>
@endsection