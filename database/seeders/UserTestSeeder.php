<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $password = Hash::make('password');

        // 1. Create Admins
        User::create([
            'name' => 'Administrator Utama',
            'username' => 'admin',
            'email' => 'admin@smarexam.com',
            'password' => $password,
            'role' => 'admin',
        ]);
        
        User::create([
            'name' => 'Administrator Kedua',
            'username' => 'admin2',
            'email' => 'admin2@smarexam.com',
            'password' => $password,
            'role' => 'admin',
        ]);

        // Daftar Jurusan yang akan dibuat
        $jurusansData = [
            ['nama' => 'Rekayasa Perangkat Lunak', 'kode' => 'RPL'],
            ['nama' => 'Teknik Komputer dan Jaringan', 'kode' => 'TKJ'],
            ['nama' => 'Desain Komunikasi Visual', 'kode' => 'DKV'],
            ['nama' => 'Manajemen Perkantoran dan Layanan Bisnis', 'kode' => 'MPLB'],
            ['nama' => 'Akuntansi dan Keuangan Lembaga', 'kode' => 'AKL'],
        ];

        foreach ($jurusansData as $jurusanData) {
            $jurusan = Jurusan::create($jurusanData);

            // 2. Create 2 Guru for each Jurusan
            $gurus = [];
            for ($g = 1; $g <= 2; $g++) {
                $guru = User::create([
                    'name' => $faker->name . ($g == 1 ? ', S.Kom.' : ', M.Pd.'),
                    'username' => strtolower($jurusan->kode) . '_guru' . $g,
                    'email' => strtolower($jurusan->kode) . "_guru$g@guru.id",
                    'password' => $password,
                    'role' => 'guru',
                    'jurusan_id' => $jurusan->id,
                ]);
                $gurus[] = $guru;
            }

            // 3. Create 2 Kelas for each Jurusan
            for ($k = 1; $k <= 2; $k++) {
                $kelas = Kelas::create([
                    'nama' => 'XII ' . $jurusan->kode . ' ' . $k,
                    'jurusan_id' => $jurusan->id
                ]);

                // 4. Create 10 Siswa for each Kelas
                for ($s = 1; $s <= 10; $s++) {
                    $asesor = $gurus[array_rand($gurus)]; // Randomly assign one of the 2 gurus as asesor
                    
                    User::create([
                        'name' => $faker->name,
                        'username' => strtolower($jurusan->kode) . strtolower($k) . '_siswa' . $s,
                        'email' => strtolower($jurusan->kode) . strtolower($k) . "_siswa$s@siswa.id",
                        'password' => $password,
                        'role' => 'siswa',
                        'jurusan_id' => $jurusan->id,
                        'kelas_id' => $kelas->id,
                        'asesor_id' => $asesor->id,
                    ]);
                }
            }
        }

        $this->command->info('Data dummy untuk Admin, Jurusan, Kelas, Guru, dan Siswa berhasil dibuat!');
    }
}
