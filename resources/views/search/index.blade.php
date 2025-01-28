@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="h4 text-muted mb-4">Search results for '<span class="fw-bold">{{ $search }}</span>'</h3>
    
    @if($posts->isNotEmpty())
        <div class="row">
            @foreach($posts as $post)
                <div class="col-4 mb-3">
                    <div class="card h-100">
                        @if($post->image)
                            <img src="{{ $post->image }}" class="card-img-top" alt="Post image">
                        @endif
                        <div class="card-body">
                            <div class="mb-2">
                                @foreach($post->categoryPosts as $category_post)
                                    <span class="badge bg-secondary">{{ $category_post->category->name }}</span>
                                @endforeach
                            </div>
                            <p class="card-text">{{ $post->description }}</p>
                            <p class="small text-muted">Posted by: {{ $post->user->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    @else
        <p>No results found.</p>
    @endif
</div>
@endsection