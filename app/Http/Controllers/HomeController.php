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
        //dd($posts);
        return view('home', ['posts' => $posts]);
    }
}
