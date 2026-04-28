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
        Schema::table('moduls', function (Blueprint $table) {
            $table->enum('tipe', ['harian', 'uts', 'uas', 'ujikom'])->default('harian')->after('nama');
            $table->string('token', 6)->nullable()->after('tipe');
            $table->dateTime('start_time')->nullable()->after('waktu');
            $table->dateTime('end_time')->nullable()->after('start_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moduls', function (Blueprint $table) {
            $table->dropColumn(['tipe', 'token', 'start_time', 'end_time']);
        });
    }
};
