@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
    <div class="row justify-content-center">
        <div class="col-4">
            <h2 class="h4 text-muted mb-4">Suggested</h2>
            
            @foreach($suggested_users as $user)
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-md">
                        @else 
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none fw-bold text-dark">{{ $user->name }}</a>
                        <span class="d-block text-muted small">{{ $user->email }}</span>
                        <span class="d-block text-muted small">
                            @if($user->followsYou())
                                Follows you
                            @elseif($user->followers->count() == 0)
                                No followers yet
                            @elseif($user->followers->count() == 1)
                                1 follower 
                            @else
                                {{ $user->followers->count() }} followers
                            @endif
                        </span>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $user->id)}}" method="post">
                            @csrf 
                            <button type="submit" class="btn p-0 bg-transparent text-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection