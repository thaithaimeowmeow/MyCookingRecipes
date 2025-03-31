<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Browse extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';  // <-- Add search property
    public $selectedTag = '';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedTag()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->selectedTag = request()->get('selectedTag', ''); 
    }

    public function render()
    {
        $tags = Tag::all();

        $posts = Post::where('isApproved', true)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedTag, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->where('slug', $this->selectedTag);
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.browse', [
            'posts' => $posts,
            'tags' => $tags,
        ]);
    }
}
