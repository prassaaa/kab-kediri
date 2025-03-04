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
@endsection