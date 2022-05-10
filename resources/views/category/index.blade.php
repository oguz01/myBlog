@extends('main_layouts.master')
@section('title', 'OguzSoft | Kategori')
@section('orta')
    <div class="colorlib-blog">
        <div class="container">
            <div class="row">
                <!--======== Yazılar Başlangış =====-->
                <div class="col-md-12 posts-col">
                    @forelse ($categories as $category)
                        <div class="col-md-4 card">
                            <div class="block-21 card-body" style="margin-bottom: auto;">
                                <div class="text w-100" style="border:none; padding:10px">
                                    <h3 class="heading">
                                        <a href="{{ route('category.show', $category) }}">{{ $category->name }}</a>
                                    </h3>
                                    <div class="meta">
                                        <div>
                                            <a href="#" class="date">
                                                <span class="icon-calendar"></span>
                                                {{ $category->created_at->diffForHumans() }}
                                            </a>
                                        </div>
                                        <div>
                                            <a href="#"><span class="icon-user2"></span>
                                                {{-- {{ $category->user->name }} --}}
                                            </a>
                                        </div>
                                        <div class="posts_count">
                                            <a href="{{ route('category.show', $category) }}">
                                                <span class="icon-tag"></span>
                                                {{ $category->posts_count }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="lead">Gösterilecek Kategori Bulunmamaktadır.</p>
                    @endforelse
                </div>
                {{ $categories->links() }}
                <!--======== Yazılar Bitiş =====-->

            </div>
        </div>
    </div>
@endsection
