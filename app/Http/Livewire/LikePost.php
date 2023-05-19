<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;
    public $likes;

    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user()); //mount es un constructor que revisa si el usuario ya le dio me gusta
        $this->likes = $post->likes->count(); //contador de likes
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) { //si el usuario ya le dio me gusta
            $this->post->likes()->where('post_id', $this->post->id)->delete(); //eliminar el like
            $this->isLiked = false; //se dibuja el corazon en blanco
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true; //se dibuja el corazon en rojo
            $this->likes++;
        }
    }


    public function render()
    {
        return view('livewire.like-post');
    }
}
