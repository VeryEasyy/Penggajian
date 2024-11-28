<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Slip Gaji</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Karyawan</th>
                <th>Tanggal Penggajian</th>
                <th>Total Tunjangan</th>
                <th>Total Potongan</th>
                <th>Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @if ($gaji instanceof \Illuminate\Support\Collection)
                @foreach ($gaji as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->karyawan->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_penggajian)->format('d M Y') }}</td>
                        <td>{{ number_format($item->total_tunjangan, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->total_potongan, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->gaji_bersih, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Data gaji tidak ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
