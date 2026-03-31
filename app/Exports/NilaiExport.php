<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NilaiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Nilai::with('user')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'Username',
            'Benar',
            'Skor Akhir',
            'Status',
            'Tanggal Ujian',
        ];
    }

    public function map($nilai): array
    {
        static $no = 0;
        $no++;
        $kkm = \App\Models\Setting::get('kkm', 75);

        return [
            $no,
            $nilai->user->name,
            $nilai->user->username,
            $nilai->jumlah_benar,
            $nilai->skor,
            $nilai->skor >= $kkm ? 'LULUS' : 'TIDAK LULUS',
            $nilai->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
