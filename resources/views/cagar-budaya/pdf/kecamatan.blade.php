<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Data Cagar Budaya {{ $kecamatan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR CAGAR BUDAYA</h1>
        <h2>{{ $kecamatan }}</h2>
    </div>
    
    <div class="date">
        Tanggal: {{ $tanggal }}
    </div>
    
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Objek Cagar Budaya</th>
                <th width="15%">Predikat</th>
                <th width="10%">Kategori</th>
                <th width="25%">Lokasi</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cagarBudayas as $index => $cagarBudaya)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $cagarBudaya->objek_cagar_budaya }}</td>
                    <td>{{ $cagarBudaya->predikat }}</td>
                    <td>{{ $cagarBudaya->kategori }}</td>
                    <td>{{ $cagarBudaya->lokasi_desa }}, {{ $cagarBudaya->lokasi_kecamatan }}</td>
                    <td>{{ $cagarBudaya->is_verified ? 'Terverifikasi' : 'Belum Terverifikasi' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data cagar budaya.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        Sistem Informasi Cagar Budaya - {{ $tanggal }}
    </div>
</body>
</html>