@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            {{-- Search Bar --}}
            <div class="mb-3">
                <form action="{{ route('suggested.users') }}" method="GET">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search names..." 
                           value="{{ request('search') }}">
                </form>
            </div>

            <h4 class="h5 text-muted mb-3">Suggested</h4>

            {{-- Suggested Users List --}}
            @foreach($suggested_users as $user)
                <div class="row align-items-center mb-3 bg-white p-3 rounded shadow-sm">
                    {{-- Avatar --}}
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id) }}">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-md">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </a>
                    </div>

                    {{-- User Info --}}
                    <div class="col">
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none">
                            <h6 class="mb-0 text-dark">{{ $user->name }}</h6>
                        </a>
                        <p class="text-muted mb-0 small">{{ $user->email }}</p>
                        <p class="text-muted mb-0 small">
                            @if($user->isFollowing(Auth::user()))
                                Follows you
                            @else
                                @if($user->followersCount() > 0)
                                    {{ $user->followersCount() }} followers
                                @else
                                    No followers yet
                                @endif
                            @endif
                        </p>
                    </div>

                    {{-- Follow Button --}}
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn p-0 bg-transparent text-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection