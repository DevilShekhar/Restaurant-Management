@extends('layouts.app')

@section('content')

<section class="section premium-dashboard">


<div class="premium-page-head">

    <div class="premium-page-title">

        <span class="mini-badge">
            Permission Management
        </span>

        <h2>Permission List</h2>

        <p>
            Manage all permissions
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
                            All Permissions
                        </h4>

                        <p class="header-subtext mb-0">
                            Available system permissions
                        </p>

                    </div>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Permission Name</th>

                                    <th width="150">
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($permissions as $permission)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ ucfirst($permission['name']) }}
                                    </td>

                                    <td>

                                        <div class="d-flex">

                                            <a href="{{ route('permissions.edit',$permission['id']) }}"
                                               class="btn btn-sm btn-primary mr-2">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('permissions.destroy',$permission['id']) }}"
                                                  method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="3"
                                        class="text-center">

                                        No Permissions Found

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
