<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {

        $recent_posts = Post::latest()->take(5)->get();
        $categories = \App\Models\Category::withCount('posts')
                      ->orderBy('posts_count', 'desc')
                      ->take(10)->get();
        $tags = \App\Models\Tag::latest()->take(50)->get();
        return view('post', compact('post','recent_posts','categories','tags'));
    }
}
