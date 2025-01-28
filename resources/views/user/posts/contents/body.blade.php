<div class="row align-items-center">
    <div class="col-auto">
        {{-- like/heart button --}}
        @if($post->isLiked())
            {{-- red heart /unlike --}}
            <form action="{{ route('like.delete', $post->id)}}" method="post">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn p-0">
                    <i class="fa-solid fa-heart text-danger"></i>
                </button>
            </form>
        @else
            <form action="{{ route('like.store', $post->id)}}" method="post">
                @csrf 
                <button type="submit" class="btn p-0">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>
        @endif 
    </div>
    <div class="col-auto px-0">
        {{-- no. of likes --}}
        @if($post->likes->count() > 0)
            <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#likes-post{{ $post->id }}">
                {{ $post->likes->count() }}
            </button>
            @include('user.posts.contents.modals.likes')
        @else 
            0
        @endif 
    </div>
    <div class="col text-end">
        {{-- categories --}}
        @forelse($post->categoryPosts as $category_post)
            <div class="badge bg-secondary bg-opacity-50">
                {{ $category_post->category->name }}
            </div>
        @empty 
            <div class="badge bg-dark">Uncategorized</div>
        @endforelse
    </div>
</div>

{{-- owner and description --}}
<a href="{{ route('profile.show', $post->user->id)}}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
&nbsp;
<span class="fw-light">{{ $post->description }}</span>
<p class="text-muted text-uppercase xsmall">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
