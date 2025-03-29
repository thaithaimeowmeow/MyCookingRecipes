<?php

namespace App\Livewire\Profile;

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast;
    public $user;
    public $username;

    public function deletePostWithID($id)
    {
        $post = Post::findOrFail($id);
        if($post->user->id == auth()->user()->id)
        {
            (new PostController())->deletePost($id);
            return $this->success('Action finished!');
        }
        else
        {
            return $this->warning('Action failed.');
        }
    }

    public function mount()
    {
        $this->user = User::where('username', $this->username)
            ->with(['posts'])
            ->firstOrFail();
       
    }
    public function render()
    {
        return view('livewire.profile.index');
    }
}
