<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // $posts = Post::all();
        $posts = Post::withCount('comments')->get();
        $recent_posts = Post::latest()->take(5)->get();
        return view('home', [
            'posts' => $posts,
            'recent_posts' => $recent_posts
        ]);
    }
}
