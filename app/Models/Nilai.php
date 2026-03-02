<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $fillable = [
        'user_id',
        'jumlah_benar',
        'skor',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
