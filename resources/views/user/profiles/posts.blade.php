@extends('layouts.app')

@section('title', $user->name . "'s Posts")

@section('content')
    @include('user.profiles.header')

    <div class="row">
        @forelse ($user->posts as $post)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
                    @if($post->image)
                        <img src="{{ asset('storage/posts/' . $post->image) }}" 
                             alt="{{ $post->description }}" 
                             class="grid-img">
                    @else
                        <div class="grid-img bg-secondary text-white d-flex align-items-center justify-content-center">
                            <span>No Image</span>
                        </div>
                    @endif
                </a>
            </div>
        @empty
            <div class="col-12">
                <h4 class="h5 text-center text-secondary">No posts yet.</h4>
            </div>
        @endforelse
    </div>
@endsection