@props(['categories'])
<div class="side">
    <h3 class="sidebar-heading">Kategoriler</h3>
    <div class="block-24">
        <ul>
            @foreach ($categories as $category)
                <li><a href="{{ route('category.show', $category) }}">{{ $category->name }}
                        <span>{{ $category->posts_count }}</span></a></li>
            @endforeach
        </ul>
    </div>
</div>
