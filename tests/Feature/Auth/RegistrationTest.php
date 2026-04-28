<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $jurusan = \App\Models\Jurusan::create(['nama' => 'Rekayasa Perangkat Lunak', 'kode' => 'RPL']);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'jurusan_id' => $jurusan->id,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('siswa.dashboard'));
    }
}
