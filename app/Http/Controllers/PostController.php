<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back();
    }
}
