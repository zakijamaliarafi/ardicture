<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostDetail extends Controller
{
    public function index($post_id)
    {
        $post = Post::where('post_id', $post_id)->first();
        return view('posts.detail', [
            'post' => $post
        ]);
    }
}
