<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Create User</h2>

    <form action="{{ route('users.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Name</label>

            <input type="text"
                   name="name"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>

            <select name="role" class="form-control">

                <option value="owner">Owner</option>

                <option value="branch_manager">Branch Manager</option>

                <option value="waiter">Waiter</option>

                <option value="chef">Chef</option>

                <option value="cashier">Cashier</option>

                <option value="customer">Customer</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Password</label>

            <input type="password"
                   name="password"
                   class="form-control">
        </div>

        <button class="btn btn-success">
            Save User
        </button>

    </form>

</div>

</body>
</html>