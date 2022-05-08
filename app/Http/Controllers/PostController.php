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
        return view('post', compact('post', 'recent_posts', 'categories', 'tags'));
    }

    public function addComment(Post $post)
    {
        $attributes = request()->validate([
            'the_comment' => 'required|min:5|max:300'
        ]);

        $attributes['user_id'] = auth()->id();
        $comment = $post->comments()->create($attributes);
        return redirect('/yazi-detay/' . $post->slug . '#comment_' . $comment->id)->with('success', 'Yorumunuz Başarıyla Kayıt Edildi...');
    }
}
