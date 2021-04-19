<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UsersCanSearchPokemonTest extends DuskTestCase
{
  use DatabaseMigrations;
  
  /** @test */
  public function users_can_search_pokemon()
  {
    $user = User::factory()->create();
    
    $this->browse(function (Browser $browser) use ($user) {
      $browser->loginAs($user)
      ->visit('/home')
      ->type('@pokemon', 'mew')
      ->press('@search')
      ->waitForText('Mew info')
      ->assertSee('Mew info');
    });
  }
}
