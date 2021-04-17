<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
  use RefreshDatabase;

  /** @return array */
  protected function userValidData($overrides = []): array
  {
    return array_merge([
      'name' => 'test user',
      'email' => 'test@pokeapi.app',
      'address' => 'address 123',
      'birthdate' => '1990-01-01',
      'city' => 'Ibagué',
      'password' => 'password',
      'password_confirmation' => 'password',
    ], $overrides);
  }

  /** @test */
  public function users_can_register()
  {
    $this->withoutExceptionHandling();
    
    $this->get(route('register'))->assertSuccessful();

    $response = $this->post(route('register'), $this->userValidData());

    $response->assertRedirect('/home');

    $this->assertDatabaseHas('users', [
      'name' => 'test user',
      'email' => 'test@pokeapi.app',
      'address' => 'address 123',
      'birthdate' => '1990-01-01',
      'city' => 'Ibagué'
    ]);

    $this->assertTrue(
      Hash::check('password', User::first()->password)
    );
  }

  /** @test */
  public function the_name_is_required()
  {
    $response = $this->post(route('register'), $this->userValidData(['name' => null]));

    $response->assertSessionHasErrors('name');
  }

  /** @test */
  public function the_name_must_be_a_string()
  {
    $response = $this->post(route('register'), $this->userValidData(['name' => 123]));

    $response->assertSessionHasErrors('name');
  }

  /** @test */
  public function the_name_must_be_at_least_3_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['name' => 'as']));

    $response->assertSessionHasErrors('name');
  }

  /** @test */
  public function the_name_may_not_be_greater_than_60_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['name' => Str::random(61)]));

    $response->assertSessionHasErrors('name');
  }

  /** @test */
  public function the_email_is_required()
  {
    $response = $this->post(route('register'), $this->userValidData(['email' => null]));

    $response->assertSessionHasErrors('email');
  }

  /** @test */
  public function the_email_must_be_a_valid_email_address()
  {
    $response = $this->post(route('register'), $this->userValidData(['email' => 'invalid']));

    $response->assertSessionHasErrors('email');
  }

  /** @test */
  public function the_email_may_not_be_greater_than_80_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['email' => Str::random(81)]));

    $response->assertSessionHasErrors('email');
  }

  /** @test */
  public function the_email_must_be_unique()
  {
    User::factory()->create(['email' => 'test@pokeapi.app']);

    $response = $this->post(route('register'), $this->userValidData());

    $response->assertSessionHasErrors('email');
  }

  /** @test */
  public function the_address_is_required()
  {
    $response = $this->post(route('register'), $this->userValidData(['address' => null]));

    $response->assertSessionHasErrors('address');
  }

  /** @test */
  public function the_address_must_be_a_string()
  {
    $response = $this->post(route('register'), $this->userValidData(['address' => 123]));

    $response->assertSessionHasErrors('address');
  }

  /** @test */
  public function the_address_must_be_at_least_3_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['address' => 'as']));

    $response->assertSessionHasErrors('address');
  }

  /** @test */
  public function the_address_may_not_be_greater_than_80_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['address' => Str::random(81)]));

    $response->assertSessionHasErrors('address');
  }

  /** @test */
  public function the_birthdate_is_required()
  {
    $response = $this->post(route('register'), $this->userValidData(['birthdate' => null]));

    $response->assertSessionHasErrors('birthdate');
  }

  /** @test */
  public function the_birthdate_must_be_a_valid_date()
  {
    $response = $this->post(route('register'), $this->userValidData(['birthdate' => 'invalid']));

    $response->assertSessionHasErrors('birthdate');
  }

  /** @test */
  public function the_city_is_required()
  {
    $response = $this->post(route('register'), $this->userValidData(['city' => null]));

    $response->assertSessionHasErrors('city');
  }

  /** @test */
  public function the_city_must_be_at_least_3_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['city' => 'as']));

    $response->assertSessionHasErrors('city');
  }

  /** @test */
  public function the_city_may_not_be_greater_than_40_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['city' => Str::random(41)]));

    $response->assertSessionHasErrors('city');
  }

  /** @test */
  public function the_password_is_required()
  {
    $response = $this->post(route('register'), $this->userValidData(['password' => null]));

    $response->assertSessionHasErrors('password');
  }

  /** @test */
  public function the_password_must_be_a_string()
  {
    $response = $this->post(route('register'), $this->userValidData(['password' => 123]));

    $response->assertSessionHasErrors('password');
  }

  /** @test */
  public function the_password_must_be_at_least_8_characters()
  {
    $response = $this->post(route('register'), $this->userValidData(['password' => Str::random(7)]));

    $response->assertSessionHasErrors('password');
  }

  /** @test */
  public function the_password_must_be_confirmed()
  {
    $response = $this->post(route('register'), $this->userValidData([
      'password' => 'password',
      'password_confirmation' => 'other'
    ]));

    $response->assertSessionHasErrors('password');
  }
}
