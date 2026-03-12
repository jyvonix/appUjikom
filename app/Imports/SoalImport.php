<?php

namespace App\Imports;

use App\Models\Soal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Debug or handle missing keys safely
        $pertanyaan = $row['pertanyaan'] ?? $row['Pertanyaan'] ?? null;
        
        if (!$pertanyaan) {
            return null;
        }

        return new Soal([
            'pertanyaan'    => $pertanyaan,
            'opsi_a'        => $row['opsi_a'] ?? $row['Opsi A'] ?? '',
            'opsi_b'        => $row['opsi_b'] ?? $row['Opsi B'] ?? '',
            'opsi_c'        => $row['opsi_c'] ?? $row['Opsi C'] ?? '',
            'opsi_d'        => $row['opsi_d'] ?? $row['Opsi D'] ?? '',
            'opsi_e'        => $row['opsi_e'] ?? $row['Opsi E'] ?? '',
            'jawaban_benar' => strtoupper(trim($row['jawaban_benar'] ?? $row['Jawaban Benar'] ?? 'A')),
            'user_id'       => Auth::id(),
        ]);
    }
}
