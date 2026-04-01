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
        Schema::table('users', function (Blueprint $table) {
            $table->string('jurusan')->nullable()->after('role')->comment('PPLG, AKL');
        });

        Schema::table('soals', function (Blueprint $table) {
            $table->string('jurusan')->nullable()->after('kategori')->comment('PPLG, AKL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('jurusan');
        });

        Schema::table('soals', function (Blueprint $table) {
            $table->dropColumn('jurusan');
        });
    }
};
