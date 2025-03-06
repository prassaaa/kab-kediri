<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Data Cagar Budaya {{ $kecamatan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .official-header {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header-logo {
            width: 120px;
            margin-right: 80px;
            display: flex;
            align-items: center;
        }
        .header-logo img {
            max-width: 100%;
            max-height: 120px;
        }
        .header-text {
            text-align: center;
        }
        .header-text h1 {
            margin: 0;
            font-size: 20px;
            color: #000;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .header-text h2 {
            margin: 5px 0 10px;
            font-size: 16px;
            color: #333;
            line-height: 1.2;
        }
        .header-text p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #666;
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
    <div class="official-header">
        <table style="width: 100%; border-collapse: collapse; border: none;">
            <tr>
                <td style="width: 20%; text-align: center; vertical-align: middle; border: none;">
                    <img src="{{ public_path('assets/img/kediri1.png') }}" alt="Logo" style="max-width: 120px; max-height: 120px;">
                </td>
                <td style="width: 80%; text-align: center; border: none;">
                    <h1 style="margin: 0; font-size: 20px; text-transform: uppercase;">Dinas Pariwisata dan Kebudayaan</h1>
                    <h2 style="margin: 5px 0; font-size: 16px;">Kabupaten Kediri</h2>
                    <p style="margin: 5px 0; font-size: 12px;">Alamat: Jalan Veteran No. 2, Kota Kediri, Jawa Timur</p>
                    <p style="margin: 5px 0; font-size: 12px;">Telepon: (0354) 123456 | Email: dinasparbudkediri@example.com</p>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="date">
        Tanggal Cetak: {{ $tanggal }}
    </div>
    
    <div class="section">
        <div class="section-title">DAFTAR CAGAR BUDAYA - {{ $kecamatan }}</div>
    </div>
    
    <!-- Untuk setiap cagar budaya, cetak detail lengkap -->
    @foreach($cagarBudayas as $index => $cagarBudaya)
        <div class="section">
            <div class="section-title">INFORMASI UMUM (#{{ $index + 1 }})</div>
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
        
        <!-- Hanya tambahkan page break jika bukan item terakhir -->
        @if($index < count($cagarBudayas) - 1)
            <div class="page-break"></div>
            
            <!-- Ulangi header pada setiap halaman baru -->
            <div class="official-header">
                <table style="width: 100%; border-collapse: collapse; border: none;">
                    <tr>
                        <td style="width: 20%; text-align: center; vertical-align: middle; border: none;">
                            <img src="{{ public_path('assets/img/kediri1.png') }}" alt="Logo" style="max-width: 120px; max-height: 120px;">
                        </td>
                        <td style="width: 80%; text-align: center; border: none;">
                            <h1 style="margin: 0; font-size: 20px; text-transform: uppercase;">Dinas Pariwisata dan Kebudayaan</h1>
                            <h2 style="margin: 5px 0; font-size: 16px;">Kabupaten Kediri</h2>
                            <p style="margin: 5px 0; font-size: 12px;">Alamat: Jalan Veteran No. 2, Kota Kediri, Jawa Timur</p>
                            <p style="margin: 5px 0; font-size: 12px;">Telepon: (0354) 123456 | Email: dinasparbudkediri@example.com</p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="date">
                Tanggal Cetak: {{ $tanggal }}
            </div>
        @endif
    @endforeach
    
    <div class="footer">
        <p>Dokumen ini dicetak dari Sistem Informasi Cagar Budaya pada {{ $tanggal }}</p>
        <p>© {{ date('Y') }} Dinas Pariwisata dan Kebudayaan Kabupaten Kediri Bidang Jakala</p>
    </div>
</body>
</html>