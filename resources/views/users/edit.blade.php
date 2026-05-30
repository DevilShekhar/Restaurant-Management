<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Name</label>

            <input type="text"
                   name="name"
                   value="{{ $user->name }}"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   value="{{ $user->email }}"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Role</label>

            <select name="role" class="form-control">

                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>
                    Owner
                </option>

                <option value="branch_manager" {{ $user->role == 'branch_manager' ? 'selected' : '' }}>
                    Branch Manager
                </option>

                <option value="waiter" {{ $user->role == 'waiter' ? 'selected' : '' }}>
                    Waiter
                </option>

                <option value="chef" {{ $user->role == 'chef' ? 'selected' : '' }}>
                    Chef
                </option>

                <option value="cashier" {{ $user->role == 'cashier' ? 'selected' : '' }}>
                    Cashier
                </option>

                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>
                    Customer
                </option>

            </select>

        </div>

        <button class="btn btn-primary">
            Update User
        </button>

    </form>

</div>

</body>
</html>