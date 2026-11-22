<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_can_see_the_login_form(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('name="username"', false)
            ->assertSee('name="password"', false)
            ->assertSee('name="_token"', false);
    }

    public function test_guests_cannot_access_inicio(): void
    {
        $this->get(route('inicio'))->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_users_can_log_in_and_the_session_id_is_regenerated(): void
    {
        $user = User::factory()->create();
        $this->withSession(['marker' => 'retained']);
        $previousSessionId = session()->getId();

        $this->post(route('login.store'), [
            'username' => $user->username,
            'password' => 'password',
        ])->assertRedirect(route('inicio'));

        $this->assertAuthenticatedAs($user);
        $this->assertNotSame($previousSessionId, session()->getId());
        $this->assertSame('retained', session('marker'));
    }

    public function test_incorrect_passwords_show_an_error_and_only_preserve_the_username(): void
    {
        $user = User::factory()->create();

        $this->from(route('login'))->post(route('login.store'), [
            'username' => $user->username,
            'password' => 'incorrect-password',
        ])->assertRedirect(route('login'))
            ->assertSessionHasErrors('username')
            ->assertSessionHasInput('username', $user->username)
            ->assertSessionMissing('_old_input.password');

        $this->assertGuest();

        $this->withCookie(config('session.cookie'), session()->getId())
            ->get(route('login'))
            ->assertOk()
            ->assertSee('Las credenciales proporcionadas no son correctas.')
            ->assertSee('value="'.$user->username.'"', false);
    }

    public function test_unknown_usernames_cannot_log_in(): void
    {
        $this->from(route('login'))->post(route('login.store'), [
            'username' => 'unknown-user',
            'password' => 'password',
        ])->assertRedirect(route('login'))
            ->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    public function test_username_and_password_are_required(): void
    {
        $this->from(route('login'))->post(route('login.store'), [])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors(['username', 'password']);

        $this->assertGuest();
        $this->withCookie(config('session.cookie'), session()->getId())
            ->get(route('login'))->assertOk()->assertSee('role="alert"', false);
    }

    public function test_authenticated_users_are_redirected_from_login_to_inicio(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('login'))
            ->assertRedirect(route('inicio'));
    }

    public function test_authenticated_users_can_see_inicio_and_log_out(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('inicio'))
            ->assertOk()
            ->assertSee($user->name)
            ->assertSee('Cerrar sesión');

        $this->withSession(['marker' => 'remove-me', '_token' => 'previous-token']);

        $this->post(route('logout'))
            ->assertRedirect(route('login'))
            ->assertSessionMissing('marker');

        $this->assertGuest();
        $this->assertNotSame('previous-token', session()->token());
        $this->get(route('inicio'))->assertRedirect(route('login'));
    }

    public function test_login_attempts_are_rate_limited(): void
    {
        for ($attempt = 0; $attempt < 6; $attempt++) {
            $this->from(route('login'))->post(route('login.store'), [
                'username' => 'unknown-user',
                'password' => 'incorrect-password',
            ])->assertRedirect(route('login'));
        }

        $this->post(route('login.store'), [
            'username' => 'unknown-user',
            'password' => 'incorrect-password',
        ])->assertStatus(429);

        $this->assertGuest();
    }

    public function test_seeded_users_have_usernames_and_the_demo_user_can_log_in(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users', ['username' => 'admin']);
        $this->assertNotEmpty(User::where('email', 'test@example.com')->firstOrFail()->username);

        $this->post(route('login.store'), [
            'username' => 'admin',
            'password' => '12345678',
        ])->assertRedirect(route('inicio'));

        $this->assertAuthenticatedAs(User::where('username', 'admin')->firstOrFail());
    }
}
