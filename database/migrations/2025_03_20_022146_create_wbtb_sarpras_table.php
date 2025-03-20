<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wbtb_sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sarpras');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('nama_kontak');
            $table->string('no_hp');
            $table->string('status_kepemilikan');
            $table->string('nama_pemilik');
            $table->string('nama_pengelola')->nullable();
            $table->string('papan_nama')->nullable();
            $table->string('foto_dalam')->nullable();
            $table->string('foto_luar')->nullable();
            $table->json('fasilitas')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wbtb_sarpras');
    }
};