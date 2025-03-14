@extends('layouts.admin-dashboard')

@section('page-title', 'Tambah User Baru')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-4 sm:p-6">
        <div class="mb-6">
            <a href="{{ route('user.index') }}" 
               class="text-blue-600 hover:text-blue-900 flex items-center text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar User
            </a>
        </div>
        
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            
            <div class="max-w-md mx-auto">
                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-center sm:text-left">Informasi User</h3>
                
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                   required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email') }}" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                   required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                   required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="duration_days" class="block text-sm font-medium text-gray-700">Durasi Akun (Hari)</label>
                            <select id="duration_days" name="duration_days" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Tidak Terbatas</option>
                                <option value="1">1 Hari</option>
                                <option value="2">2 Hari</option>
                                <option value="3">3 Hari</option>
                                <option value="7">7 Hari</option>
                                <option value="14">14 Hari</option>
                                <option value="30">30 Hari</option>
                                <option value="90">90 Hari</option>
                                <option value="365">1 Tahun</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">
                                Biarkan kosong untuk akun tanpa batas waktu
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 sm:px-6 rounded-lg text-sm sm:text-base">
                        Tambah User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection