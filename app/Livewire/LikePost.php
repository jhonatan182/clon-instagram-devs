<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public bool $isLike;
    public int $likes;


    public function mount($post)
    {

        $this->isLike = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLike = false;
            $this->likes--;
        } else {

            $userId = Auth::user()->id;
            $postId = $this->post->id;

            //cuando hay relacion establecidas en el modelo
            $this->post->likes()->create([
                'post_id' => $postId,
                'user_id' => $userId,
            ]);
            $this->isLike = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
