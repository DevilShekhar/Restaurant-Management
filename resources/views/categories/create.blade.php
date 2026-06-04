@extends('layouts.app')
@section('content')
    <section class="section premium-dashboard">
        <div class="premium-page-head">
            <div class="premium-page-title">
                <span class="mini-badge">Category Management </span>
                <h2>Create Category</h2>
                <p>Add a new restaurant category.</p>
            </div>
            <div class="premium-head-actions">
                <a href="{{ route('categories.index') }}" class="btn premium-btn ghost-btn">
                    <i class="fas fa-arrow-left"></i> Back To Categories
                </a>
            </div>
        </div>
    </section>
    <section class="section premium-dashboard pt-0">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card premium-block">
                        <div class="card-header premium-card-header">
                            <div>
                                <h4>Category Information</h4>
                                <p class="header-subtext"> Enter category details.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">                    
                                <div class="col-md-6 mb-4">
                                    <label>Branch</label>
                                    <select name="branch_id" id="branch_id" class="form-control premium-input">
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" data-owner="{{ $branch->owner_id }}">
                                                {{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <script>
                                        document.getElementById('branch_id').addEventListener('change', function () {
                                                let ownerId = this.options[this.selectedIndex].dataset.owner;
                                                    document.getElementById(
                                                        'owner_id'
                                                    ).value = ownerId;
                                                });
                                        document.getElementById('branch_id').dispatchEvent(new Event('change'));
                                    </script>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Category Name</label>
                                    <input type="text" name="name"  value="{{ old('name') }}" class="form-control premium-input" placeholder="Enter Category Name">
                                    @error('name')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Status</label>
                                    <select name="is_active" class="form-control premium-input">
                                        <option value="1">  Active </option>
                                        <option value="0"> Inactive </option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label>Description</label>
                                    <textarea name="description" rows="4"  class="form-control premium-input"  placeholder="Enter Category Description">{{ old('description') }}</textarea>
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('categories.index') }}" class="btn btn-light">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary"> Save Category </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
