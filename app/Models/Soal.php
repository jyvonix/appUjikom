<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soal extends Model
{
    protected $fillable = [
        'modul_id',
        'pertanyaan',
        'gambar',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'jawaban_benar',
        'kategori',
        'kesulitan',
        'user_id'
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
