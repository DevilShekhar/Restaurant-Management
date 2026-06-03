@extends('layouts.app')

@section('content')

<section class="section premium-dashboard">
    <div class="premium-page-head">
        <div class="premium-page-title">
            <span class="mini-badge">
                Branch Management
            </span>


        <h2>Branch List</h2>

        <p>
            Manage all restaurant branches
        </p>
    </div>

    <div class="premium-head-actions">
        <a href="{{ route('branches.create') }}"
           class="btn premium-btn btn-main-premium">
            <i class="fas fa-plus"></i>
            Add Branch
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
                        <h4 class="mb-1">All Branches</h4>

                        <p class="header-subtext mb-0">
                            Restaurant branch records
                        </p>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch</th>
                                    <th>Code</th>
                                    <th>Owner</th>
                                    <th>Manager</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th width="220">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                               @forelse($branches as $branch)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <strong>
                                            {{ $branch['name'] }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $branch['code'] ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $branch['owner']['name'] ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $branch['manager']['name'] ?? 'Not Assigned' }}
                                    </td>

                                    <td>
                                        {{ $branch['phone'] ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $branch['city'] ?? '-' }}
                                    </td>

                                    <td>

                                        @if($branch['is_active'])

                                            <span class="badge badge-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge badge-danger">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex">

                                            <a href="{{ route('branches.edit',$branch['id']) }}"
                                            class="btn btn-sm btn-primary mr-2">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('branches.destroy',$branch['id']) }}"
                                                method="POST"
                                                class="delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="9" class="text-center">
                                        No Branches Found
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


@push('scripts')

@if(session('success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session("success") }}',
    timer: 2000,
    showConfirmButton: false
});
</script>

@endif

@if(session('error'))

<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ session("error") }}'
});
</script>

@endif

<script>

document.querySelectorAll('.delete-form').forEach(form => {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'Deactivate Branch?',
            text: 'Branch will be marked inactive.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});

</script>

@endpush

@endsection
