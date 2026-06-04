@extends('layouts.app')
@section('content')
    <section class="section premium-dashboard">
        <div class="premium-page-head">
            <div class="premium-page-title">
                <span class="mini-badge"> Category Management </span>
                <h2>Category List</h2>
                <p> Manage restaurant categories </p>
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
                                <h4 class="mb-1"> All Categories </h4>
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
                                            <th>Owner</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                            <th width="220"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td> {{ $loop->iteration }} </td>
                                                <td><strong>{{ $category->name }} </strong> </td>
                                                <td> {{ $category->owner->name ?? '-' }} </td>
                                                <td>  {{ $category->branch->name ?? '-' }}</td>
                                                <td>
                                                    @if($category->is_active)
                                                        <span class="badge badge-success"> Active </span>
                                                    @else
                                                        <span class="badge badge-danger">  Inactive </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-primary mr-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    No Categories Found
                                                </td>
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
@endsection