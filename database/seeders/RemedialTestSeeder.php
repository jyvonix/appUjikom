<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\Soal;

class RemedialTestSeeder extends Seeder
{
    public function run(): void
    {
        $opsi = ['A', 'B', 'C', 'D', 'E'];
        
        // Ambil beberapa nilai yang skornya di bawah KKM atau secara acak (sekitar 15 siswa yang ikut remedial)
        $nilais = Nilai::inRandomOrder()->limit(15)->get();

        foreach ($nilais as $nilai) {
            // Kita buat secara acak 1 sampai 3 kali remedial untuk siswa ini pada modul yang sama
            $jumlah_remedial = rand(1, 3);
            
            for ($i = 0; $i < $jumlah_remedial; $i++) {
                // Random jumlah benar (mereka masih bisa dapat nilai jelek atau bagus di remedial)
                $jumlah_benar = rand(3, 10);
                $skor = $jumlah_benar * 10;
                
                $list_jawaban = [];
                $soals = Soal::where('modul_id', $nilai->modul_id)->get();
                foreach ($soals as $soal) {
                    $list_jawaban[$soal->id] = $opsi[array_rand($opsi)];
                }

                Nilai::create([
                    'user_id' => $nilai->user_id,
                    'modul_id' => $nilai->modul_id,
                    'jumlah_benar' => $jumlah_benar,
                    'skor' => $skor,
                    'list_jawaban' => $list_jawaban,
                    // Buat tanggalnya bertahap maju agar tercatat sebagai percobaan terbaru
                    'created_at' => now()->addHours(($i + 1) * 2), 
                    'updated_at' => now()->addHours(($i + 1) * 2),
                ]);
            }
        }

        $this->command->info('Data dummy remedial (Percobaan ke-2, ke-3, dst) berhasil ditambahkan ke beberapa siswa acak!');
    }
}
