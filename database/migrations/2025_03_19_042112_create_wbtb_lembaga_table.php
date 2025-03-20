<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wbtb_lembaga', function (Blueprint $table) {
            $table->id();
            // Informasi Dasar
            $table->string('nama_lembaga');
            $table->string('kategori_lembaga'); // Sanggar, Komunitas, Organisasi, dll
            $table->string('nomor_registrasi')->nullable();
            $table->date('tanggal_berdiri')->nullable();
            $table->string('tingkat_lembaga')->nullable(); // Desa, Kecamatan, Kabupaten, Provinsi, Nasional
            $table->string('status_hukum')->nullable(); // Berbadan hukum, tidak berbadan hukum
            $table->text('visi_misi')->nullable();
            
            // Kontak dan Alamat
            $table->text('alamat');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('media_sosial')->nullable();
            
            // Struktur Organisasi
            $table->string('nama_pimpinan');
            $table->string('jabatan_pimpinan')->nullable();
            $table->json('pengurus')->nullable(); // Menyimpan daftar pengurus dalam format JSON
            $table->integer('jumlah_anggota')->nullable();
            
            // Aktivitas
            $table->json('aktivitas')->nullable(); // Menyimpan daftar aktivitas
            $table->json('prestasi')->nullable(); // Menyimpan daftar prestasi
            
            // Media
            $table->string('logo')->nullable();
            $table->string('foto_bangunan')->nullable();
            $table->json('foto_kegiatan')->nullable();
            $table->string('dokumen_legalitas')->nullable();
            
            // Info administratif
            $table->foreignId('created_by')->constrained('users');
            $table->boolean('is_verified')->default(false);
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wbtb_lembaga');
    }
};