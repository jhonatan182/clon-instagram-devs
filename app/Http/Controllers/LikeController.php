<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $userId = Auth::user()->id;
        $postId = $post->id;

        //cuando hay relacion establecidas en el modelo

        $post->likes()->create([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);

        //cuando no hay relacion aun
        //verificar si un usuario ya le dio like
        // $existePost = Like::where('post_id', $postId)->where('user_id', $userId)->first();

        // if (!$existePost) {
        //     Like::create([
        //         'post_id' => $postId,
        //         'user_id' => $userId,
        //     ]);
        // }




        return redirect()->back();
    }

    public function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        //! no hacer de esta manera porque no meotodo like no existe de esa manera
        //Auth::user()->likes->where('post_id', $post->id)->delete();


        return redirect()->back();
    }
}
