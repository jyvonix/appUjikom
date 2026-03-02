<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->string('opsi_e')->after('opsi_d')->nullable();
        });

        // Update enum for MySQL/MariaDB
        DB::statement("ALTER TABLE soals MODIFY COLUMN jawaban_benar ENUM('A', 'B', 'C', 'D', 'E') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->dropColumn('opsi_e');
        });

        DB::statement("ALTER TABLE soals MODIFY COLUMN jawaban_benar ENUM('A', 'B', 'C', 'D') NOT NULL");
    }
};
