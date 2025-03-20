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
        Schema::create('wbtb_opk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_opk');
            $table->string('jenis_opk');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->string('dokumen_kajian')->nullable();
            $table->string('tautan_video')->nullable();
            $table->string('dokumen_lainnya')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
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
        Schema::dropIfExists('wbtb_opk');
    }
};