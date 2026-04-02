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
        Schema::table('nilais', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('modul_id');
            $table->index('created_at');
        });

        Schema::table('soals', function (Blueprint $table) {
            $table->index('modul_id');
            $table->index('kategori');
            $table->index('kesulitan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['modul_id']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('soals', function (Blueprint $table) {
            $table->dropIndex(['modul_id']);
            $table->dropIndex(['kategori']);
            $table->dropIndex(['kesulitan']);
        });
    }
};
