@extends('layouts.app')
@section('content')
    <section class="section premium-dashboard">
        <div class="premium-page-head">
            <div class="premium-page-title">
                <span class="mini-badge"> Category Management</span>
                <h2>Category List</h2>
                <p> Manage restaurant categories </p>
            </div>
            <div class="premium-head-actions">
                <a href="{{ route('categories.create') }}" class="btn premium-btn btn-main-premium">
                    <i class="fas fa-plus"></i>Add Category
                </a>
            </div>
        </div>
    </section>
    <section class="section premium-dashboard pt-0">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card premium-block">
                        <div class="card-header premium-card-header">
                            <div>
                                <h4 class="mb-1">All Categories</h4>
                                <p class="header-subtext mb-0">Restaurant category records</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>                                  
                                            <th>Category</th>                                   
                                            <th>Branch</th>
                                            <th>Status</th>
                                            <th width="220"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>                                      
                                                <td><strong>{{ $category->name }}</strong></td>                                  
                                                <td>{{ $category->branch->name ?? '-' }}</td>
                                                <td>
                                                    @if($category->is_active)
                                                        <span class="badge badge-success"> Active  </span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-primary mr-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('categories.destroy',$category->id) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"class="text-center">No Categories Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        @if(session('success'))
            <script>
                Swal.fire({
                    icon:'success',
                    title:'Success',
                    text:'{{ session("success") }}',
                    timer:2000,
                    showConfirmButton:false
                });
            </script>
        @endif
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e){
                    e.preventDefault();
                    Swal.fire({
                        title:'Deactivate Category?',
                        text:'Category will be marked inactive.',
                        icon:'warning',
                        showCancelButton:true,
                        confirmButtonText:'Yes',
                        cancelButtonText:'Cancel'
                    }).then((result)=>{
                        if(result.isConfirmed){
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
