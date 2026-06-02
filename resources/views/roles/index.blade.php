@extends('layouts.app')
@section('content')
<section class="section premium-dashboard">
    <div class="premium-page-head">
        <div class="premium-page-title">
            <span class="mini-badge">
                Role Management
            </span>
            <h2>Role List</h2>
            <p>
                Manage all roles
            </p>
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
                            <h4 class="mb-1">
                                All Roles
                            </h4>
                            <p class="header-subtext mb-0">
                                Available system roles
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ ucfirst($role['name']) }}</strong>
                                        </td>
                                        <td>
    <div class="d-flex">

        <a href="{{ route('roles.show',$role['id']) }}"
            class="btn btn-sm btn-info mr-2">
            <i class="fas fa-eye"></i>
        </a>

        <a href="{{ route('roles.permissions.edit',$role['id']) }}"
            class="btn btn-sm btn-warning">
            <i class="fas fa-user-shield"></i>
        </a>

    </div>
</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No Roles Found
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