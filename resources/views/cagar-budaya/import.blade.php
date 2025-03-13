@extends('layouts.admin-dashboard')

@section('page-title', 'Import Data Cagar Budaya')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('cagar-budaya.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <div id="alert-container"></div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4">Panduan Import</h3>
            <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                <p class="mb-2">Format file yang didukung: CSV, XLS, XLSX (maks 5MB)</p>
                <p class="mb-2">Pastikan file Excel memiliki header kolom berikut:</p>
                <ul class="list-disc ml-6 mb-4">
                    <li><span class="font-medium">objek_cagar_budaya</span> (wajib)</li>
                    <li><span class="font-medium">predikat</span> (wajib)</li>
                    <li><span class="font-medium">kategori</span> (wajib)</li>
                    <li><span class="font-medium">bahan</span></li>
                    <li><span class="font-medium">lokasi_jalan_dukuhan</span></li>
                    <li><span class="font-medium">lokasi_dusun</span></li>
                    <li><span class="font-medium">lokasi_desa</span></li>
                    <li><span class="font-medium">lokasi_kecamatan</span></li>
                    <li><span class="font-medium">latitude</span></li>
                    <li><span class="font-medium">longitude</span></li>
                    <li><span class="font-medium">no_reg_bpk_lama</span></li>
                    <li><span class="font-medium">no_reg_bpk_baru</span></li>
                    <li><span class="font-medium">no_reg_disparbud_nomor_urut</span></li>
                    <li><span class="font-medium">no_reg_disparbud_kode_kecamatan</span></li>
                    <li><span class="font-medium">no_reg_disparbud_kode_kabupaten</span></li>
                    <li><span class="font-medium">no_reg_disparbud_tahun</span></li>
                    <li><span class="font-medium">deskripsi_singkat</span></li>
                    <li><span class="font-medium">kondisi_saat_ini</span></li>
                </ul>
                <a href="{{ route('cagar-budaya.template-download') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg inline-block">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download Template
                </a>
            </div>
        </div>

        <form id="import-form" action="{{ route('cagar-budaya.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Upload File</label>
                <div class="flex items-center">
                    <label class="flex flex-col items-center px-4 py-6 bg-white text-blue-500 rounded-lg shadow-lg tracking-wide uppercase border border-blue-500 cursor-pointer hover:bg-blue-500 hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal" id="file-name">Pilih file</span>
                        <input type="file" name="file" id="file" class="hidden" accept=".csv, .xls, .xlsx" required>
                    </label>
                </div>
                <p class="text-xs text-gray-500 mt-1">Format: CSV, XLS, XLSX. Maks: 5MB</p>
            </div>

            <div id="upload-progress-container" class="mb-6 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Progress</label>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div id="upload-progress-bar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                </div>
                <p id="upload-progress-text" class="text-xs text-gray-500 mt-1">0%</p>
            </div>
            
            <div class="text-center">
                <button type="submit" id="import-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Import Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const importForm = document.getElementById('import-form');
        const fileInput = document.getElementById('file');
        const fileNameDisplay = document.getElementById('file-name');
        const importButton = document.getElementById('import-button');
        const progressContainer = document.getElementById('upload-progress-container');
        const progressBar = document.getElementById('upload-progress-bar');
        const progressText = document.getElementById('upload-progress-text');
        const alertContainer = document.getElementById('alert-container');
        
        // Fungsi untuk menampilkan nama file saat dipilih
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                fileNameDisplay.textContent = file.name;
                
                // Cek ukuran file
                const fileSize = file.size / 1024 / 1024; // convert to MB
                if (fileSize > 5) {
                    showAlert('Ukuran file terlalu besar. Maksimal 5MB.', 'error');
                    this.value = '';
                    fileNameDisplay.textContent = 'Pilih file';
                    return;
                }
                
                // Cek tipe file
                const validExtensions = ['csv', 'xls', 'xlsx'];
                const extension = file.name.split('.').pop().toLowerCase();
                if (!validExtensions.includes(extension)) {
                    showAlert('Format file tidak valid. Hanya file CSV, XLS, atau XLSX yang diperbolehkan.', 'error');
                    this.value = '';
                    fileNameDisplay.textContent = 'Pilih file';
                    return;
                }
                
                // Jika file lebih dari 1MB, periksa koneksi
                if (fileSize > 1) {
                    checkConnectionSpeed().then(status => {
                        if (status.speed === 'slow') {
                            showAlert(`Perhatian: Koneksi internet lambat (${status.latency}ms). Upload mungkin membutuhkan waktu lebih lama.`, 'warning');
                        }
                    });
                }
            }
        });
        
        // Function to check connection speed
        function checkConnectionSpeed() {
            return new Promise((resolve) => {
                const startTime = Date.now();
                const url = '{{ route("connection.test") }}?' + startTime;
                
                fetch(url, { method: 'HEAD' })
                    .then(response => {
                        const endTime = Date.now();
                        const latency = endTime - startTime;
                        
                        resolve({
                            online: true,
                            latency: latency,
                            speed: latency > 500 ? 'slow' : 'good'
                        });
                    })
                    .catch(error => {
                        console.error('Gagal mengecek koneksi:', error);
                        resolve({
                            online: navigator.onLine,
                            latency: 0,
                            speed: 'unknown'
                        });
                    });
            });
        }
        
        // Function to display alerts
        function showAlert(message, type = 'info') {
            // Remove any existing alerts
            alertContainer.innerHTML = '';
            
            // Create new alert
            const alertDiv = document.createElement('div');
            alertDiv.className = `mb-4 p-4 rounded-md ${type === 'error' ? 'bg-red-100 border border-red-200 text-red-700' : type === 'warning' ? 'bg-yellow-100 border border-yellow-200 text-yellow-700' : type === 'success' ? 'bg-green-100 border border-green-200 text-green-700' : 'bg-blue-100 border border-blue-200 text-blue-700'}`;
            
            // Add icon based on type
            let icon = '';
            if (type === 'error') {
                icon = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
            } else if (type === 'warning') {
                icon = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
            } else if (type === 'success') {
                icon = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
            } else {
                icon = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
            }
            
            // If the message is an array, display as list
            if (Array.isArray(message)) {
                let messageHtml = `<p class="flex items-start">${icon}<span>`;
                messageHtml += `<strong class="font-medium">${type.charAt(0).toUpperCase() + type.slice(1)}:</strong> `;
                messageHtml += '<ul class="list-disc ml-6 mt-1">';
                message.forEach(item => {
                    messageHtml += `<li>${item}</li>`;
                });
                messageHtml += '</ul></span></p>';
                alertDiv.innerHTML = messageHtml;
            } else {
                alertDiv.innerHTML = `<p class="flex items-start">${icon}<span><strong class="font-medium">${type.charAt(0).toUpperCase() + type.slice(1)}:</strong> ${message}</span></p>`;
            }
            
            alertContainer.appendChild(alertDiv);
            
            // Auto-hide after 10 seconds only for success alerts
            if (type === 'success') {
                setTimeout(() => {
                    alertDiv.remove();
                }, 10000);
            }
        }
        
        // Handle form submission
        importForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            
            if (!fileInput.files || fileInput.files.length === 0) {
                showAlert('Silakan pilih file terlebih dahulu.', 'error');
                return;
            }
            
            // Check connection first
            checkConnectionSpeed().then(status => {
                if (!status.online) {
                    showAlert('Tidak dapat mengirim form: Koneksi internet terputus', 'error');
                    return;
                }
                
                let shouldProceed = true;
                if (status.speed === 'slow') {
                    // Show confirmation if connection is slow
                    shouldProceed = confirm(`Koneksi internet Anda lambat (${status.latency}ms). Upload mungkin membutuhkan waktu lebih lama. Lanjutkan?`);
                }
                
                if (shouldProceed) {
                    // Show progress bar
                    progressContainer.classList.remove('hidden');
                    
                    // Disable the button
                    importButton.disabled = true;
                    importButton.innerHTML = '<svg class="w-5 h-5 inline-block mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Mengimpor...';
                    
                    // Use FormData for upload
                    const formData = new FormData(importForm);
                    
                    // Use XMLHttpRequest to track progress
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', importForm.action, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    
                    // Track upload progress
                    xhr.upload.onprogress = function(e) {
                        if (e.lengthComputable) {
                            const percentComplete = Math.round((e.loaded / e.total) * 100);
                            progressBar.style.width = percentComplete + '%';
                            progressText.textContent = percentComplete + '%';
                        }
                    };
                    
                    // Handle response
                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            try {
                                const response = JSON.parse(xhr.responseText);
                                
                                if (response.success) {
                                    importButton.innerHTML = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Berhasil';
                                    showAlert(response.message, 'success');
                                    
                                    // Redirect setelah 2 detik
                                    setTimeout(() => {
                                        window.location.href = response.redirect;
                                    }, 2000);
                                } else {
                                    importButton.disabled = false;
                                    importButton.innerHTML = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg> Import Data';
                                    showAlert(response.errors || response.message, 'error');
                                }
                            } catch (e) {
                                importButton.disabled = false;
                                importButton.innerHTML = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg> Import Data';
                                showAlert('Terjadi kesalahan saat memproses respons dari server.', 'error');
                            }
                        } else {
                            importButton.disabled = false;
                            importButton.innerHTML = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg> Import Data';
                            
                            try {
                                const response = JSON.parse(xhr.responseText);
                                showAlert(response.errors || response.message, 'error');
                            } catch (e) {
                                showAlert('Terjadi kesalahan saat menghubungi server.', 'error');
                            }
                        }
                    };
                    
                    // Handle network errors
                    xhr.onerror = function() {
                        importButton.disabled = false;
                        importButton.innerHTML = '<svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg> Import Data';
                        showAlert('Terjadi kesalahan jaringan. Silakan cek koneksi internet Anda.', 'error');
                    };
                    
                    // Send the form data
                    xhr.send(formData);
                }
            });
        });
    });
</script>

<style>
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
@endpush