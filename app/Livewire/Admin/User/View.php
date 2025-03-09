<?php

namespace App\Livewire\Admin\User;

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Mary\Traits\Toast;

class View extends Component
{

    use Toast;
    public $user;
    public $username;


    

    public function deletePostWithID($id)
    {
        $post = Post::findOrFail($id);
        (new PostController())->deletePost($id);
        return $this->success('Action finished!');
    }

    public function mount()
    {
        $this->user = User::where('username', $this->username)
            ->with(['posts'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admin.user.view')->layout('components.layouts.admin');
    }
}
