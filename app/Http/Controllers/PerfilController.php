<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


	public function index(Request $request, User $user)
	{
		if ($user->id === Auth::user()->id) {

			return view('perfil.index');
		}


		return redirect()->route('perfil.index', [Auth::user()->username]);
	}


	public function store(Request $request, User $user)
	{
		//modificar el request
		$request->request->add([
			'username' => Str::slug($request->username, '-')
		]);


		$request->validate(['username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:30', 'not_in:twitter,editar-perfil']]);


		if ($request->imagen) {

			$imagen = $request->file('imagen');
			$nombreImagen = Str::uuid() . "." . $imagen->extension();
			$imagenServidor = Image::make($imagen);
			$imagenPath = storage_path('app/public/perfiles') . '/' . $nombreImagen;
			$imagenServidor->save($imagenPath);

			//buscar la imagen anterior del usuario
			$usuarioImagen = User::find(Auth::user()->id);

			//eliminar la imagen 
			$imagen_path = public_path('perfiles/' . $usuarioImagen->imagen);

			if (File::exists($imagen_path) && $usuarioImagen->imagen) {
				unlink($imagen_path);
			}
		}

		//guardar cambios
		$usuario = User::find(Auth::user()->id);
		$usuario->username = $request->username;
		$usuario->imagen = $nombreImagen ?? Auth::user()->imagen ?? '';

		$usuario->save();

		//redireccionar
		return redirect()->route('posts.index', $usuario->username);
	}
}
