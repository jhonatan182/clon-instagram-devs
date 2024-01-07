<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(User $user)
    {

        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('layouts.dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create(Request $request)
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        //validar el request
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => Auth::user()->id
        // ]);


        //otra forma de crear registros
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = Auth::user()->id;
        // $post->save();

        //otra forma de crear cuando hay relaciones
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => Auth::user()->id
        ]);




        return redirect()->route('posts.index', Auth::user()->username);
    }


    public function show(User $user, Post $post)
    {

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        //eliminando el comentario
        $post->delete();

        //eliminar la imagen 
        $imagen_path = public_path('uploads/' . $post->imagen);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', Auth::user()->username);
    }
}
