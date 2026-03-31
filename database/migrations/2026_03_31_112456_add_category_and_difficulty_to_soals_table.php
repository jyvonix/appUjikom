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
        Schema::table('soals', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('jawaban_benar')->comment('Misal: MTK, INDO, produktif');
            $table->enum('kesulitan', ['mudah', 'sedang', 'sulit'])->default('sedang')->after('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'kesulitan']);
        });
    }
};
