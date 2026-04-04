<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'waktu',
        'is_active',
        'user_id',
        'kkm',
        'max_retakes',
        'point_per_question',
        'score_divisor',
        'is_random',
        'show_result',
        'jurusan',
    ];

    /**
     * Get effective setting (fallback to global setting if null)
     */
    public function getSetting($key)
    {
        if ($this->{$key} !== null) {
            return $this->{$key};
        }

        // Map model attributes to global setting keys
        $mapping = [
            'kkm' => 'kkm',
            'max_retakes' => 'max_retakes',
            'point_per_question' => 'point_per_question',
            'score_divisor' => 'score_divisor',
            'waktu' => 'exam_duration'
        ];

        $settingKey = $mapping[$key] ?? $key;
        return Setting::get($settingKey);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
