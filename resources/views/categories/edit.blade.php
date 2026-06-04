@extends('layouts.app')
@section('content')
    <section class="section premium-dashboard">
        <div class="premium-page-head">
            <div class="premium-page-title">
                <span class="mini-badge"> Category Management </span>
                <h2>Edit Category</h2>
                <p> Update restaurant category information. </p>
            </div>
            <div class="premium-head-actions">
                <a href="{{ route('categories.index') }}" class="btn premium-btn ghost-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back To Categories
                </a>
            </div>
        </div>
    </section>
    <section class="section premium-dashboard pt-0">
        <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card premium-block">
                        <div class="card-header premium-card-header">
                            <div>
                                <h4>Category Information</h4>
                                <p class="header-subtext"> Update category details.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>Branch</label>
                                    <select name="branch_id" id="branch_id" class="form-control premium-input">
                                        <option value="">Select Branch </option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" data-owner="{{ $branch->owner_id }}"
                                            {{ $category->branch_id == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Category Name</label>
                                    <input type="text" name="name" value="{{ old('name',$category->name) }}" class="form-control premium-input">
                                    @error('name')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Status</label>
                                    <select name="is_active" class="form-control premium-input">
                                        <option value="1" {{ $category->is_active ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="0" {{ !$category->is_active ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label>Description</label>
                                    <textarea name="description" rows="4" class="form-control premium-input">{{ old('description',$category->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('categories.index') }}" class="btn btn-light">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Update Category
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const branch = document.getElementById('branch_id');
            const owner = document.getElementById('owner_id');
            function updateOwner() {
                owner.value =
                    branch.options[
                        branch.selectedIndex
                    ].dataset.owner;
            }
            branch.addEventListener(
                'change',
                updateOwner
            );
            updateOwner();
        });
    </script>
@endsection