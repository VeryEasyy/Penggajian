<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - {{ $gaji->karyawan->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f4f4f4;
        }
        .invoice-footer {
            text-align: right;
            margin-top: 20px;
        }
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            text-align: right;
        }
        .signature-section div {
            margin-left: 20px;
        }
        .signature-section p {
            padding-top: 10px;
            margin: 0;
        }
        #nama{
            padding-right: 40px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Slip Gaji</h1>
            <p>{{ \Carbon\Carbon::parse($gaji->tanggal_penggajian)->format('d F Y') }}</p>
        </div>
        <div class="invoice-details">
            <table>
                <tr>
                    <th>Nama Karyawan</th>
                    <td>{{ $gaji->karyawan->nama }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $gaji->karyawan->jabatan->nama_jabatan }}</td>
                </tr>
                <tr>
                    <th>Tanggal Penggajian</th>
                    <td>{{ \Carbon\Carbon::parse($gaji->tanggal_penggajian)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Gaji Pokok</th>
                    <td>Rp {{ number_format($gaji->karyawan->jabatan->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Tunjangan</th>
                    <td>+ Rp {{ number_format($gaji->total_tunjangan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Potongan</th>
                    <td>- Rp {{ number_format($gaji->total_potongan, 0, ',', '.') }} -</td>
                </tr>
                <tr>
                    <th>Total Gaji</th>
                    <td>Rp {{ number_format($gaji->gaji_bersih, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        <div class="invoice-footer">
            <p>Terima kasih atas kerja keras dan dedikasi Anda.</p>
        </div>
        <div class="signature-section">
            <div>
                <p>Jakarta, {{ \Carbon\Carbon::parse($gaji->tanggal_penggajian)->format('d F Y') }}</p>
                <p>Yang Menandatangani,</p>
                <p>_________________________</p>
                <p id="nama">Nama Atasan</p>
            </div>
        </div>
    </div>
</body>
</html>
