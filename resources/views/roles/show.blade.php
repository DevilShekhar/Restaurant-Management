@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>{{ $role['name'] }} Permissions</h4>
    </div>

    <div class="card-body">

        @forelse($permissions as $permission)

            <span class="badge badge-primary mr-2 mb-2">
                {{ $permission }}
            </span>

        @empty

            <span class="badge badge-danger">
                No Permissions Assigned
            </span>

        @endforelse

    </div>
</div>

@endsection