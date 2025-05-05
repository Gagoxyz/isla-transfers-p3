<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Corporative;
use GuzzleHttp\Promise\Coroutine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Mostramos el formulario de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesamos el login
    public function logIn(Request $request)
    {
        $request->validate([
            'inputEmail' => 'required|email', // Validación para un dato tipo "email"
            'inputPassword' => 'required|min:4', // Mínimo de 4 caracteres
            'user_type' => 'required|in:1,2,3', // Validación para tipo de usuario
        ]);

        // Obtener los datos del formulario
        $email = $request->input('inputEmail');
        $password = $request->input('inputPassword');
        $user_type = $request->input('user_type');

        switch ($user_type) {
            case "1": // Cliente
                $user = User::where('email', $email)->first();

                if ($user && Hash::check($password, $user->password)){
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['id_viajero'] = $user->id;
                    $_SESSION['rol'] = 'cliente';

                    return redirect()->route('customerPanel');
                } else {
                    return redirect()->route('login')->with('error', 'Email o contraseña incorrectos');
                }
                break;

            case "2": // Hotel
                $user = Corporative::where('email_hotel', $email)->first();

                if ($user && Hash::check($password, $user->password)){
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['id_hotel'] = $user->id;
                    $_SESSION['rol'] = 'corporativo';

                    return redirect()->route('customerPanel');
                } else {
                    return redirect()->route('login')->with('error', 'Email o contraseña incorrectos');
                }
                break;

            case "3": // Administrador
                $user = Admin::where('email', $email)->first(); // Necesitaríamos un modelo Admin
                break;

            default:
                return redirect()->route('login')->withErrors(['error' => 'Tipo de usuario no válido']);
        }

        if ($user && Hash::check($password, $user->password)) {
            // Iniciar sesión
            session(['email' => $email, 'id_user' => $user->id, 'role' => $user_type]);
            return redirect()->route('dashboard'); // Redirigir según el tipo de usuario
        }

        return redirect()->route('login')->withErrors(['error' => 'Email o contraseña incorrectos']);
    }
}
