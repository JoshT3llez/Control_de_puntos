<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/valvulas';

    public function __construct(){
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            return redirect($this->redirectTo)->with('success', '¡Bienvenido de nuevo!');
        }
    
        return redirect()->route('login')->with('error', 'Correo o contraseña incorrectos.');
    }
    
}
