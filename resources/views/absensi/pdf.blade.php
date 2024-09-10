<!DOCTYPE html>
<html>
<head>
    <title>Absensi Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Absensi Report</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $item)
                <tr>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->siswa->kelas }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
