<div class="modal fade" id="likes-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button data-bs-dismiss="modal" class="btn btn-sm ms-auto text-primary fw-bold">X</button>
            </div>
            <div class="modal-body px-5">
                <div class="w-75 mx-auto">
                    @foreach($post->likes as $like)
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                @if($like->user->avatar)
                                    <img src="{{ $like->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                @else 
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif 
                            </div>
                            <div class="col text-truncate">
                                <a href="{{ route('profile.show', $like->user_id)}}" class="text-decoration-none text-dark fw-bold">
                                    {{ $like->user->name }}
                                </a>
                            </div>
                            <div class="col-auto">
                                @if($like->user->id != Auth::user()->id)
                                    @if($like->user->isFollowed())
                                        {{-- unfollow --}}
                                        <form action="{{ route('follow.delete', $like->user->id)}}" method="post">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0 bg-transparent text-secondary">Unfollow</button>
                                        </form>
                                    @else 
                                        {{-- follow --}}
                                        <form action="{{ route('follow.store', $like->user->id)}}" method="post">
                                            @csrf 
                                            <button type="submit" class="btn p-0 bg-transparent text-primary">Follow</button>
                                        </form>
                                    @endif
                                @endif 
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>