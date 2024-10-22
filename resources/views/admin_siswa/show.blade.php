@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6 text-center">Profil Siswa</h1>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 text-center">
                <img
                    src="{{ asset('storage/fotos/' . $siswa->foto) }}"
                    alt="{{ $siswa->nama }}"
                    class="w-24 h-24 object-cover rounded-full border-4 border-purple-600 mb-4"
                />
                <img src="{{ route('adminsiswa.qrcode', $siswa->id) }}" alt="QR Code" class="w-32 h-32 mb-4 mx-auto">

                <h2 class="text-2xl font-semibold">{{ $siswa->nama }}</h2>
                <p class="text-gray-500 text-sm">ID: {{ $siswa->id }}</p>

                <!-- Personal Information Section -->
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2 border-b pb-2 text-purple-600">Data Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ([
                            'email', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 
                            'alamat', 'no_telpon', 'kota', 'no_wa', 'instagram', 
                            'kelas', 'mulai_bimbingan', 'jam_bimbingan', 'hari_bimbingan', 'nama_ptn_tujuan', 'jurusan_tujuan'] as $field)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <span class="font-medium text-purple-600">{{ ucwords(str_replace('_', ' ', $field)) }}:</span>
                                <span class="text-gray-800">{{ $siswa[$field] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Parent Information Section -->
                <div class="mt-6 border-t border-gray-200 pt-4">
                    <h3 class="text-xl font-semibold mb-2 border-b pb-2 text-purple-600">Data Orang Tua</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ([
                            'nama_ayah', 'pekerjaan_ayah', 'no_telp_hp_ayah', 
                            'no_wa_id_line_ayah', 'email_ayah', 
                            'nama_ibu', 'pekerjaan_ibu', 'no_telp_hp_ibu', 
                            'no_wa_id_line_ibu', 'email_ibu'] as $field)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <span class="font-medium text-purple-600">{{ ucwords(str_replace('_', ' ', $field)) }}:</span>
                                <span class="text-gray-800">{{ $siswa[$field] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- School Information Section -->
                <div class="mt-6 border-t border-gray-200 pt-4">
                    <h3 class="text-xl font-semibold mb-2 border-b pb-2 text-purple-600">Data Sekolah</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ([
                            'nama_sekolah', 'alamat_sekolah', 'kurikulum'] as $field)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <span class="font-medium text-purple-600">{{ ucwords(str_replace('_', ' ', $field)) }}:</span>
                                <span class="text-gray-800">{{ $siswa[$field] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 text-right">
                <a href="{{ route('adminsiswa.edit', $siswa->id) }}" class="text-blue-600 hover:underline font-semibold">Edit Profil</a>
            </div>
        </div>  
    </div>
@endsection
