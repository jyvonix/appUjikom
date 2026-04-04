<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Modul;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Normalisasi Modul Lama yang jurusannya NULL
        Modul::where('nama', 'LIKE', '%RPL%')->update(['jurusan' => 'RPL']);
        Modul::where('nama', 'LIKE', '%MPLB%')->update(['jurusan' => 'MPLB']);
        
        // Memberikan jurusan default pada sisa modul jika masih ada yang NULL
        Modul::whereNull('jurusan')->update(['jurusan' => 'RPL']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
