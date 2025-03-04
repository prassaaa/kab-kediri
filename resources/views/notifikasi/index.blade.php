<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Data Cagar Budaya yang Belum Diverifikasi</h3>
                    
                    @if ($unverified->count() > 0)
                        <div class="space-y-4">
                            @foreach ($unverified as $item)
                                <div class="border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                                    <div>
                                        <h4 class="font-medium">{{ $item->objek_cagar_budaya }}</h4>
                                        <p class="text-sm text-gray-600">
                                            {{ $item->kategori }} • {{ $item->lokasi_kecamatan }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            Ditambahkan oleh {{ $item->creator->name }} pada {{ $item->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('cagar-budaya.show', $item) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded text-sm">
                                            Detail
                                        </a>
                                        
                                        @if (Auth::user()->role == 'superadmin')
                                            <form action="{{ route('cagar-budaya.verify', $item) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded text-sm" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
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
                            <p>Tidak ada data yang perlu diverifikasi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>