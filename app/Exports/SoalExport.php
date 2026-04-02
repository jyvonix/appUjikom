<?php

namespace App\Exports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SoalExport implements FromCollection, WithHeadings, WithMapping
{
    protected $user_id;
    protected $modul_id;

    public function __construct($user_id = null, $modul_id = null)
    {
        $this->user_id = $user_id;
        $this->modul_id = $modul_id;
    }

    public function collection()
    {
        $query = Soal::query();
        if ($this->user_id) {
            $query->where('user_id', $this->user_id);
        }
        if ($this->modul_id) {
            $query->where('modul_id', $this->modul_id);
        }
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Pertanyaan',
            'Opsi A',
            'Opsi B',
            'Opsi C',
            'Opsi D',
            'Opsi E',
            'Jawaban Benar',
        ];
    }

    public function map($soal): array
    {
        return [
            $soal->pertanyaan,
            $soal->opsi_a,
            $soal->opsi_b,
            $soal->opsi_c,
            $soal->opsi_d,
            $soal->opsi_e,
            $soal->jawaban_benar,
        ];
    }
}
