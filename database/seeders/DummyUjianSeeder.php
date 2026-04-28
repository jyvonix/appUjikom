<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Modul;
use App\Models\Soal;
use App\Models\User;
use App\Models\Nilai;
use Illuminate\Support\Str;

class DummyUjianSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = Jurusan::all();
        $opsi = ['A', 'B', 'C', 'D', 'E'];
        $faker = \Faker\Factory::create('id_ID');

        foreach ($jurusans as $jurusan) {
            // Dapatkan guru pertama untuk jurusan ini sebagai pembuat soal
            $guru = User::where('role', 'guru')->where('jurusan_id', $jurusan->id)->first();
            
            if (!$guru) {
                continue;
            }

            // 1. Create 1 Modul Ujian for this Jurusan
            $modul = Modul::create([
                'nama' => 'Ujian Kompetensi Keahlian - ' . $jurusan->kode,
                'tipe' => 'ujikom',
                'token' => Str::upper(Str::random(6)),
                'deskripsi' => 'Ujian akhir untuk mengukur kompetensi keahlian siswa jurusan ' . $jurusan->nama,
                'waktu' => 120, // 120 menit
                'start_time' => now()->subDays(1),
                'end_time' => now()->addDays(7),
                'is_active' => true,
                'user_id' => $guru->id,
                'kkm' => 75,
                'point_per_question' => 10,
                'score_divisor' => 1,
                'is_random' => true,
                'show_result' => true,
                'jurusan_id' => $jurusan->id,
            ]);

            // 2. Create 10 Soal for this Modul
            for ($i = 1; $i <= 10; $i++) {
                Soal::create([
                    'modul_id' => $modul->id,
                    'pertanyaan' => 'Pertanyaan No. ' . $i . ' untuk ujian ' . $jurusan->kode . ': ' . $faker->sentence(),
                    'opsi_a' => 'A. ' . $faker->words(3, true),
                    'opsi_b' => 'B. ' . $faker->words(3, true),
                    'opsi_c' => 'C. ' . $faker->words(3, true),
                    'opsi_d' => 'D. ' . $faker->words(3, true),
                    'opsi_e' => 'E. ' . $faker->words(3, true),
                    'jawaban_benar' => $opsi[array_rand($opsi)],
                    'kategori' => 'Umum',
                    'kesulitan' => rand(1, 3), // 1: Mudah, 2: Sedang, 3: Sulit
                    'user_id' => $guru->id,
                    'jurusan_id' => $jurusan->id,
                ]);
            }

            // 3. Create Nilai (Hasil Ujian) for every Siswa in this Jurusan
            $siswas = User::onlySiswa()->where('jurusan_id', $jurusan->id)->get();

            foreach ($siswas as $siswa) {
                // Random jumlah benar antara 4 sampai 10
                $jumlah_benar = rand(4, 10);
                $skor = $jumlah_benar * 10; // Point per soal adalah 10
                
                // Mock list jawaban
                $list_jawaban = [];
                $soals_for_this_modul = Soal::where('modul_id', $modul->id)->get();
                foreach ($soals_for_this_modul as $soal) {
                    $list_jawaban[$soal->id] = $opsi[array_rand($opsi)];
                }

                Nilai::create([
                    'user_id' => $siswa->id,
                    'modul_id' => $modul->id,
                    'jumlah_benar' => $jumlah_benar,
                    'skor' => $skor,
                    'list_jawaban' => $list_jawaban,
                ]);
            }
        }

        $this->command->info('Data dummy untuk Modul (Ujian), Soal, dan Nilai berhasil ditambahkan ke setiap Jurusan dan Siswa!');
    }
}
