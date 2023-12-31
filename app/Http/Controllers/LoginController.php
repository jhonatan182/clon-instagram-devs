<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        return view('auth.login');
    }


    public function store(Request $request)
    {

        //validando los datos
        $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        //verficar si las credenciales son correctas
        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {

            // va a retrocer a la ruta donde venian los datos
            // pero con la diferencia de que va con un error
            return back()->with('mensaje', 'Las credenciales no son correctas');
        }

        return redirect()->route('posts.index', Auth::user()->username);
    }
}
