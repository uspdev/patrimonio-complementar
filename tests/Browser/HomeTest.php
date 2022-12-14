<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testHomeNotAuth()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Não autenticado');
            $browser->screenshot('home-no-user');
        });
    }

    public function testHomeStdUser()
    {
        $this->browse(function ($browser) {

            $browser->loginAs(SELF::getUser())
                ->visit('/')
                ->assertSee('Meus Patrimônios')
                ->assertDontSee('Buscar por');
            $browser->screenshot('home-user-logged-in');
        });
    }

    public function testHomeAdmin()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(SELF::getUser('admin'))
                ->visit('/')
                ->assertSee('Buscar por');
            $browser->screenshot('home-admin-logged-in');
        });
    }

}
