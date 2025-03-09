<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Mary\Traits\Toast;

class Preview extends Component
{
    use Toast;
    public $post;
    public $slug;

   
    public function mount()
    {
        $this->post = Post::where('slug', $this->slug)
            ->with(['ingredients', 'steps', 'tags',])
            ->firstOrFail();
    }
    public function render()
    {
        return view('livewire.post.preview');
    }
}
