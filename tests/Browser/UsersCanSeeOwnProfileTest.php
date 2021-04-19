<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UsersCanSeeOwnProfileTest extends DuskTestCase
{
  use DatabaseMigrations;

  /** @test */
  public function user_can_see_own_profile()
  {
    $user = User::factory()->create([
      'name' => 'Test user',
      'email' => 'test@pokeapi.app'
    ]);

    $this->browse(function (Browser $browser) use ($user) {
      $browser->loginAs($user)
      ->visit('/profile')
      ->assertSee('Test user')
      ->assertSee('test@pokeapi.app');
    });
  }

  /** @test */
  public function users_can_update_own_profile()
  {
    $user = User::factory()->create([
      'name' => 'Test user',
      'email' => 'test@pokeapi.app'
    ]);

    $this->browse(function (Browser $browser) use ($user) {
      $browser->loginAs($user)
      ->visit('/profile')
      ->assertSee('Test user')
      ->waitForText('test@pokeapi.app')
      ->assertSee('test@pokeapi.app')
      ->type('name', 'Updated name')
      ->type('email', 'updated@pokeapi.app')
      ->type('address', 'Ibagué 321')
      ->type('birthdate', '30/01/2000')
      ->press('@update-btn')
      ->waitForText('Updated name')
      ->assertSee('Updated name');
    });
  }
}
