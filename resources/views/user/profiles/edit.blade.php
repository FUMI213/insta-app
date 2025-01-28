@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('profile.update')}}" method="post" class="shadow rounded-3 bg-white p-5 mb-5" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')

                <h2 class="h4 text-secondary mb-3">Update Profile</h2>
                <div class="row mb-3">
                    <div class="col-4">
                        {{-- icon/avatar --}}
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle img-lg d-block mx-auto">
                        @else 
                            <i class="fa-solid fa-circle-user text-secondary icon-lg d-block text-center"></i>
                        @endif
                    </div>
                    <div class="col align-self-end">
                        <input type="file" name="avatar" id="" class="form-control form-control-sm w-auto">
                        <p class="mb-0 form-text">
                            Acceptable formats: jpeg, jpg, png, gif only <br>
                            Max file size is 1048 KB 
                        </p>
                        @error('avatar')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="form-control">
                @error('name')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror

                <label for="email" class="form-label fw-bold mt-3">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
                @error('email')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror

                <label for="intro" class="form-label fw-bold mt-3">Introduction</label>
                <textarea name="introduction" id="intro" rows="3" class="form-control">{{ old('introduction', Auth::user()->introduction) }}</textarea>
                @error('introduction')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror

                <button type="submit" class="btn btn-warning mt-3 px-5">Save</button>
            </form>

            {{-- UPDATE PASSWORD --}}
            <form action="{{ route('profile.update-password')}}" method="post" class="shadow rounded-3 bg-white p-5">
                @csrf 
                @method('PATCH')

                @if(session('success_password_change'))
                    <p class="mb-3 text-success fw-bold">{{ session('success_password_change')}}</p>
                @endif

                <h2 class="h4 text-secondary mb-3">Update Password</h2>

                <label for="old-password" class="form-label fw-bold">Old Password</label>
                <input type="password" name="old_password" id="old-password" class="form-control">
                @if(session('wrong_password_error'))
                    <p class="mb-0 text-danger small">{{ session('wrong_password_error') }}</p>
                @endif

                <label for="new-password" class="form-label fw-bold mt-3">New Password</label>
                <input type="password" name="new_password" id="new-password" class="form-control">
                @if(session('same_password_error'))
                    <p class="mb-0 text-danger small">{{ session('same_password_error') }}</p>
                @endif 
                @error('new_password')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror

                <label for="confirm-password" class="form-label mt-3">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="confirm-password" class="form-control">

                <input type="submit" value="Update Password" class="btn btn-warning px-5 mt-3">
            </form>
        </div>
    </div>


@endsection 