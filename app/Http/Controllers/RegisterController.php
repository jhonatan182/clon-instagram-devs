<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //modificar el request
        $request->request->add([
            'username' => Str::slug($request->username, '-')
        ]);

        //varidaciones
        $request->validate([
            'name' => ['required', 'max:30'],
            'username' => ['required', 'unique:users', 'min:3', 'max:30'],
            "email" => ['required', 'unique:users', 'email', 'max:30'],
            "password" => ['required', 'confirmed']
        ]);



        //almacenar en la base de datos
        $createdUser = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password

        ]);


        //auntenticar al usuario
        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);




        //Redireccionar
        return redirect()->route('posts.index', $createdUser->username);
    }
}
