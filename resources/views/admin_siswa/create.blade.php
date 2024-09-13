@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h2 class="text-3xl font-bold text-center mb-6">Tambah Siswa</h2>
                <form action="{{ route('adminsiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- Token CSRF untuk keamanan --}}
                {{-- Informasi Pribadi --}}
                <div class="bg-purple-50 p-6 rounded-lg mb-8">
                    <h3 class="text-xl font-semibold mb-4">Informasi Pribadi</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="nama" id="nama" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" id="password" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                            <input type="text" name="kota" id="kota" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                            <input type="text" name="instagram" id="instagram" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="no_telpon" class="block text-sm font-medium text-gray-700 mb-1">No Telpon</label>
                            <input type="text" name="no_telpon" id="no_telpon" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-1">No WA</label>
                            <input type="text" name="no_wa" id="no_wa" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                            <select name="kelas" id="kelas" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Pilih Kelas</option>
                                <option value="Kelas 4 SD">Kelas 4 SD</option>
                    <option value="Kelas 5 SD">Kelas 5 SD</option>
                    <option value="Kelas 6 SD">Kelas 6 SD</option>
                    <option value="Kelas 7 SMP">Kelas 7 SMP</option>
                    <option value="Kelas 8 SMP">Kelas 8 SMP</option>
                    <option value="Kelas 9 SMP">Kelas 9 SMP</option>
                    <option value="Kelas 10 SMA">Kelas 10 SMA</option>
                    <option value="Kelas 11 SMA">Kelas 11 SMA</option>
                    <option value="Kelas 12 SMA">Kelas 12 SMA</option>
                    <option value="Alumni SMA">Alumni SMA</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Informasi Sekolah --}}
                <div class="bg-yellow-50 p-6 rounded-lg mb-8">
                    <h3 class="text-xl font-semibold mb-4">Informasi Sekolah</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="nama_sekolah" class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" id="nama_sekolah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700 mb-1">Alamat Sekolah</label>
                            <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label for="kurikulum" class="block text-sm font-medium text-gray-700 mb-1">Kurikulum</label>
                            <input type="text" name="kurikulum" id="kurikulum" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                    </div>
                </div>
 {{-- Informasi Orang Tua --}}
 <div class="bg-blue-50 p-6 rounded-lg mb-8">
    <h3 class="text-xl font-semibold mb-4">Informasi Orang Tua</h3>
    <div class="grid grid-cols-2 gap-4">
        {{-- Ayah Fields --}}
        <div>
            <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
            <input type="text" name="nama_ayah" id="nama_ayah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah</label>
            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_telp_hp_ayah" class="block text-sm font-medium text-gray-700 mb-1">No Telpon/HP Ayah</label>
            <input type="text" name="no_telp_hp_ayah" id="no_telp_hp_ayah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_wa_id_line_ayah" class="block text-sm font-medium text-gray-700 mb-1">No WA/ID Line Ayah</label>
            <input type="text" name="no_wa_id_line_ayah" id="no_wa_id_line_ayah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="email_ayah" class="block text-sm font-medium text-gray-700 mb-1">Email Ayah</label>
            <input type="email" name="email_ayah" id="email_ayah" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        {{-- Ibu Fields --}}
        <div>
            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
            <input type="text" name="nama_ibu" id="nama_ibu" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu</label>
            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_telp_hp_ibu" class="block text-sm font-medium text-gray-700 mb-1">No Telpon/HP Ibu</label>
            <input type="text" name="no_telp_hp_ibu" id="no_telp_hp_ibu" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="no_wa_id_line_ibu" class="block text-sm font-medium text-gray-700 mb-1">No WA/ID Line Ibu</label>
            <input type="text" name="no_wa_id_line_ibu" id="no_wa_id_line_ibu" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="email_ibu" class="block text-sm font-medium text-gray-700 mb-1">Email Ibu</label>
            <input type="email" name="email_ibu" id="email_ibu" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>
</div>

{{-- Mulai Bimbingan --}}
<div class="bg-green-50 p-6 rounded-lg mb-8">
    <h3 class="text-xl font-semibold mb-4">Mulai Bimbingan</h3>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="mulai_bimbingan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Bimbingan</label>
            <input type="date" name="mulai_bimbingan" id="mulai_bimbingan" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label for="jam_bimbingan" class="block text-sm font-medium text-gray-700 mb-1">Jam Bimbingan</label>
            <input type="time" name="jam_bimbingan" id="jam_bimbingan" 
                   class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                   required>
            <span class="text-red-500 text-sm mt-1 hidden" id="error-message">Format harus H:i (contoh: 14:30)</span>
        </div>        
    </div>
</div>
{{-- Upload Photo with Preview --}}
<div>
    <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto</label>
    <input type="file" name="foto" id="foto" class="w-full p-3 border border-indigo-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" accept="image/*" onchange="previewImage(event)">
    
    <!-- Preview Image -->
    <div class="mt-4">
        <img id="preview" src="#" alt="Preview Foto" class="w-32 h-32 object-cover rounded-md hidden">
    </div>
</div>
                {{-- Hari Bimbingan Checkboxes --}}
                <div class="mt-8">
                    <label for="hari_bimbingan" class="block text-sm font-medium text-gray-700 mb-1">Hari Bimbingan</label>
                    <div class="flex flex-col space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="hari_bimbingan[]" value="Senin">
                            <span class="ml-2">Senin</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="hari_bimbingan[]" value="Selasa">
                            <span class="ml-2">Selasa</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="hari_bimbingan[]" value="Rabu">
                            <span class="ml-2">Rabu</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="hari_bimbingan[]" value="Kamis">
                            <span class="ml-2">Kamis</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="hari_bimbingan[]" value="Jumat">
                            <span class="ml-2">Jumat</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="hari_bimbingan[]" value="Sabtu">
                            <span class="ml-2">Sabtu</span>
                        </label>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-6">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg">Submit</button>
                </div>
                </form>
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
