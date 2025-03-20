@extends('layouts.admin-dashboard')

@section('page-title', 'Detail Lembaga Kebudayaan')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('wbtb.lembaga.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            <div class="flex space-x-2">
                @if(Auth::user()->role != 'user' && (!$lembaga->is_verified || Auth::user()->role == 'superadmin'))
                    <a href="{{ route('wbtb.lembaga.edit', $lembaga) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                @endif
                
                @if(Auth::user()->role == 'superadmin' && !$lembaga->is_verified)
                    <form action="{{ route('wbtb.lembaga.verify', $lembaga) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Verifikasi
                        </button>
                    </form>
                @endif
                
                @if(Auth::user()->role == 'superadmin')
                    <form action="{{ route('wbtb.lembaga.destroy', $lembaga) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kolom 1: Logo dan Gambar -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Logo Lembaga</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($lembaga->logo)
                            <img src="{{ Storage::url($lembaga->logo) }}" alt="{{ $lembaga->nama_lembaga }}" class="max-w-full h-auto mx-auto" style="max-height: 200px;">
                        @else
                            <div class="h-40 flex items-center justify-center bg-gray-200 rounded-lg">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Foto Bangunan/Sekretariat</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($lembaga->foto_bangunan)
                            <img src="{{ Storage::url($lembaga->foto_bangunan) }}" alt="Bangunan {{ $lembaga->nama_lembaga }}" class="w-full h-auto rounded-lg">
                        @else
                            <div class="h-40 flex items-center justify-center bg-gray-200 rounded-lg">
                                <p class="text-gray-500 italic">Tidak ada foto bangunan</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                @if(is_array($lembaga->foto_kegiatan) && count($lembaga->foto_kegiatan) > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Foto Kegiatan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($lembaga->foto_kegiatan as $foto)
                                <div class="relative">
                                    <img src="{{ Storage::url($foto) }}" alt="Kegiatan {{ $lembaga->nama_lembaga }}" class="w-full h-32 object-cover rounded-lg">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Status Verifikasi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($lembaga->is_verified)
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-green-800 font-medium">Terverifikasi</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">
                                Diverifikasi oleh: {{ $lembaga->verifier->name ?? 'Unknown' }} <br>
                                Tanggal: {{ $lembaga->verified_at->format('d F Y, H:i') }}
                            </p>
                        @else
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span class="text-yellow-800 font-medium">Belum Diverifikasi</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                @if (Auth::user()->role != 'user')
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Informasi Administratif</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat oleh:</span>
                                <span>{{ $lembaga->creator ? $lembaga->creator->name : 'Unknown' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat pada:</span>
                                <span>{{ $lembaga->created_at->format('d F Y, H:i') }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Terakhir diupdate:</span>
                                <span>{{ $lembaga->updated_at->format('d F Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Kolom 2: Informasi Dasar & Kontak -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Informasi Dasar</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Nama Lembaga:</span>
                            <span class="text-lg">{{ $lembaga->nama_lembaga }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Kategori:</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ $lembaga->kategori_lembaga }}</span>
                        </div>
                        
                        @if($lembaga->nomor_registrasi)
                            <div class="mb-3">
                                <span class="font-semibold">Nomor Registrasi:</span>
                                <span>{{ $lembaga->nomor_registrasi }}</span>
                            </div>
                        @endif
                        
                        @if($lembaga->tanggal_berdiri)
                            <div class="mb-3">
                                <span class="font-semibold">Tanggal Berdiri:</span>
                                <span>{{ $lembaga->tanggal_berdiri->format('d F Y') }}</span>
                            </div>
                        @endif
                        
                        @if($lembaga->tingkat_lembaga)
                            <div class="mb-3">
                                <span class="font-semibold">Tingkat Lembaga:</span>
                                <span>{{ $lembaga->tingkat_lembaga }}</span>
                            </div>
                        @endif
                        
                        @if($lembaga->status_hukum)
                            <div class="mb-3">
                                <span class="font-semibold">Status Hukum:</span>
                                <span>{{ $lembaga->status_hukum }}</span>
                            </div>
                        @endif
                        
                        @if($lembaga->visi_misi)
                            <div class="mb-3">
                                <span class="font-semibold">Visi dan Misi:</span>
                                <p class="whitespace-pre-line mt-1 text-sm">{{ $lembaga->visi_misi }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Kontak dan Alamat</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Alamat:</span>
                            <p class="whitespace-pre-line">{{ $lembaga->alamat }}</p>
                        </div>
                        
                        @if($lembaga->latitude && $lembaga->longitude)
                            <div class="mb-3">
                                <span class="font-semibold">Koordinat:</span>
                                <span>{{ $lembaga->latitude }}, {{ $lembaga->longitude }}</span>
                            </div>
                            <div class="mt-2 mb-3">
                                <div id="map" class="h-64 w-full rounded-lg border border-gray-300"></div>
                            </div>
                        @endif
                        
                        @if($lembaga->nomor_telepon)
                            <div class="mb-3">
                                <span class="font-semibold">Nomor Telepon:</span>
                                <span>{{ $lembaga->nomor_telepon }}</span>
                            </div>
                        @endif
                        
                        @if($lembaga->email)
                            <div class="mb-3">
                                <span class="font-semibold">Email:</span>
                                <span>{{ $lembaga->email }}</span>
                            </div>
                        @endif
                        
                        @if($lembaga->website)
                            <div class="mb-3">
                                <span class="font-semibold">Website:</span>
                                <a href="{{ $lembaga->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $lembaga->website }}</a>
                            </div>
                        @endif
                        
                        @if($lembaga->media_sosial)
                            <div class="mb-3">
                                <span class="font-semibold">Media Sosial:</span>
                                <span>{{ $lembaga->media_sosial }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Dokumen Legalitas</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($lembaga->dokumen_legalitas)
                            <a href="{{ Storage::url($lembaga->dokumen_legalitas) }}" target="_blank" class="bg-white p-3 rounded-md border border-gray-200 flex items-center hover:bg-gray-50">
                                <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-700">Lihat Dokumen Legalitas</span>
                            </a>
                        @else
                            <p class="text-gray-500 italic">Tidak ada dokumen legalitas</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Kolom 3: Struktur Organisasi, Aktivitas, Prestasi -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Struktur Organisasi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Pimpinan:</span>
                            <span>{{ $lembaga->nama_pimpinan }}{{ $lembaga->jabatan_pimpinan ? ' ('.$lembaga->jabatan_pimpinan.')' : '' }}</span>
                        </div>
                        
                        @if($lembaga->jumlah_anggota)
                            <div class="mb-3">
                                <span class="font-semibold">Jumlah Anggota:</span>
                                <span>{{ $lembaga->jumlah_anggota }} orang</span>
                            </div>
                        @endif
                        
                        @if(is_array($lembaga->pengurus) && count($lembaga->pengurus) > 0)
                            <div class="mb-3">
                                <span class="font-semibold">Daftar Pengurus:</span>
                                <div class="mt-2 space-y-2">
                                    @foreach($lembaga->pengurus as $pengurus)
                                        <div class="bg-white p-2 rounded border border-gray-200">
                                            <p class="font-medium">{{ $pengurus['nama'] ?? '' }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $pengurus['jabatan'] ?? '' }}
                                                @if(isset($pengurus['keterangan']) && !empty($pengurus['keterangan']))
                                                    <span class="text-gray-500">({{ $pengurus['keterangan'] }})</span>
                                                @endif
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Aktivitas Lembaga</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($lembaga->aktivitas) && count($lembaga->aktivitas) > 0)
                            <div class="space-y-3">
                                @foreach($lembaga->aktivitas as $aktivitas)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $aktivitas['nama'] ?? '' }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $aktivitas['jenis'] ?? '' }}
                                            @if(isset($aktivitas['tahun']))
                                                <span class="text-gray-500">({{ $aktivitas['tahun'] }})</span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data aktivitas</p>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Prestasi Lembaga</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($lembaga->prestasi) && count($lembaga->prestasi) > 0)
                            <div class="space-y-3">
                                @foreach($lembaga->prestasi as $prestasi)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $prestasi['nama'] ?? '' }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $prestasi['pemberi'] ?? '' }}
                                            @if(isset($prestasi['tahun']) || isset($prestasi['tingkat']))
                                                <span class="text-gray-500">
                                                    ({{ $prestasi['tahun'] ?? '' }}{{ isset($prestasi['tingkat']) ? ', '.$prestasi['tingkat'] : '' }})
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data prestasi</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($lembaga->latitude && $lembaga->longitude)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map = L.map('map').setView([{{ $lembaga->latitude }}, {{ $lembaga->longitude }}], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            L.marker([{{ $lembaga->latitude }}, {{ $lembaga->longitude }}])
                .addTo(map)
                .bindPopup('{{ $lembaga->nama_lembaga }}');
        });
    </script>
    @endpush
@endif
@endsection