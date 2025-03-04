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
        Schema::create('cagar_budayas', function (Blueprint $table) {
            $table->id();
            $table->string('objek_cagar_budaya');
            $table->enum('kategori', ['Benda', 'Bangunan', 'Struktur', 'Situs', 'Kawasan']);
            
            // Nomor Registrasi BPK
            $table->string('no_reg_bpk_lama')->nullable();
            $table->string('no_reg_bpk_baru')->nullable();
            
            // Nomor Registrasi Disparbud
            $table->string('no_reg_disparbud_nomor_urut')->nullable();
            $table->string('no_reg_disparbud_kode_kecamatan')->nullable();
            $table->string('no_reg_disparbud_kode_kabupaten')->nullable();
            $table->string('no_reg_disparbud_tahun')->nullable();
            
            // Lokasi
            $table->string('lokasi_jalan_dukuhan')->nullable();
            $table->string('lokasi_dusun')->nullable();
            $table->string('lokasi_desa');
            $table->string('lokasi_kecamatan');
            
            $table->string('bahan')->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->text('deskripsi_singkat');
            $table->string('gambar')->nullable();
            $table->text('kondisi_saat_ini')->nullable();
            
            // Status verifikasi
            $table->boolean('is_verified')->default(false);
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cagar_budayas');
    }
};
