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

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $branch->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $branch->code }}
                                    </td>

                                    <td>
                                        {{ $branch->owner->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $branch->manager->name ?? 'Not Assigned' }}
                                    </td>

                                    <td>
                                        {{ $branch->phone }}
                                    </td>

                                    <td>
                                        {{ $branch->city }}
                                    </td>

                                    <td>

                                        @if($branch->is_active)

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
                                            <a href="#"
   class="btn btn-sm btn-warning mr-2 assign-manager-btn"
   data-branch="{{ $branch->id }}"
   data-toggle="modal"
   data-target="#assignManagerModal">

    <i class="fas fa-user-tie"></i>

</a>

                                        
                                            

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
<div class="modal fade"
     id="assignManagerModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST"
                  id="assignManagerForm">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        Assign Branch Manager
                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>
                            Select Branch Manager
                        </label>

                        <select
                            name="branch_manager_id"
                            class="form-control"
                            required>

                            <option value="">
                                Select Manager
                            </option>

                            @foreach($managers as $manager)

                                <option value="{{ $manager->id }}">
                                    {{ $manager->name }}
                                    ({{ $manager->email }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        Close

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Assign

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>
document.querySelectorAll('.assign-manager-btn').forEach(button => {

    button.addEventListener('click', function () {

        let branchId = this.dataset.branch;

        document.getElementById('assignManagerForm')
            .action = `/branches/${branchId}/assign-manager`;

    });

});
</script>
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


@endpush

@endsection
