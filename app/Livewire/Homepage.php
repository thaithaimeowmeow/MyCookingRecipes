<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Homepage extends Component
{
    use WithPagination;

    public $perPage = 5;


    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function render()
    {
        $posts = Post::latest()->paginate($this->perPage);
        return view('livewire.homepage', ['posts' => $posts]);
    }
}
