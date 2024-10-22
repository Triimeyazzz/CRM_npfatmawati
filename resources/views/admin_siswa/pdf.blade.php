<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <style>
        :root {
            --primary-color: #6a0dad;
            --secondary-color: #ffd700;
            --text-color: #333;
            --background-color: #f8f8ff;
            --table-hover-color: #e6e6fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            font-size: 32px;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: var(--primary-color);
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
        }

        th {
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: #f0e6ff;
        }

        tr:hover {
            background-color: var(--table-hover-color);
        }

        td {
            color: var(--text-color);
            border-bottom: 1px solid #e0e0e0;
        }

        .footer {
            text-align: center;
            color: var(--primary-color);
            margin-top: 30px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Additional modern touches */
        .container::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 5px;
            background-color: var(--secondary-color);
            border-radius: 2.5px;
        }

        th::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background-color: var(--secondary-color);
            margin-top: 5px;
        }

        /* Media print rules for PDF landscape */
        @media print {
            body {
                width: 100%;
            }

            .container {
                max-width: none;
                width: 100%;
            }

            @page {
                size: A4 landscape;
                margin: 20mm;
            }

            table {
                page-break-inside: auto;
                width: 100%;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            th, td {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Siswa</h1>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->jenis_kelamin }}</td>
                    <td>{{ $s->kelas }}</td>
                    <td>{{ $s->alamat }}</td>
                    <td>{{ $s->no_telpon }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            &copy; 2024 Data Siswa - All Rights Reserved.
        </div>
    </div>

</body>
</html>
