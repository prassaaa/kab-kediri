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
        Schema::table('cagar_budayas', function (Blueprint $table) {
            $table->enum('predikat', ['Cagar Budaya', 'Objek diduga cagar budaya'])->default('Objek diduga cagar budaya')->after('objek_cagar_budaya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cagar_budayas', function (Blueprint $table) {
            $table->dropColumn('predikat');
        });
    }
};
