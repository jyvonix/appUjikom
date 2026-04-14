<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Modul;
use App\Models\Nilai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AsesorTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat 3 Asesor (Guru)
        $asesors = [];
        for ($i = 1; $i <= 3; $i++) {
            $asesors[] = User::create([
                'name' => "Asesor $i (Guru)",
                'username' => "asesor$i",
                'email' => "asesor$i@smarexam.com",
                'password' => Hash::make('password'),
                'role' => 'guru',
                'jurusan' => 'RPL',
            ]);
        }

        // 2. Buat Modul Ujian dummy
        $modul = Modul::create([
            'user_id' => $asesors[0]->id, // Asesor 1 yang buat modul
            'nama' => 'Ujian Kompetensi Keahlian (UKK)',
            'deskripsi' => 'Modul pengujian dummy untuk mengetes fitur asesor.',
            'jurusan' => 'RPL',
            'waktu' => 60,
            'is_active' => true,
        ]);

        // 3. Buat Siswa untuk masing-masing Asesor
        foreach ($asesors as $index => $asesor) {
            $asesorNum = $index + 1;
            
            for ($j = 1; $j <= 2; $j++) {
                $siswaNum = ($index * 2) + $j;
                
                $siswa = User::create([
                    'name' => "Siswa $siswaNum (Asuhan Asesor $asesorNum)",
                    'username' => "siswa$siswaNum",
                    'email' => "siswa$siswaNum@smarexam.com",
                    'password' => Hash::make('password'),
                    'role' => 'siswa',
                    'jurusan' => 'RPL',
                    'asesor_id' => $asesor->id,
                ]);

                // 4. Buat Nilai dummy untuk siswa ini
                Nilai::create([
                    'user_id' => $siswa->id,
                    'modul_id' => $modul->id,
                    'jumlah_benar' => rand(5, 10),
                    'skor' => rand(70, 100),
                    'list_jawaban' => ['q1' => 'A', 'q2' => 'B'],
                ]);
            }
        }

        echo "Seeding selesai! Anda bisa login dengan:\n";
        echo "Username: asesor1, asesor2, asesor3\n";
        echo "Password: password\n";
    }
}
