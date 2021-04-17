<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanRegisterTest extends DuskTestCase
{
  use DatabaseMigrations;

  /** @test */
  public function users_can_register()
  {
    $this->browse(function (Browser $browser) {
      $browser->visit(route('register'))
      ->type('name', 'test user')
      ->type('email', 'test@pokeapi.app')
      ->type('address', 'address 123')
      ->type('birthdate', '1990-01-01')
      ->type('city', 'Ibagué')
      ->type('password', 'password')
      ->type('password_confirmation', 'password')
      ->press('@register-btn')
      ->assertPathIs('/home')
      ->assertAuthenticated();
    });
  }
}
