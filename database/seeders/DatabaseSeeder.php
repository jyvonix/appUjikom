<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Guru Pengajar',
            'email' => 'guru@sekolah.id',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        User::factory(5)->create([
            'role' => 'siswa',
        ]);
        
        User::factory()->create([
            'name' => 'Siswa Test',
            'email' => 'siswa@sekolah.id',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
    }
}
