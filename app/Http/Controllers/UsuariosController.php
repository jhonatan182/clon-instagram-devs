<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{

    public function index(Request $request)
    {

        $seguidoresUserIds = Auth::user()->followings->pluck('id')->toArray();
        array_push($seguidoresUserIds, Auth::user()->id);

        //listar los usuarios que no seguimos
        $usuariosSinSeguir = User::whereNotIn('id', $seguidoresUserIds)->get();

        return view('usuarios.index', [
            'users' => $usuariosSinSeguir
        ]);
    }
}
