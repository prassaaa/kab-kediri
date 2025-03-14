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
            $table->string('status')->default('pending')->after('is_verified');
            $table->text('revision_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cagar_budayas', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('revision_notes');
        });
    }
};
