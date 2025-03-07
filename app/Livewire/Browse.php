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
        $posts = Post::where('isApproved', true) // Ensure only approved posts are retrieved
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate($this->perPage);


        return view('livewire.browse', ['posts' => $posts]);
    }
}
