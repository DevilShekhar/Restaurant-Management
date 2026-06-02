@extends('layouts.app')

@section('content')

<section class="section premium-dashboard">
    <div class="premium-page-head">
        <div class="premium-page-title">
            <span class="mini-badge">
                User Management
            </span>

            <h2>Edit User</h2>

            <p>
                Update user account details and role permissions.
            </p>
        </div>

        <div class="premium-head-actions">
            <a href="{{ route('users.index') }}"
               class="btn premium-btn ghost-btn">
                <i class="fas fa-arrow-left"></i>
                Back To Users
            </a>
        </div>
    </div>
</section>

<section class="section premium-dashboard pt-0">

    <form action="{{ route('users.update',$user['id']) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-lg-8">

                <div class="card premium-block">

                    <div class="card-header premium-card-header">
                        <div>
                            <h4>User Information</h4>
                            <p class="header-subtext">
                                Update account and profile information.
                            </p>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label>Full Name</label>

                                <input type="text"
                                       name="name"
                                       value="{{ old('name',$user['name']) }}"
                                       class="form-control premium-input">

                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Email Address</label>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email',$user['email']) }}"
                                       class="form-control premium-input">

                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Phone Number</label>

                                <input type="text"
                                       name="phone"
                                       value="{{ old('phone',$user['phone'] ?? '') }}"
                                       class="form-control premium-input">

                                @error('phone')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Gender</label>

                                <select name="gender"
                                        class="form-control premium-input">

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option value="male"
                                        {{ old('gender',$user['gender'] ?? '') == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>

                                    <option value="female"
                                        {{ old('gender',$user['gender'] ?? '') == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>

                                    <option value="other"
                                        {{ old('gender',$user['gender'] ?? '') == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Birth Date</label>

                                <input type="date"
                                       name="birth_date"
                                       value="{{ old('birth_date',$user['birth_date'] ?? '') }}"
                                       class="form-control premium-input">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Status</label>

                                <select name="status"
                                        class="form-control premium-input">

                                    <option value="active"
                                        {{ old('status',$user['status'] ?? '') == 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="inactive"
                                        {{ old('status',$user['status'] ?? '') == 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label>Role</label>

                                <select name="role" class="form-control premium-input">

                                    <option value="">Select Role</option>

                                    @foreach($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ old('role', $user['role'] ?? '') == $role ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('_', ' ', $role)) }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('role')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label>Address</label>

                                <textarea name="address"
                                          rows="4"
                                          class="form-control premium-input">{{ old('address',$user['address'] ?? '') }}</textarea>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="mt-4">

                    <a href="{{ route('users.index') }}"
                       class="btn btn-light">
                        Cancel
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        Update User
                    </button>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card premium-block">

                    <div class="card-header premium-card-header">
                        <div>
                            <h4>Profile Photo</h4>
                            <p class="header-subtext">
                                Upload or update profile image.
                            </p>
                        </div>
                    </div>

                    <div class="card-body text-center">

                        @if(!empty($user['profile_photo']))
                            <img src="{{ config('services.api.url') }}/../storage/{{ $user['profile_photo'] }}"
                                 alt="{{ $user['name'] }}"
                                 class="rounded-circle mb-3"
                                 width="120"
                                 height="120">
                        @else
                            <img src="{{ asset('assets/img/user.png') }}"
                                 class="rounded-circle mb-3"
                                 width="120"
                                 height="120">
                        @endif

                        <input type="file"
                               name="profile_photo"
                               class="form-control premium-input">

                        <small class="text-muted mt-2 d-block">
                            JPG, PNG, JPEG Supported
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </form>

</section>

@endsection