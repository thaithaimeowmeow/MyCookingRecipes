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
        $posts = Post::where('isApproved', true)
            ->latest()
            ->paginate($this->perPage);

        $mostLiked = Post::where('isApproved', true)
            ->withCount('likers')
            ->orderByDesc('likers_count')
            ->take(6)
            ->get();

        $trending = Post::where('isApproved', true)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('livewire.homepage', [
            'posts' => $posts,
            'mostLiked' => $mostLiked,
            'trending' => $trending,
        ]);
    }
}
