@extends('layouts.admin-dashboard')

@section('page-title', 'Detail OPK')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('wbtb.opk.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            <div class="flex space-x-2">
                @if(Auth::user()->role != 'user' && (!$opk->is_verified || Auth::user()->role == 'superadmin'))
                    <a href="{{ route('wbtb.opk.edit', $opk) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                @endif
                
                @if(Auth::user()->role == 'superadmin' && !$opk->is_verified)
                    <form action="{{ route('wbtb.opk.verify', $opk) }}" method="POST">
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
                    <form action="{{ route('wbtb.opk.destroy', $opk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Informasi Umum</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Nama OPK:</span>
                            <span>{{ $opk->nama_opk }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Jenis OPK:</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ $opk->jenis_opk }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Status:</span>
                            @if ($opk->is_verified)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                    Terverifikasi pada {{ $opk->verified_at instanceof \DateTime ? $opk->verified_at->format('d/m/Y H:i') : $opk->verified_at }}
                                </span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                    Belum Terverifikasi
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Lokasi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Alamat:</span>
                            <span class="whitespace-pre-line">{{ $opk->alamat }}</span>
                        </div>
                        
                        @if ($opk->longitude && $opk->latitude)
                            <div class="mb-3">
                                <span class="font-semibold">Koordinat:</span>
                                <span>{{ $opk->latitude }}, {{ $opk->longitude }}</span>
                            </div>
                            <div class="mt-4">
                                <div id="map" class="h-64 rounded-lg border border-gray-300"></div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="whitespace-pre-line">{{ $opk->deskripsi }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Foto/Gambar</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if ($opk->foto)
                            <img src="{{ Storage::url($opk->foto) }}" alt="{{ $opk->nama_opk }}" class="w-full h-auto rounded-lg">
                        @else
                            <div class="text-center p-6 bg-gray-100 rounded-lg">
                                <p>Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Tautan Video</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($opk->tautan_video)
                            @php
                                // Convert YouTube URL to embed URL if it's a YouTube link
                                $videoUrl = $opk->tautan_video;
                                $embedUrl = null;
                                
                                if (strpos($videoUrl, 'youtube.com/watch?v=') !== false) {
                                    $videoId = explode('v=', $videoUrl)[1];
                                    $ampersandPosition = strpos($videoId, '&');
                                    if ($ampersandPosition !== false) {
                                        $videoId = substr($videoId, 0, $ampersandPosition);
                                    }
                                    $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                } elseif (strpos($videoUrl, 'youtu.be/') !== false) {
                                    $videoId = explode('youtu.be/', $videoUrl)[1];
                                    $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                }
                            @endphp
                            
                            @if($embedUrl)
                                <div class="relative h-0 overflow-hidden rounded-lg" style="padding-bottom: 56.25%;">
                                    <iframe 
                                        class="absolute top-0 left-0 w-full h-full" 
                                        src="{{ $embedUrl }}" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @else
                                <a href="{{ $opk->tautan_video }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ $opk->tautan_video }}
                                </a>
                            @endif
                        @else
                            <p class="text-gray-500 italic">Tidak ada tautan video</p>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Dokumen</h3>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Dokumen Kajian:</h4>
                            @if($opk->dokumen_kajian)
                                <a href="{{ Storage::url($opk->dokumen_kajian) }}" target="_blank" class="bg-white p-3 rounded-md border border-gray-200 flex items-center hover:bg-gray-50">
                                    <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-700">Lihat Dokumen Kajian</span>
                                </a>
                            @else
                                <p class="text-gray-500 italic">Tidak ada dokumen kajian</p>
                            @endif
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Dokumen Lainnya:</h4>
                            @if($opk->dokumen_lainnya)
                                <a href="{{ Storage::url($opk->dokumen_lainnya) }}" target="_blank" class="bg-white p-3 rounded-md border border-gray-200 flex items-center hover:bg-gray-50">
                                    <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-700">Lihat Dokumen Lainnya</span>
                                </a>
                            @else
                                <p class="text-gray-500 italic">Tidak ada dokumen lainnya</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if (Auth::user()->role != 'user')
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Informasi Tambahan</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat oleh:</span>
                                <span>{{ $opk->creator ? $opk->creator->name : 'Unknown' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat pada:</span>
                                <span>{{ $opk->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if ($opk->is_verified && $opk->verifier)
                                <div class="mb-3">
                                    <span class="font-semibold">Diverifikasi oleh:</span>
                                    <span>{{ $opk->verifier->name }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold">Tanggal verifikasi:</span>
                                    <span>{{ $opk->verified_at->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if ($opk->longitude && $opk->latitude)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map = L.map('map').setView([{{ $opk->latitude }}, {{ $opk->longitude }}], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            L.marker([{{ $opk->latitude }}, {{ $opk->longitude }}])
                .addTo(map)
                .bindPopup('{{ $opk->nama_opk }}');
        });
    </script>
    @endpush
@endif
@endsection