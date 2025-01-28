@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
            @if($search)
                <h3 class="h4 text-muted mb-4">Search results for '<span class="fw-bold">{{ $search }}</span>'</h3>
            @endif
            {{-- POSTS --}}
            @forelse($all_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('user.posts.contents.title')
                    {{-- image --}}
                    <div class="container p-0">
                        <a href="{{ route('post.show', $post->id)}}">
                            <img src="{{ $post->image }}" alt="" class="w-100">
                        </a>
                    </div>
                    {{-- body --}}
                    <div class="card-body">
                        @include('user.posts.contents.body')

                        {{-- COMMENTS --}}
                        @if($post->comments->isNotEmpty())
                            <hr class="mt-3 mb-1">

                            @foreach($post->comments->take(3) as $comment)
                                @include('user.posts.contents.comments.list-item')
                            @endforeach

                            @if($post->comments->count() > 3)
                                <a href="{{ route('post.show', $post->id)}}" class="text-decoration-none small mt-2">
                                    View all {{ $post->comments->count() }} comments
                                </a>
                            @endif
                        @endif

                        @include('user.posts.contents.comments.create')
                    </div>
                </div>
            @empty 
                <p class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you share photos, they'll appear on your profile.</p>
                    <a href="{{ route('post.create')}}" class="text-decoration-none">Share your first photo</a>
                </p>
            @endforelse
        </div>

        <div class="col-4">
            {{-- USER INFO --}}
            <div class="row mb-5 bg-white align-items-center shadow-sm rounded-2 py-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id)}}">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle avatar-md">
                        @else 
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif 
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id)}}" class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                    <p class="mb-0 text-secondary">{{ Auth::user()->email }}</p>
                </div>
            </div>

            {{-- SUGGESTED USERS --}}
            @if($suggested_users)
            <div class="row mb-3 align-items-center">
                <div class="col"><h5 class="h6 mb-0 fw-bold text-secondary">Suggestions For You</h5></div>
                <div class="col-auto">
                    <a href="{{ route('suggested.users') }}" class="text-decoration-none fw-bold text-dark">See all</a>
                </div>
            </div>

            @foreach($suggested_users as $user)
                <div class="row mb-3 align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id)}}">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-md">
                            @else 
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif 
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                        <p class="mb-0 text-muted small">
                            @if($user->isFollowing(Auth::user()))
                                Follows you
                            @else
                                @if($user->followers()->count() > 0)
                                    {{ $user->followers()->count() }} followers
                                @else
                                    No followers yet
                                @endif
                            @endif
                        </p>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $user->id)}}" method="post">
                            @csrf 
                            <button type="submit" class="btn p-0 bg-transparent text-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach 
                    @endif
        </div>
    </div>

@endsection