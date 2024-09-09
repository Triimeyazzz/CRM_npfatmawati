@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h2 class="text-3xl font-bold text-center mb-6">Edit Siswa</h2>
                <form action="{{ route('adminsiswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- Token CSRF untuk keamanan --}}
                    @method('PUT') {{-- Method spoofing for PUT request --}}
                    
                    {{-- Informasi Pribadi --}}
                    <div class="bg-purple-50 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold mb-4">Informasi Pribadi</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $siswa->nama) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $siswa->email) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" id="password" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <div>
                                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $siswa->alamat) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                <input type="text" name="kota" id="kota" value="{{ old('kota', $siswa->kota) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                                <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $siswa->instagram) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="no_telpon" class="block text-sm font-medium text-gray-700 mb-1">No Telpon</label>
                                <input type="text" name="no_telpon" id="no_telpon" value="{{ old('no_telpon', $siswa->no_telpon) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-1">No WA</label>
                                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', $siswa->no_wa) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                                <input type="file" name="foto" id="foto" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @if ($siswa->foto)
                                    <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" class="mt-2 w-32 h-32 object-cover rounded-md">
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Sekolah --}}
                    <div class="bg-purple-50 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold mb-4">Informasi Sekolah</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nama_sekolah" class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah', $siswa->nama_sekolah) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700 mb-1">Alamat Sekolah</label>
                                <input type="text" name="alamat_sekolah" id="alamat_sekolah" value="{{ old('alamat_sekolah', $siswa->alamat_sekolah) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="kurikulum" class="block text-sm font-medium text-gray-700 mb-1">Kurikulum</label>
                                <input type="text" name="kurikulum" id="kurikulum" value="{{ old('kurikulum', $siswa->kurikulum) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Orang Tua --}}
                    <div class="bg-purple-50 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold mb-4">Informasi Orang Tua</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="no_telpon_ayah" class="block text-sm font-medium text-gray-700 mb-1">No Telpon Ayah</label>
                                <input type="text" name="no_telpon_ayah" id="no_telpon_ayah" value="{{ old('no_telpon_ayah', $siswa->no_telpon_ayah) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="no_telpon_ibu" class="block text-sm font-medium text-gray-700 mb-1">No Telpon Ibu</label>
                                <input type="text" name="no_telpon_ibu" id="no_telpon_ibu" value="{{ old('no_telpon_ibu', $siswa->no_telpon_ibu) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Bimbingan --}}
                    <div class="bg-purple-50 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold mb-4">Informasi Bimbingan</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $siswa->kelas) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="mulai_bimbingan" class="block text-sm font-medium text-gray-700 mb-1">Mulai Bimbingan</label>
                                <input type="date" name="mulai_bimbingan" id="mulai_bimbingan" value="{{ old('mulai_bimbingan', $siswa->mulai_bimbingan) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="jam_bimbingan" class="block text-sm font-medium text-gray-700 mb-1">Jam Bimbingan</label>
                                <input type="time" name="jam_bimbingan" id="jam_bimbingan" value="{{ old('jam_bimbingan', $siswa->jam_bimbingan) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                @if ($errors->has('jam_bimbingan'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('jam_bimbingan') }}</span>
                                @endif
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="hari_bimbingan[]" value="{{ $day }}" class="form-checkbox" 
                                            {{ is_array(old('hari_bimbingan', $siswa->hari_bimbingan)) && in_array($day, old('hari_bimbingan', $siswa->hari_bimbingan)) ? 'checked' : '' }}>
                                        <span class="ml-2">{{ $day }}</span>
                                    </label>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Update Siswa</button>
                    </div>
                </form>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            </div>
        </div>
    </div>
@endsection