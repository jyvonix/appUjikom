<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Jurusans
        $rpl = Jurusan::create(['nama' => 'Rekayasa Perangkat Lunak', 'kode' => 'RPL']);
        $mplb = Jurusan::create(['nama' => 'Manajemen Perkantoran dan Layanan Bisnis', 'kode' => 'MPLB']);

        // 2. Create Kelas
        $rpl12 = Kelas::create(['nama' => 'XII RPL 1', 'jurusan_id' => $rpl->id]);
        $mplb12 = Kelas::create(['nama' => 'XII MPLB 1', 'jurusan_id' => $mplb->id]);

        // 3. Create Admin
        User::create([
            'name' => 'Administrator Utama',
            'username' => 'admin',
            'email' => 'admin@smarexam.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 4. Create Gurus
        $guruRpl = User::create([
            'name' => 'Budi Santoso, S.Kom.',
            'username' => 'budi',
            'email' => 'budi@guru.id',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'jurusan_id' => $rpl->id,
        ]);

        $guruMplb = User::create([
            'name' => 'Siti Aminah, M.Pd.',
            'username' => 'siti',
            'email' => 'siti@guru.id',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'jurusan_id' => $mplb->id,
        ]);

        // 5. Create Siswas
        // RPL Students
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Siswa RPL $i",
                'username' => "siswa_rpl$i",
                'email' => "siswa_rpl$i@siswa.id",
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'jurusan_id' => $rpl->id,
                'kelas_id' => $rpl12->id,
                'asesor_id' => $guruRpl->id,
            ]);
        }

        // MPLB Students
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Siswa MPLB $i",
                'username' => "siswa_mplb$i",
                'email' => "siswa_mplb$i@siswa.id",
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'jurusan_id' => $mplb->id,
                'kelas_id' => $mplb12->id,
                'asesor_id' => $guruMplb->id,
            ]);
        }

        $this->command->info('Professional dummy data created!');
    }
}
