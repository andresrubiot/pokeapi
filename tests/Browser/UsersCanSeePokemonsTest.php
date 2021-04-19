<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UsersCanSeePokemonsTest extends DuskTestCase
{
  use DatabaseMigrations;
  
  /** @test */
  public function users_can_see_pokemons_at_home()
  {
    $user = User::factory()->create();
    
    $this->browse(function (Browser $browser) use ($user) {
      $browser->loginAs($user)
      ->visit('/home')
      ->assertSee('Pokemon list')
      ->waitForText('Bulbasaur')
      ->assertSee('Bulbasaur')
      ->assertSee('Info')
      ->assertSee('Raticate');
    });
  }
  
  /** @test */
  public function users_can_load_more_pokemons()
  {
    $user = User::factory()->create();
    
    $this->browse(function (Browser $browser) use ($user) {
      $browser->loginAs($user)
      ->visit('/home')
      ->assertSee('Pokemon list')
      ->waitForText('Bulbasaur')
      ->assertSee('Bulbasaur')
      ->assertSee('Info')
      ->assertSee('Raticate')
      ->assertSee('More')
      ->press('@more')
      ->waitForText('Spearow')
      ->assertSee('Spearow')
      ->assertSee('Wigglytuff');
    });
  }
}
