@extends('layouts.app')

@section('content')

@php

$groupedPermissions = [];

foreach ($permissions as $permission) {


// Permission Format Example:
// create-user
// view-user
// edit-user
// delete-user

$parts = explode('-', strtolower($permission['name']));

$action = ucfirst($parts[0] ?? '');

$module = ucfirst($parts[1] ?? 'General');

$groupedPermissions[$module][] = [
    'id' => $permission['id'],
    'name' => $permission['name'],
    'action' => $action,
    'label' => $action . ' ' . $module,
];


}

@endphp

<section class="section premium-dashboard">


<div class="premium-page-head">

    <div class="premium-page-title">

        <span class="mini-badge">
            Role Permission Management
        </span>

        <h2>{{ ucfirst($role['name']) }}</h2>

        <p>
            Assign permissions to this role
        </p>

    </div>

    <div class="premium-head-actions">

        <a href="{{ route('roles.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>
            Back

        </a>

    </div>

</div>


</section>

<section class="section premium-dashboard pt-0">


<div class="section-body">

    <form method="POST"
          action="{{ route('roles.permissions.update',$role['id']) }}">

        @csrf

        @foreach($groupedPermissions as $module => $modulePermissions)

        <div class="card premium-block mb-4">

            <div class="card-header premium-card-header">

                <div>

                    <h4 class="mb-1">

                        <i class="fas fa-shield-alt mr-2"></i>

                        {{ strtoupper($module) }}

                    </h4>

                    <p class="header-subtext mb-0">

                        {{ $module }} Permissions

                    </p>

                </div>

            </div>

            <div class="card-body">

                <div class="row">

                    @foreach($modulePermissions as $permission)

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">

                        <div class="custom-control custom-checkbox">

                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="permission{{ $permission['id'] }}"
                                name="permissions[]"
                                value="{{ $permission['name'] }}"
                                {{ in_array($permission['name'], $rolePermissions) ? 'checked' : '' }}
                            >

                            <label
                                class="custom-control-label font-weight-bold"
                                for="permission{{ $permission['id'] }}">

                                {{ $permission['label'] }}

                            </label>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

        @endforeach

        <div class="card premium-block">

            <div class="card-body text-right">

                <button
                    type="submit"
                    class="btn btn-primary btn-lg">

                    <i class="fas fa-save"></i>

                    Update Permissions

                </button>

            </div>

        </div>

    </form>

</div>


</section>

@endsection
