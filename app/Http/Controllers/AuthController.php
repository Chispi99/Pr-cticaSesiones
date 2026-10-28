<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Muestra la página principal con el estado de la sesión.
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        // Si ya hay token en sesión, redirigir a inicio
        if (session()->has('token')) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Procesa el inicio de sesión del usuario.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Comprobación de credenciales usando Hash::check
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Las credenciales ingresadas son incorrectas.',
            ])->withInput($request->only('email'));
        }

        // Generar un token único
        $token = Str::random(60);

        // Guardar el token y el nombre en los datos permanentes de la sesión
        session([
            'token' => $token,
            'name' => $user->name,
        ]);

        return redirect()->route('home')->with('success', '¡Bienvenido de nuevo, ' . $user->name . '!');
    }

    /**
     * Muestra el formulario para crear una nueva cuenta.
     */
    public function showRegisterForm()
    {
        if (session()->has('token')) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Procesa el registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'El nombre completo es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', '¡Cuenta creada con éxito! Ya puedes iniciar sesión con tus credenciales.');
    }

    /**
     * Cierra la sesión del usuario invalidando y regenerando el token CSRF.
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Has cerrado la sesión correctamente.');
    }
}
