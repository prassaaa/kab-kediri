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
        Schema::create('wbtb_sdm', function (Blueprint $table) {
            $table->id();
            // Identitas tenaga budaya
            $table->string('nama_lengkap');
            $table->string('gelar_pendidikan')->nullable();
            $table->string('nama_alias')->nullable();
            $table->string('jenis_identitas'); // KTP, Paspor, dll
            $table->string('nomor_identitas');
            $table->string('tempat_lahir');
            $table->string('kewarganegaraan')->default('Indonesia');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama')->nullable();
            
            // Media foto
            $table->string('pas_foto')->nullable();
            $table->string('foto_identitas')->nullable();
            
            // Alamat
            $table->text('alamat');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            
            // Kontak
            $table->string('nomor_hp')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('email')->nullable();
            $table->string('media_sosial')->nullable();
            
            // Riwayat dalam bentuk JSON
            $table->json('riwayat_pendidikan')->nullable();
            $table->json('riwayat_pelatihan')->nullable();
            $table->json('riwayat_pekerjaan')->nullable();
            $table->json('riwayat_aktivitas')->nullable();
            $table->json('riwayat_penghargaan')->nullable();
            
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
        Schema::dropIfExists('wbtb_sdm');
    }
};