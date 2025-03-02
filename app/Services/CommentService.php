<?php
namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function createCommentWithPostId($postId, $content)
    {
        $post = Post::findOrFail($postId);

        return Comment::create([
            'content' => $content,
            'user_id' => Auth::id(), // Get authenticated user ID
            'post_id' => $post->id,
        ]);
    }

    public function editCommentWithId($commentId, $content)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->update(['content' => $content]);

        return $comment;
    }

    public function deleteCommentWithId($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        return $comment->delete();
    }
}
