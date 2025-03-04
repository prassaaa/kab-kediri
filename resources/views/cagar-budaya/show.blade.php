<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Cagar Budaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="mb-6">
                        <a href="{{ route('cagar-budaya.index') }}" class="text-blue-600 hover:text-blue-900">
                            &larr; Kembali ke Daftar
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Informasi Umum</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="mb-3">
                                        <span class="font-semibold">Objek Cagar Budaya:</span>
                                        <span>{{ $cagarBudaya->objek_cagar_budaya }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">Kategori:</span>
                                        <span>{{ $cagarBudaya->kategori }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">Bahan:</span>
                                        <span>{{ $cagarBudaya->bahan ?: 'Tidak ada data' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">Status:</span>
                                        @if ($cagarBudaya->is_verified)
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                Terverifikasi pada {{ $cagarBudaya->verified_at instanceof \DateTime ? $cagarBudaya->verified_at->format('d/m/Y H:i') : $cagarBudaya->verified_at }}
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
                                        <span class="font-semibold">Jalan/Dukuhan:</span>
                                        <span>{{ $cagarBudaya->lokasi_jalan_dukuhan ?: 'Tidak ada data' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">Dusun:</span>
                                        <span>{{ $cagarBudaya->lokasi_dusun ?: 'Tidak ada data' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">Desa:</span>
                                        <span>{{ $cagarBudaya->lokasi_desa }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">Kecamatan:</span>
                                        <span>{{ $cagarBudaya->lokasi_kecamatan }}</span>
                                    </div>
                                    @if ($cagarBudaya->longitude && $cagarBudaya->latitude)
                                        <div class="mb-3">
                                            <span class="font-semibold">Koordinat:</span>
                                            <span>{{ $cagarBudaya->latitude }}, {{ $cagarBudaya->longitude }}</span>
                                        </div>
                                        <div class="mt-4">
                                            <div id="map" class="h-64 rounded-lg border border-gray-300"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Nomor Registrasi</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="mb-3">
                                        <span class="font-semibold">No. Reg BPK Lama:</span>
                                        <span>{{ $cagarBudaya->no_reg_bpk_lama ?: 'Tidak ada data' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">No. Reg BPK Baru:</span>
                                        <span>{{ $cagarBudaya->no_reg_bpk_baru ?: 'Tidak ada data' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-semibold">No. Reg Disparbud:</span>
                                        <span>
                                            @if ($cagarBudaya->no_reg_disparbud_nomor_urut || $cagarBudaya->no_reg_disparbud_kode_kecamatan || $cagarBudaya->no_reg_disparbud_kode_kabupaten || $cagarBudaya->no_reg_disparbud_tahun)
                                                {{ $cagarBudaya->no_reg_disparbud_nomor_urut }}/{{ $cagarBudaya->no_reg_disparbud_kode_kecamatan }}/{{ $cagarBudaya->no_reg_disparbud_kode_kabupaten }}/{{ $cagarBudaya->no_reg_disparbud_tahun }}
                                            @else
                                                Tidak ada data
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Gambar</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    @if ($cagarBudaya->gambar)
                                        <img src="{{ Storage::url($cagarBudaya->gambar) }}" alt="{{ $cagarBudaya->objek_cagar_budaya }}" class="w-full h-auto rounded-lg">
                                    @else
                                        <div class="text-center p-6 bg-gray-100 rounded-lg">
                                            <p>Tidak ada gambar</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="whitespace-pre-line">{{ $cagarBudaya->deskripsi_singkat }}</p>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Kondisi Saat Ini</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="whitespace-pre-line">{{ $cagarBudaya->kondisi_saat_ini ?: 'Tidak ada data' }}</p>
                                </div>
                            </div>
                            
                            @if (Auth::user()->role != 'user')
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-2">Informasi Tambahan</h3>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="mb-3">
                                            <span class="font-semibold">Dibuat oleh:</span>
                                            <span>{{ $cagarBudaya->creator->name }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <span class="font-semibold">Dibuat pada:</span>
                                            <span>{{ $cagarBudaya->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                        @if ($cagarBudaya->is_verified)
                                            <div class="mb-3">
                                                <span class="font-semibold">Diverifikasi oleh:</span>
                                                <span>{{ $cagarBudaya->verifier->name }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            @if (Auth::user()->role != 'user')
                                <div class="mt-6 flex space-x-4">
                                    @if ((Auth::user()->role == 'admin' && !$cagarBudaya->is_verified) || Auth::user()->role == 'superadmin')
                                        <a href="{{ route('cagar-budaya.edit', $cagarBudaya) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                            Edit Data
                                        </a>
                                    @endif
                                    
                                    @if (Auth::user()->role == 'superadmin')
                                        @if (!$cagarBudaya->is_verified)
                                            <form action="{{ route('cagar-budaya.verify', $cagarBudaya) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                                                    Verifikasi Data
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('cagar-budaya.destroy', $cagarBudaya) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                Hapus Data
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($cagarBudaya->longitude && $cagarBudaya->latitude)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let map = L.map('map').setView([{{ $cagarBudaya->latitude }}, {{ $cagarBudaya->longitude }}], 15);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                L.marker([{{ $cagarBudaya->latitude }}, {{ $cagarBudaya->longitude }}])
                    .addTo(map)
                    .bindPopup('{{ $cagarBudaya->objek_cagar_budaya }}');
            });
        </script>
    @endif
</x-app-layout>