@extends('layouts.app')

@section('content')

<section class="section premium-dashboard">


<div class="premium-page-head">

    <div class="premium-page-title">

        <span class="mini-badge">
            Permission Management
        </span>

        <h2>Edit Permission</h2>

        <p>
            Update permission information
        </p>

    </div>

    <div class="premium-head-actions">

        <a href="{{ route('permissions.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>
            Back

        </a>

    </div>

</div>


</section>

<section class="section premium-dashboard pt-0">


<div class="section-body">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card premium-block">

                <div class="card-header premium-card-header">

                    <div>

                        <h4 class="mb-1">
                            Edit Permission
                        </h4>

                        <p class="header-subtext mb-0">
                            Modify permission details
                        </p>

                    </div>

                </div>

                <form method="POST"
                      action="{{ route('permissions.update',$permission['id']) }}">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">

                            <label>
                                Permission Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name',$permission['name']) }}"
                                placeholder="Enter Permission Name">

                            @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>

                    </div>

                    <div class="card-footer text-right">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update Permission

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


</section>

@endsection
