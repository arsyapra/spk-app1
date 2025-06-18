<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    public function test_user_can_login_and_see_dashboard()
    {
        $user = User::factory()->create([
          'password' => bcrypt('secret123')
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret123')
                    ->press('Sign in')
                    ->assertPathIs('/dashboard')
                    ->assertSee('Welcome');
        });
    }
}
