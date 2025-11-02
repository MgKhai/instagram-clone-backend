@extends('admin.layouts.master')

@section('css_content')
    <style>
        .profile-img {
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 30px;
            height: 30px;
            color: #fff;
            border-radius: 50%;
            padding: 3px;
            font-size: 13px;
            cursor: pointer;
            border: 2px solid #fff;
            background-color: rgba(190, 9, 9, 0.94);
        }

        .form-control {
            border-radius: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="container p-5">
        <form class="mx-auto" style="max-width: 600px;" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-4">
                <h3>My Profile</h3>
                <div class="profile-img position-relative mt-3">
                    <img src="{{ asset(Auth::user()->profile_image == null ? '/defaultImages/defaultProfilePic.webp' : '/profileImages/' . Auth::user()->profile_image) }}"
                        id="output" alt="Profile">

                    <!-- Hidden file input -->
                    <input type="file" name="image" accept="image/*" id="profilePicInput" class="d-none"
                        onchange="loadFile(event)">
                    <!-- Pencil icon as a label -->
                    <!-- Pencil Icon -->
                    <label for="profilePicInput"
                        class="edit-icon">
                        <i class="fa-regular fa-pen-to-square text-white"></i>
                    </label>

                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text"
                    class="form-control @error('name')
                    is-invalid
                @enderror"
                    name="name"
                    value="{{ old('name', Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name) }}"
                    placeholder="Enter Name...">
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                    class="form-control @error('email')
                    is-invalid
                @enderror"
                    name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Enter Email...">
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Contacts Number</label>
                <input type="text"
                    class="form-control @error('phone')
                    is-invalid
                @enderror"
                    name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter Phone Number...">
                @error('phone')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea
                    class="form-control @error('address')
                    is-invalid
                @enderror"
                    name="address" placeholder="Enter Address..." rows="3">{{ old('address', Auth::user()->address) }}</textarea>
                @error('address')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <a href="{{ route('admin#changepasswordpage') }}" style="color: rgba(190, 9, 9, 0.94)">Change password</a>
            </div>

            <div style="display:flex column-gap:2">
                <button type="submit" class="btn text-white" style="background-color: rgba(190, 9, 9, 0.94)">Save Changes</button>
                <a class="btn btn-light text-dark border border-1" href="{{ route('dashboard') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
