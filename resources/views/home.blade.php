@extends('main_layouts.master')
@section('title', 'OguzSoft | Ana Sayfa')
@section('orta')
    <div class="colorlib-blog">
        <div class="container">
            <div class="row">

                <!--======== Yazılar Başlangış =====-->
                <div class="col-md-8 posts-col">
                    @forelse ($posts as $post)
                        <div class="block-21 d-flex animate-box">
                            <a href="#" class="blog-img"
                                style="background-image: url({{ asset('storage/' . $post->image->path) }});"></a>
                            <div class="text">
                                <h3 class="heading">
                                    <a href="#">{{ $post->title }}</a>
                                </h3>
                                <p class="excerpt">{{ $post->excerpt }}</p>
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
                                        <a href="#">
                                            <span class="icon-chat"></span>
                                            {{ $post->comments_count }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="lead">Gösterilecek Yazı Bulunmamaktadır.</p>
                    @endforelse
                    {{ $posts->links() }}
                </div>
                <!--======== Yazılar Bitiş =====-->

                <!--======== SideBar Başlangıç =====-->
                <div class="col-md-4 animate-box">
                    <div class="sidebar">
                        <div class="side">
                            <h3 class="sidebar-heading">Kategoriler</h3>
                            <div class="block-24">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="#">{{ $category->name }}
                                                <span>{{ $category->posts_count }}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="side">
                            <h3 class="sidebar-heading">Son Yazılar</h3>
                            @foreach ($recent_posts as $recent_post)
                                <div class="f-blog">
                                    <a href="blog.html" class="blog-img"
                                        style="background-image: url({{ asset('storage/' . $recent_post->image->path) }});">
                                    </a>
                                    <div class="desc">
                                        <p class="admin">
                                            <span>{{ $recent_post->created_at->diffForHumans() }}</span>
                                        </p>
                                        <h2><a href="">{{ Str::limit($recent_post->title, 20, '...') }} </a></h2>
                                        <p>{{ $recent_post->excerpt }}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="side">
                            <h3 class="sidbar-heading">Etiketler</h3>
                            <div class="block-26">
                                <ul>
                                    @foreach ($tags as $tag)
                                        <li><a href="#">{{ $tag->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--======== SideBar Bitiş =====-->

            </div>
        </div>
    </div>
@endsection
