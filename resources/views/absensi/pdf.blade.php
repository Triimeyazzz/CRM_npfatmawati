<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6; /* Light Gray */
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #6A1B9A; /* Dark Purple */
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            margin: 0;
        }
        .table-container {
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 90%; /* Responsive width */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background-color: #E1BEE7; /* Light Purple */
        }
        th, td {
            padding: 15px;
            text-align: left;
            font-size: 1rem;
        }
        th {
            color: #6A1B9A; /* Dark Purple */
            text-transform: uppercase;
            font-weight: bold;
        }
        td {
            border-bottom: 1px solid #e0e0e0; /* Light Gray */
        }
        td:last-child {
            border: none; /* Remove border for the last cell */
        }
        .status {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            display: inline-block;
        }
        .status-hadir {
            background-color: #4CAF50; /* Green */
        }
        .status-izin {
            background-color: #FFC107; /* Yellow */
        }
        .status-tidak-hadir {
            background-color: #F44336; /* Red */
        }
        footer {
            text-align: center;
            padding: 20px 0;
            font-size: 0.9rem;
            color: #757575; /* Gray */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <img src="./images/Logo Color.png" alt="*" style="height: 60px;">
        <h1>Laporan Absensi</h1>
    </header>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $item)
                    <tr>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->siswa->nama }}</td>
                        <td>{{ $item->siswa->kelas }}</td>
                        <td>
                            @if ($item->status == 'Hadir')
                                <span class="status status-hadir">Hadir</span>
                            @elseif ($item->status == 'Izin')
                                <span class="status status-izin">Izin</span>
                            @else
                                <span class="status status-tidak-hadir">Tidak Hadir</span>
                            @endif
                        </td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <footer>
        <p>&copy; {{ date('Y') }} New Primagama Fatmawati. Semua hak dilindungi.</p>
    </footer>
</body>
</html>
