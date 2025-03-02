<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{
    public $post;
    public $slug;

    function toggleLikeFromPost()
    {
        auth()->user()->toggleLike($this->post);
    }


    public function mount()
    {
        $this->post = Post::where('slug', $this->slug)
            ->with(['ingredients', 'steps', 'tags'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.post.index');
    }
}
