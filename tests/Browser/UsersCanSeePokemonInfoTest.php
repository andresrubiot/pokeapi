<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UsersCanSeePokemonInfoTest extends DuskTestCase
{
  use DatabaseMigrations;

  /** @test */
  public function users_can_see_pokemon_info()
  {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
      $browser->loginAs($user)
      ->visit('/home')
      ->assertSee('Pokemon list')
      ->waitForText('Bulbasaur')
      ->assertSee('Bulbasaur')
      ->press('@bulbasaur-info')
      ->waitForText('Bulbasaur info')
      ->assertSee('Bulbasaur info');
    });
  }
}
