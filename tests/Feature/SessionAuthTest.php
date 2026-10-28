<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SessionAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_header_shows_login_and_register_buttons_when_no_token()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        preg_match('/<header.*?<\/header>/s', $response->getContent(), $matches);
        $header = $matches[0];
        $this->assertStringContainsString('Iniciar sesión', $header);
        $this->assertStringContainsString('Crear cuenta', $header);
        $this->assertStringNotContainsString('Cerrar sesión', $header);
    }

    public function test_login_page_renders_successfully()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Iniciar Sesión');
        $response->assertSee('Correo electrónico');
        $response->assertSee('Contraseña');
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $user = User::create([
            'name' => 'Carlos Perez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'carlos@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertNull(session('token'));
    }

    public function test_login_success_stores_token_and_name_in_session()
    {
        $user = User::create([
            'name' => 'Carlos Perez',
            'email' => 'carlos@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'carlos@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('token');
        $response->assertSessionHas('name', 'Carlos Perez');
    }

    public function test_header_shows_greeting_and_logout_button_when_token_in_session()
    {
        $response = $this->withSession([
            'token' => 'test-token-12345',
            'name' => 'Carlos Perez',
        ])->get(route('home'));

        $response->assertStatus(200);
        preg_match('/<header.*?<\/header>/s', $response->getContent(), $matches);
        $header = $matches[0];
        $this->assertStringContainsString('Hola, Carlos Perez', $header);
        $this->assertStringContainsString('Cerrar sesión', $header);
        $this->assertStringNotContainsString('Iniciar sesión', $header);
        $this->assertStringNotContainsString('Crear cuenta', $header);
    }

    public function test_logout_clears_session_and_redirects_to_login()
    {
        $response = $this->withSession([
            'token' => 'active-token-999',
            'name' => 'Carlos Perez',
        ])->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertNull(session('token'));
        $this->assertNull(session('name'));
    }

    public function test_register_creates_user_and_redirects_to_login()
    {
        $response = $this->post(route('register.post'), [
            'name' => 'Ana Gomez',
            'email' => 'ana@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'email' => 'ana@example.com',
            'name' => 'Ana Gomez',
        ]);
    }
}
