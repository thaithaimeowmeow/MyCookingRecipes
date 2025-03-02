<?php

namespace App\Livewire\Post;

use App\Http\Controllers\CommentController;
use App\Models\Post;
use App\Services\CommentService;
use Livewire\Component;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast;
    public $post;
    public $slug;

    // Comment section
    public $content;
    public bool $commentEditModal = false;
    public $editID;
    //Services
    private $commentService;

    function toggleLikeFromPost()
    {
        auth()->user()->toggleLike($this->post);
    }

    public function postComment()
    {
        $this->validate(['content' => 'required|string|max:500']);
        $this->commentService->createCommentWithPostId($this->post->id, $this->content);
        // (new CommentController())->createCommentWithPostId($this->post->id,$this->content);
        $this->reset('content');
        return $this->success('Action finished!');
    }

    public function editComment($id)
    {
        $this->commentService->editCommentWithId($id,$this->content);
        // (new CommentController())->editCommentWithId($id,$this->content);
        $this->commentEditModal = false;
        $this->reset('content');
        return $this->success('Action finished!');
    }

    public function deleteComment($id)
    {
        $this->commentService->deleteCommentWithId($id);
        // (new CommentController())->deleteCommentWithId($id);
        return $this->success('Action finished!');
    }

    public function setEditID($id,$content)
    {
        $this->editID=$id;
        $this->content = $content;
    }

    public function boot(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function mount()
    {
        $this->post = Post::where('slug', $this->slug)
            ->with(['ingredients', 'steps', 'tags','comments.user'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.post.index');
    }
}
