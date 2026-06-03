@extends('layouts.app')

@section('content')

<section class="section premium-dashboard">


<div class="premium-page-head">

    <div class="premium-page-title">

        <span class="mini-badge">
            Category Management
        </span>

        <h2>Edit Category</h2>

        <p>
            Update restaurant category information.
        </p>

    </div>

    <div class="premium-head-actions">

        <a href="{{ route('categories.index') }}"
           class="btn premium-btn ghost-btn">

            <i class="fas fa-arrow-left"></i>
            Back To Categories

        </a>

    </div>

</div>


</section>

<section class="section premium-dashboard pt-0">

<form action="{{ route('categories.update',$category->id) }}"
      method="POST"
      enctype="multipart/form-data">


@csrf
@method('PUT')

<div class="row">

    <div class="col-lg-12">

        <div class="card premium-block">

            <div class="card-header premium-card-header">

                <div>

                    <h4>Category Information</h4>

                    <p class="header-subtext">
                        Update category details.
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
                                    {{ $category->owner_id == $owner->id ? 'selected' : '' }}>

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

                        <label>Branch ID</label>

                        <input type="number"
                               name="branch_id"
                               value="{{ old('branch_id',$category->branch_id) }}"
                               class="form-control premium-input">

                        @error('branch_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Category Name</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name',$category->name) }}"
                               class="form-control premium-input">

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Status</label>

                        <select name="is_active"
                                class="form-control premium-input">

                            <option value="1"
                                {{ $category->is_active ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ !$category->is_active ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="col-md-12 mb-4">

                        <label>Description</label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control premium-input">{{ old('description',$category->description) }}</textarea>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Category Image</label>

                        <input type="file"
                               name="image"
                               class="form-control premium-input">

                    </div>

                    <div class="col-md-6 mb-4">

                        @if(!empty($category->image))

                            <label>Current Image</label>

                            <div>

                                <img
                                    src="{{ asset('storage/'.$category->image) }}"
                                    width="120"
                                    class="img-thumbnail">

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-4">

            <a href="{{ route('categories.index') }}"
               class="btn btn-light">

                Cancel

            </a>

            <button type="submit"
                    class="btn btn-primary">

                Update Category

            </button>

        </div>

    </div>

</div>


</form>

</section>

@endsection
