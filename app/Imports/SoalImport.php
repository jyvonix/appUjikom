<?php

namespace App\Imports;

use App\Models\Soal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{
    private $modul_id;

    public function __construct($modul_id = null)
    {
        $this->modul_id = $modul_id;
    }

    public function model(array $row)
    {
        $pertanyaan = $row['pertanyaan'] ?? $row['Pertanyaan'] ?? null;
        
        if (!$pertanyaan) {
            return null;
        }

        return new Soal([
            'modul_id'      => $this->modul_id,
            'pertanyaan'    => $pertanyaan,
            'opsi_a'        => $row['opsi_a'] ?? $row['Opsi A'] ?? '',
            'opsi_b'        => $row['opsi_b'] ?? $row['Opsi B'] ?? '',
            'opsi_c'        => $row['opsi_c'] ?? $row['Opsi C'] ?? '',
            'opsi_d'        => $row['opsi_d'] ?? $row['Opsi D'] ?? '',
            'opsi_e'        => $row['opsi_e'] ?? $row['Opsi E'] ?? '',
            'jawaban_benar' => strtoupper(trim($row['jawaban_benar'] ?? $row['Jawaban Benar'] ?? 'A')),
            'kategori'      => $row['kategori'] ?? $row['Kategori'] ?? null,
            'kesulitan'     => strtolower(trim($row['kesulitan'] ?? $row['Kesulitan'] ?? 'sedang')),
            'user_id'       => Auth::id(),
        ]);
    }
}
