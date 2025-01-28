@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <form action="{{ route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')

        <p class="mb-2 fw-bold">Category <span class="fw-light">(up to 3)</span></p>
        <div>
            @forelse($all_categories as $category)
                <div class="form-check form-check-inline">
                    @if(in_array($category->id, $selected_categories))
                        <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
                    @else
                        <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                    @endif
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @empty 
                <span class="fst-italic">No categories. Please add categories before posting.</span>
            @endforelse
        </div>
        @error('categories')
            <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror

        <label for="description" class="form-label fw-bold mt-3">Description</label>
        <textarea name="description" id="description" rows="3" placeholder="What's on your mind" class="form-control">{{ old('description', $post->description) }}</textarea>
        @error('description')
            <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror

        <label for="image" class="form-label fw-bold mt-3">Image</label>
        <img src="{{ $post->image }}" alt="" class="d-block w-50 img-thumbnail mb-1">
        <input type="file" name="image" id="image" class="form-control w-50">
        <p class="mb-0 form-text">
            Acceptable formats: jpeg, jpg, png, gif only <br>
            Max size is 1048 KB 
        </p>
        @error('image')
            <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn btn-warning mt-4 px-4">Save</button>
    </form>

@endsection