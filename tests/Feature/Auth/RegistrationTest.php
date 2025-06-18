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

    // public function test_new_users_can_register(): void
    // {
    //     $response = $this->post('/register', [
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //     ]);

    //     $this->assertAuthenticated();
    //     $response->assertRedirect(route('dashboard', absolute: false));
    // }
    /** @test */
    public function new_users_can_register_and_are_redirected_to_login()
    {
        $response = $this->post('/register', [
            'name'                  => 'Foo Bar',
            'email'                 => 'foo@example.com',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        // Karena kita tidak auto-login
        $this->assertGuest();                     // pastikan masih guest
        $response
            ->assertRedirect('/login')            // dialihkan ke login
            ->assertSessionHas('success', 'Registrasi berhasil! Silakan login menggunakan email dan password Anda.');
        
        // Dan user sudah tercipta di database
        $this->assertDatabaseHas('users', [
            'email' => 'foo@example.com',
        ]);
}

}
