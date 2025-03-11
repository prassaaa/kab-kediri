@extends('layouts.admin-dashboard')

@section('page-title', 'Notifikasi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Data Cagar Budaya yang Belum Diverifikasi</h3>
        
        @if ($unverified->count() > 0)
            <div class="space-y-4">
                @foreach ($unverified as $item)
                    <div class="border border-gray-200 rounded-lg p-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <h4 class="font-medium">{{ $item->objek_cagar_budaya }}</h4>
                            <div class="flex items-center mt-1">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if ($item->kategori == 'Benda') bg-blue-100 text-blue-800
                                    @elseif ($item->kategori == 'Bangunan') bg-purple-100 text-purple-800
                                    @elseif ($item->kategori == 'Struktur') bg-green-100 text-green-800
                                    @elseif ($item->kategori == 'Situs') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $item->kategori }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="text-sm text-gray-600">{{ $item->lokasi_kecamatan }}</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                Ditambahkan oleh {{ $item->creator->name }} pada {{ $item->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('cagar-budaya.show', $item) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                            
                            @if (Auth::user()->role == 'superadmin')
                                <form action="{{ route('cagar-budaya.verify', $item) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded text-sm flex items-center" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Verifikasi
                                    </button>
                                </form>
                                
                                <button type="button" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded text-sm flex items-center" 
                                        onclick="openRevisionModal('{{ $item->id }}', '{{ $item->objek_cagar_budaya }}')">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Revisi
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-6 bg-gray-50 rounded-lg">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada notifikasi</h3>
                <p class="mt-1 text-sm text-gray-500">Semua data cagar budaya sudah diverifikasi.</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal Revisi -->
<div id="revisionModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg max-w-md w-full mx-4">
        <div class="p-4 border-b">
            <h3 class="text-lg font-medium">Revisi Data Cagar Budaya</h3>
            <p id="revisionItemTitle" class="text-sm text-gray-600"></p>
        </div>
        
        <form id="revisionForm" action="" method="POST">
            @csrf
            
            <div class="p-4">
                <label for="revision_notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Revisi</label>
                <textarea id="revision_notes" name="revision_notes" rows="4" 
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                          placeholder="Masukkan informasi yang perlu direvisi..." required></textarea>
            </div>
            
            <div class="p-4 bg-gray-50 border-t flex justify-end space-x-3">
                <button type="button" onclick="closeRevisionModal()" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                    Kirim Revisi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRevisionModal(id, title) {
        document.getElementById('revisionItemTitle').textContent = title;
        // Gunakan url() helper untuk membuat URL yang benar
        const baseUrl = "{{ url('/cagar-budaya') }}";
        document.getElementById('revisionForm').action = `${baseUrl}/${id}/request-revision`;
        console.log("Form action set to: " + document.getElementById('revisionForm').action);
        
        document.getElementById('revisionModal').classList.remove('hidden');
    }
    
    function closeRevisionModal() {
        document.getElementById('revisionModal').classList.add('hidden');
        document.getElementById('revision_notes').value = '';
    }
    
    // Close modal if clicking outside
    document.getElementById('revisionModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRevisionModal();
        }
    });
</script>

@if (isset($needsRevision) && $needsRevision->count() > 0)
<div class="bg-white overflow-hidden shadow-sm rounded-lg mt-8">
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Data Cagar Budaya yang Perlu Direvisi</h3>
        
        <div class="space-y-4">
            @foreach ($needsRevision as $item)
                <div class="border border-yellow-300 bg-yellow-50 rounded-lg p-4 flex justify-between items-center">
                    <div>
                        <h4 class="font-medium">{{ $item->objek_cagar_budaya }}</h4>
                        <div class="flex items-center mt-1">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if ($item->kategori == 'Benda') bg-blue-100 text-blue-800
                                @elseif ($item->kategori == 'Bangunan') bg-purple-100 text-purple-800
                                @elseif ($item->kategori == 'Struktur') bg-green-100 text-green-800
                                @elseif ($item->kategori == 'Situs') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $item->kategori }}
                            </span>
                            <span class="mx-2">•</span>
                            <span class="text-sm text-gray-600">{{ $item->lokasi_kecamatan }}</span>
                        </div>
                        
                        @if ($item->revision_notes)
                            <div class="mt-2 p-2 bg-yellow-100 border border-yellow-300 rounded-md">
                                <p class="text-xs font-medium text-yellow-800">Catatan Revisi:</p>
                                <p class="text-xs text-yellow-700">{{ $item->revision_notes }}</p>
                            </div>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('cagar-budaya.edit', $item) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white py-1 px-3 rounded text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Perbaiki
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection