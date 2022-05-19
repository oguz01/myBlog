<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // $posts = Post::all();
        $posts = Post::withCount('comments')->latest()->paginate(5);
        $recent_posts = Post::latest()->take(5)->get();
        $categories = \App\Models\Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $tags = \App\Models\Tag::latest()->take(50)->get();
        return view('home', [
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}
