<!-- resources/views/pdf_template.blade.php -->
<!DOCTYPE html>
<html>
    <head></head>
<body>
    <table class="min-w-full divide-y divide-gray-200 bg-white border border-gray-300 rounded-lg shadow-md">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($absensis as $absensi)
                <tr>
                    <td class="border px-4 py-2 cursor-pointer text-purple-600 hover:text-purple-900" onclick="viewStudentAbsences({{ $absensi->siswa_id }})">
                        {{ $absensi->siswa->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $absensi->siswa->kelas }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $absensi->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $absensi->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
