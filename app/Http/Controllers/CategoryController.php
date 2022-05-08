<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
    }

    public function show(Category $category)
    {
        $recent_posts = \App\Models\Post::latest()->take(5)->get();
        $categories = \App\Models\Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)->get();
        $tags = \App\Models\Tag::latest()->take(50)->get();

        return view('category.show',[
            'category' => $category,
            'posts' => $category->posts()->paginate(5),
            'recent_posts'=>$recent_posts,
            'categories'=>$categories,
            'tags'=>$tags
        ]);
    }
}
