<?php

namespace App\Livewire;

use Livewire\Component;

class User extends Component
{
    public $user;

    public function handleShowUser()
    {
        return redirect()->route("posts.index", ['user' => $this->user]);
    }

    public function render()
    {
        return view('livewire.user');
    }
}
