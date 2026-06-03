@extends('layouts.app')

@section('content')

<section class="section premium-dashboard">

    <div class="premium-page-head">

        <div class="premium-page-title">
            <span class="mini-badge">
                Branch Management
            </span>

            <h2>Create Branch</h2>

            <p>
                Add a new restaurant branch.
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

<form action="{{ route('branches.store') }}"
      method="POST">

    @csrf

    <div class="row">

        <div class="col-lg-12">

            <div class="card premium-block">

                <div class="card-header premium-card-header">

                    <div>

                        <h4>Branch Information</h4>

                        <p class="header-subtext">
                            Enter branch details.
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

                                    <option value="{{ $owner->id }}">
                                        {{ $owner->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Branch Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Branch Code</label>

                            <input type="text"
                                   name="code"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Phone</label>

                            <input type="text"
                                   name="phone"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>City</label>

                            <input type="text"
                                   name="city"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>State</label>

                            <input type="text"
                                   name="state"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Country</label>

                            <input type="text"
                                   name="country"
                                   value="India"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Postal Code</label>

                            <input type="text"
                                   name="postal_code"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>GST Number</label>

                            <input type="text"
                                   name="gst_number"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>FSSAI License</label>

                            <input type="text"
                                   name="fssai_license"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Opening Time</label>

                            <input type="time"
                                   name="opening_time"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Closing Time</label>

                            <input type="time"
                                   name="closing_time"
                                   class="form-control premium-input">

                        </div>

                        <div class="col-md-12 mb-4">

                            <label>Address</label>

                            <textarea
                                name="address"
                                rows="4"
                                class="form-control premium-input"></textarea>

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
                    Create Branch
                </button>

            </div>

        </div>

       

    </div>

</form>

</section>

@endsection