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
                            <label for="nama_ptn_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Ptn Tujuan</label>
                            <input type="text" name="nama_ptn_tujuan" id="nama_ptn_tujuan" value="{{ old('nama_ptn_tujuan', $siswa->nama_ptn_tujuan) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        
                <div>
                            <label for="jurusan_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan Tujuan</label>
                            <input type="text" name="jurusan_tujuan" id="jurusan_tujuan" value="{{ old('jurusan_tujuan', $siswa->jurusan_tujuan) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
            <input type="text" name="nama_ayah" value="{{old ('nama_ayah', $siswa->nama_ayah)}}" id="nama_ayah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah</label>
            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{old ('pekerjaan_ayah', $siswa->pekerjaan_ayah)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_telp_hp_ayah" class="block text-sm font-medium text-gray-700 mb-1">No Telpon/HP Ayah</label>
            <input type="text" name="no_telp_hp_ayah" id="no_telp_hp_ayah" value="{{old ('no_telp_ayah', $siswa->no_telp_ayah)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_wa_id_line_ayah" class="block text-sm font-medium text-gray-700 mb-1">No WA/ID Line Ayah</label>
            <input type="text" name="no_wa_id_line_ayah" id="no_wa_id_line_ayah" value="{{old ('no_wa_id_line_ayah', $siswa->no_wa_id_line_ayah)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="email_ayah" class="block text-sm font-medium text-gray-700 mb-1">Email Ayah</label>
            <input type="email" name="email_ayah" id="email_ayah" value="{{old ('email_ayah', $siswa->email_ayah)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

<div>
            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
            <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu</label>
            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_telp_hp_ibu" class="block text-sm font-medium text-gray-700 mb-1">No Telpon/HP Ibu</label>
            <input type="text" name="no_telp_hp_ibu" id="no_telp_hp_ibu" value="{{ old('no_telp_hp_ibu', $siswa->no_telp_hp_ibu)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_wa_id_line_ibu" class="block text-sm font-medium text-gray-700 mb-1">No WA/ID Line Ibu</label>
            <input type="text" name="no_wa_id_line_ibu" id="no_wa_id_line_ibu" value="{{ old('no_wa_id_line_ibu', $siswa->no_wa_id_line_ibu)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="email_ibu" class="block text-sm font-medium text-gray-700 mb-1">Email Ibu</label>
            <input type="email" name="email_ibu" id="email_ibu" value="{{ old('email_ibu', $siswa->email_ibu)}}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
                        </div>
                    </div>

                    {{-- Informasi Bimbingan --}}
                    <div class="bg-purple-50 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold mb-4">Informasi Bimbingan</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                <select name="kelas" id="kelas" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    <option value="">Pilih Kelas</option>
    <option value="Kelas 4 SD" {{ old('kelas', $siswa->kelas) == 'Kelas 4 SD' ? 'selected' : '' }}>Kelas 4 SD</option>
    <option value="Kelas 5 SD" {{ old('kelas', $siswa->kelas) == 'Kelas 5 SD' ? 'selected' : '' }}>Kelas 5 SD</option>
    <option value="Kelas 6 SD" {{ old('kelas', $siswa->kelas) == 'Kelas 6 SD' ? 'selected' : '' }}>Kelas 6 SD</option>
    <option value="Kelas 7 SMP" {{ old('kelas', $siswa->kelas) == 'Kelas 7 SMP' ? 'selected' : '' }}>Kelas 7 SMP</option>
    <option value="Kelas 8 SMP" {{ old('kelas', $siswa->kelas) == 'Kelas 8 SMP' ? 'selected' : '' }}>Kelas 8 SMP</option>
    <option value="Kelas 9 SMP" {{ old('kelas', $siswa->kelas) == 'Kelas 9 SMP' ? 'selected' : '' }}>Kelas 9 SMP</option>
    <option value="Kelas 10 SMA" {{ old('kelas', $siswa->kelas) == 'Kelas 10 SMA' ? 'selected' : '' }}>Kelas 10 SMA</option>
    <option value="Kelas 11 SMA" {{ old('kelas', $siswa->kelas) == 'Kelas 11 SMA' ? 'selected' : '' }}>Kelas 11 SMA</option>
    <option value="Kelas 12 SMA" {{ old('kelas', $siswa->kelas) == 'Kelas 12 SMA' ? 'selected' : '' }}>Kelas 12 SMA</option>
    <option value="Alumni SMA" {{ old('kelas', $siswa->kelas) == 'Alumni SMA' ? 'selected' : '' }}>Alumni SMA</option>
</select>

                            </div>

                            <div>
                                <label for="mulai_bimbingan" class="block text-sm font-medium text-gray-700 mb-1">Mulai Bimbingan</label>
                                <input type="date" name="mulai_bimbingan" id="mulai_bimbingan" value="{{ old('mulai_bimbingan', $siswa->mulai_bimbingan) }}" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="jam_bimbingan" class="block text-sm font-medium text-gray-700 mb-1">Jam Bimbingan</label>
                                <input type="time" name="jam_bimbingan" id="jam_bimbingan"  value="{{ old('jam_bimbingan', $siswa->jam_bimbingan) }}"
                                       class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                       
                                       required>
                                <span class="text-red-500 text-sm mt-1 hidden" id="error-message">Format harus H:i (contoh: 14:30)</span>
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
        <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        const jamBimbinganInput = document.getElementById('jam_bimbingan');
    const errorMessage = document.getElementById('error-message');

    jamBimbinganInput.addEventListener('input', function() {
        const value = jamBimbinganInput.value;
        // Regular expression to match the H:i format (24-hour)
        const timePattern = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;

        if (!timePattern.test(value)) {
            errorMessage.classList.remove('hidden');
        } else {
            errorMessage.classList.add('hidden');
        }
    });
    </script>
@endsection
