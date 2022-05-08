<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
    }

    public function show(Tag $tag)
    {
        $recent_posts = \App\Models\Post::latest()->take(5)->get();
        $categories = \App\Models\Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)->get();
        $tags = \App\Models\Tag::latest()->take(50)->get();

        return view('tags.show',[
            'tag' => $tag,
            'posts' => $tag->posts()->paginate(10),
            'recent_posts'=>$recent_posts,
            'categories'=>$categories,
            'tags'=>$tags

        ]);
    }
}
