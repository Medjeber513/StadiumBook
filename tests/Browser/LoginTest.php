<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_example(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Book.Play.Repeat');

        });
    }
    // login Test
    public function test_login_page(): void
    {
        $this->browse(function (Browser $browser) {
    $browser->visit('/')->clickLink('Log in')->assertPathIs('/login');
        });
    }

    public function test_register_page(): void
    {
        $this->browse(function (Browser $browser) {
    $browser->visit('/')->clickLink('Register')->assertPathIs('/register');
        });
    }


    public function test_user_can_be_created() {
        $user = \App\Models\User::create([
        'name' => 'Medjeber',
        'email' => 'medjeber@gmail.com',
        'password'=> bcrypt('password'),
        ]);
    }
}
