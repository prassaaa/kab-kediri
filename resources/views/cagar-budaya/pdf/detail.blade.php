<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Detail Cagar Budaya - {{ $cagarBudaya->objek_cagar_budaya }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        h1 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
            font-size: 11px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            background-color: #f2f2f2;
            padding: 5px;
            margin-bottom: 10px;
            font-size: 13px;
        }
        .label {
            font-weight: bold;
            width: 30%;
            display: inline-block;
            vertical-align: top;
        }
        .value {
            width: 69%;
            display: inline-block;
        }
        .row {
            margin-bottom: 10px;
        }
        .image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 20px auto;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .page-break {
            page-break-after: always;
        }
        .badge {
            display: inline-block;
            padding: 2px 5px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 3px;
        }
        .badge-primary {
            background-color: #e6f2ff;
            color: #0066cc;
        }
        .badge-secondary {
            background-color: #f2f2f2;
            color: #666666;
        }
        .badge-success {
            background-color: #e6ffe6;
            color: #006600;
        }
        .badge-warning {
            background-color: #fff2e6;
            color: #cc6600;
        }
        .badge-danger {
            background-color: #ffe6e6;
            color: #cc0000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DETAIL CAGAR BUDAYA</h1>
        <h2>{{ $cagarBudaya->objek_cagar_budaya }}</h2>
    </div>
    
    <div class="date">
        Tanggal Cetak: {{ $tanggal }}
    </div>
    
    <div class="section">
        <div class="section-title">INFORMASI UMUM</div>
        <div class="row">
            <span class="label">Objek Cagar Budaya:</span>
            <span class="value">{{ $cagarBudaya->objek_cagar_budaya }}</span>
        </div>
        <div class="row">
            <span class="label">Predikat:</span>
            <span class="value">
                <span class="badge {{ $cagarBudaya->predikat == 'Cagar Budaya' ? 'badge-success' : 'badge-warning' }}">
                    {{ $cagarBudaya->predikat }}
                </span>
            </span>
        </div>
        <div class="row">
            <span class="label">Kategori:</span>
            <span class="value">
                <span class="badge badge-primary">{{ $cagarBudaya->kategori }}</span>
            </span>
        </div>
        <div class="row">
            <span class="label">Bahan:</span>
            <span class="value">{{ $cagarBudaya->bahan ?: 'Tidak ada data' }}</span>
        </div>
        <div class="row">
            <span class="label">Status:</span>
            <span class="value">
                <span class="badge {{ $cagarBudaya->is_verified ? 'badge-success' : 'badge-warning' }}">
                    {{ $cagarBudaya->is_verified ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                </span>
            </span>
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">LOKASI</div>
        <div class="row">
            <span class="label">Jalan/Dukuhan:</span>
            <span class="value">{{ $cagarBudaya->lokasi_jalan_dukuhan ?: 'Tidak ada data' }}</span>
        </div>
        <div class="row">
            <span class="label">Dusun:</span>
            <span class="value">{{ $cagarBudaya->lokasi_dusun ?: 'Tidak ada data' }}</span>
        </div>
        <div class="row">
            <span class="label">Desa:</span>
            <span class="value">{{ $cagarBudaya->lokasi_desa }}</span>
        </div>
        <div class="row">
            <span class="label">Kecamatan:</span>
            <span class="value">{{ $cagarBudaya->lokasi_kecamatan }}</span>
        </div>
        @if ($cagarBudaya->longitude && $cagarBudaya->latitude)
        <div class="row">
            <span class="label">Koordinat:</span>
            <span class="value">{{ $cagarBudaya->latitude }}, {{ $cagarBudaya->longitude }}</span>
        </div>
        @endif
    </div>
    
    <div class="section">
        <div class="section-title">NOMOR REGISTRASI</div>
        <div class="row">
            <span class="label">No. Reg BPK Lama:</span>
            <span class="value">{{ $cagarBudaya->no_reg_bpk_lama ?: 'Tidak ada data' }}</span>
        </div>
        <div class="row">
            <span class="label">No. Reg BPK Baru:</span>
            <span class="value">{{ $cagarBudaya->no_reg_bpk_baru ?: 'Tidak ada data' }}</span>
        </div>
        <div class="row">
            <span class="label">No. Reg Disparbud:</span>
            <span class="value">
                @if ($cagarBudaya->no_reg_disparbud_nomor_urut || $cagarBudaya->no_reg_disparbud_kode_kecamatan || $cagarBudaya->no_reg_disparbud_kode_kabupaten || $cagarBudaya->no_reg_disparbud_tahun)
                    {{ $cagarBudaya->no_reg_disparbud_nomor_urut }}/{{ $cagarBudaya->no_reg_disparbud_kode_kecamatan }}/{{ $cagarBudaya->no_reg_disparbud_kode_kabupaten }}/{{ $cagarBudaya->no_reg_disparbud_tahun }}
                @else
                    Tidak ada data
                @endif
            </span>
        </div>
    </div>
    
    <div class="page-break"></div>
    
    @if ($cagarBudaya->gambar)
    <div class="section">
        <div class="section-title">GAMBAR</div>
        <img class="image" src="{{ public_path('storage/' . $cagarBudaya->gambar) }}" alt="{{ $cagarBudaya->objek_cagar_budaya }}">
    </div>
    @endif
    
    <div class="section">
        <div class="section-title">DESKRIPSI</div>
        <p>{{ $cagarBudaya->deskripsi_singkat }}</p>
    </div>
    
    @if ($cagarBudaya->kondisi_saat_ini)
    <div class="section">
        <div class="section-title">KONDISI SAAT INI</div>
        <p>{{ $cagarBudaya->kondisi_saat_ini }}</p>
    </div>
    @endif
    
    @if($cagarBudaya->is_verified)
    <div class="section">
        <div class="section-title">INFORMASI VERIFIKASI</div>
        <table>
            <tr>
                <th>Diverifikasi Oleh</th>
                <th>Tanggal Verifikasi</th>
            </tr>
            <tr>
                <td>{{ $cagarBudaya->verifier ? $cagarBudaya->verifier->name : 'Tidak ada data' }}</td>
                <td>{{ $cagarBudaya->verified_at ? \Carbon\Carbon::parse($cagarBudaya->verified_at)->format('d-m-Y H:i') : 'Tidak ada data' }}</td>
            </tr>
        </table>
    </div>
    @endif
    
    <div class="section">
        <div class="section-title">INFORMASI TAMBAHAN</div>
        <table>
            <tr>
                <th>Dibuat Oleh</th>
                <th>Tanggal Pembuatan</th>
                <th>Tanggal Update Terakhir</th>
            </tr>
            <tr>
                <td>{{ $cagarBudaya->creator ? $cagarBudaya->creator->name : 'Tidak ada data' }}</td>
                <td>{{ $cagarBudaya->created_at ? \Carbon\Carbon::parse($cagarBudaya->created_at)->format('d-m-Y H:i') : 'Tidak ada data' }}</td>
                <td>{{ $cagarBudaya->updated_at ? \Carbon\Carbon::parse($cagarBudaya->updated_at)->format('d-m-Y H:i') : 'Tidak ada data' }}</td>
            </tr>
        </table>
    </div>
    
    <div class="footer">
        <p>Dokumen ini dicetak dari Sistem Informasi Cagar Budaya pada {{ $tanggal }}</p>
        <p>© {{ date('Y') }} Sistem Informasi Cagar Budaya</p>
    </div>
</body>
</html>