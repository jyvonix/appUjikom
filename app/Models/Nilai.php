<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $fillable = [
        'user_id',
        'modul_id',
        'jumlah_benar',
        'skor',
        'list_jawaban',
    ];

    protected $casts = [
        'list_jawaban' => 'array',
    ];

    public function modul(): BelongsTo
    {
        return $this->belongsTo(Modul::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
