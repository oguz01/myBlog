@extends('main_layouts.master')
@section('title', $tag->name.' Tag | OguzSoft')
@section('orta')
    <div class="colorlib-blog">
        <div class="container">
            <div class="row">
                <!--======== Yazılar Başlangış =====-->
                <div class="col-md-8 posts-col">
                    @forelse ($tag->posts as $post)
                        <div class="block-21 d-flex animate-box">
                            <a href="{{ route('posts.show', $post) }}" class="blog-img"
                                style="background-image: url({{ asset('storage/' . $post->image->path) }});"></a>
                            <div class="text">
                                <h3 class="heading">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h3>
                                <a  href="{{ route('posts.show', $post) }}">
                                    <p class="excerpt text-dark">{{ $post->excerpt }}</p>
                                </a>
                                <div class="meta">
                                    <div>
                                        <a href="#" class="date">
                                            <span class="icon-calendar"></span>
                                            {{ $post->created_at->diffForHumans() }}
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#"><span class="icon-user2"></span>
                                            {{ $post->author->name }}
                                        </a>
                                    </div>
                                    <div class="comments_count">
                                        <a href="{{ route('posts.show', $post) }}">
                                            <span class="icon-chat"></span>
                                            {{ $post->comments_count }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="lead">Bu Etikete Ait Yazı Bulunmamaktadır.</p>
                    @endforelse
                    {{ $posts->links() }}
                </div>
                <!--======== Yazılar Bitiş =====-->
                <!--======== SideBar Başlangıç =====-->
                <div class="col-md-4 animate-box">
                    <div class="sidebar">
                        <x-blog.side-categories :categories="$categories" />
                        <x-blog.recent-posts :recent_posts="$recent_posts" />
                        <x-blog.tags :tags="$tags" />
                    </div>
                </div>
                <!--======== SideBar Bitiş =====-->
            </div>
        </div>
    </div>
@endsection
