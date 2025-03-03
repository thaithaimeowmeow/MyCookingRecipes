<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Browse extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';  // <-- Add search property
    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->perPage = 5;
    }


    public function render()
    {
        $posts = Post::where('name', 'like', '%' . $this->search . '%') // Search by name
            ->orWhere('description', 'like', '%' . $this->search . '%') // Search by description
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.browse', ['posts' => $posts]);
    }
}
