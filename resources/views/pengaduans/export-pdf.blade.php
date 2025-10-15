<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pengaduan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f7c948;
            color: #000;
        }
    </style>
</head>

<body>
    <h2>Laporan Pengaduan Mesin</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Pelapor</th>
                <th>Mesin</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $i => $data)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>NP{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $data->nama_pelapor }}</td>
                    <td>{{ $data->nama_mesin }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->tanggal_laporan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
