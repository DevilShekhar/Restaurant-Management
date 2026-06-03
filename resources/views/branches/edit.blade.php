@extends('layouts.app')

@section('content')

<section class="section premium-dashboard">


<div class="premium-page-head">

    <div class="premium-page-title">
        <span class="mini-badge">
            Branch Management
        </span>

        <h2>Edit Branch</h2>

        <p>
            Update restaurant branch information.
        </p>
    </div>

    <div class="premium-head-actions">

        <a href="{{ route('branches.index') }}"
           class="btn premium-btn ghost-btn">

            <i class="fas fa-arrow-left"></i>
            Back To Branches

        </a>

    </div>

</div>


</section>

<section class="section premium-dashboard pt-0">

<form action="{{ route('branches.update',$branch->id) }}"
      method="POST">


@csrf
@method('PUT')

<div class="row">

    <div class="col-lg-12">

        <div class="card premium-block">

            <div class="card-header premium-card-header">

                <div>

                    <h4>Branch Information</h4>

                    <p class="header-subtext">
                        Update branch details.
                    </p>

                </div>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label>Owner</label>

                        <select name="owner_id"
                                class="form-control premium-input">

                            <option value="">
                                Select Owner
                            </option>

                            @foreach($owners as $owner)

                                <option value="{{ $owner->id }}"
                                    {{ $branch->owner_id == $owner->id ? 'selected' : '' }}>

                                    {{ $owner->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('owner_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Branch Name</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name',$branch->name) }}"
                               class="form-control premium-input">

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Branch Code</label>

                        <input type="text"
                               name="code"
                               value="{{ old('code',$branch->code) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Phone</label>

                        <input type="text"
                               name="phone"
                               value="{{ old('phone',$branch->phone) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Email</label>

                        <input type="email"
                               name="email"
                               value="{{ old('email',$branch->email) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>City</label>

                        <input type="text"
                               name="city"
                               value="{{ old('city',$branch->city) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>State</label>

                        <input type="text"
                               name="state"
                               value="{{ old('state',$branch->state) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Country</label>

                        <input type="text"
                               name="country"
                               value="{{ old('country',$branch->country) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Postal Code</label>

                        <input type="text"
                               name="postal_code"
                               value="{{ old('postal_code',$branch->postal_code) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>GST Number</label>

                        <input type="text"
                               name="gst_number"
                               value="{{ old('gst_number',$branch->gst_number) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>FSSAI License</label>

                        <input type="text"
                               name="fssai_license"
                               value="{{ old('fssai_license',$branch->fssai_license) }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Opening Time</label>

                        <input type="time"
                               name="opening_time"
                               value="{{ $branch->opening_time }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Closing Time</label>

                        <input type="time"
                               name="closing_time"
                               value="{{ $branch->closing_time }}"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Status</label>

                        <select name="is_active"
                                class="form-control premium-input">

                            <option value="1"
                                {{ $branch->is_active ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ !$branch->is_active ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="col-md-12 mb-4">

                        <label>Address</label>

                        <textarea
                            name="address"
                            rows="4"
                            class="form-control premium-input">{{ old('address',$branch->address) }}</textarea>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-4">

            <a href="{{ route('branches.index') }}"
               class="btn btn-light">

                Cancel

            </a>

            <button type="submit"
                    class="btn btn-primary">

                Update Branch

            </button>

        </div>

    </div>

</div>


</form>

</section>

@endsection
