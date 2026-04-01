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
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->integer('waktu')->default(60)->comment('dalam menit');
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('Guru pembuat');
            $table->timestamps();
        });

        // Tambah modul_id ke tabel soals
        Schema::table('soals', function (Blueprint $table) {
            $table->foreignId('modul_id')->nullable()->after('id')->constrained()->onDelete('cascade');
        });

        // Tambah modul_id ke tabel nilais agar kita tahu nilai ini untuk modul apa
        Schema::table('nilais', function (Blueprint $table) {
            $table->foreignId('modul_id')->nullable()->after('id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropConstrainedForeignId('modul_id');
        });

        Schema::table('soals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('modul_id');
        });

        Schema::dropIfExists('moduls');
    }
};
