<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    private $rules = [
        'title' => 'required|max:200',
        'slug' => 'required|max:200',
        'excerpt' => 'required|max:300',
        'category_id' => 'required|numeric',
        'thumbnail' => 'required|file|mimes:jpg,png,svg,webp,jpeg',
        'body' => 'required'
    ];
    // |dimensions:min_width=300,min_height=227
    public function index()
    {
        $posts = Post::with('category')->paginate(5);
        return view('admin_dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Models\Category::pluck('name', 'id');
        return view('admin_dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $post = Post::create($validated);

        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $post->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }
        return redirect()->route('admin.posts.index')->with('success', 'Yazı Başarıyla Kayıt Edildi.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = \App\Models\Category::pluck('name', 'id');
        return view('admin_dashboard.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->rules['thumbnail'] = 'nullable|file|mimes:jpg,png,svg,webp,jpeg';
        $validated = $request->validate($this->rules);
        $post->update($validated);

        if ($request->has('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $post->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }
        return redirect()->route('admin.posts.edit' , $post)->with('success', 'Yazı Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      $post->delete();
      return redirect()->route('admin.posts.index' , $post)->with('success', 'Yazı Başarıyla Silindi.');

    }
}
