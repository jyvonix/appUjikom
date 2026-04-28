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
        // Update Users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('jurusan_id')->nullable()->after('role')->constrained('jurusans')->onDelete('set null');
            $table->foreignId('kelas_id')->nullable()->after('jurusan_id')->constrained('kelas')->onDelete('set null');
        });

        // Update Moduls table
        Schema::table('moduls', function (Blueprint $table) {
            $table->foreignId('jurusan_id')->nullable()->after('user_id')->constrained('jurusans')->onDelete('set null');
        });
        
        // Update Soals table
        Schema::table('soals', function (Blueprint $table) {
             $table->foreignId('jurusan_id')->nullable()->after('kategori')->constrained('jurusans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jurusan_id');
            $table->dropConstrainedForeignId('kelas_id');
        });

        Schema::table('moduls', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jurusan_id');
        });

        Schema::table('soals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jurusan_id');
        });
    }
};
