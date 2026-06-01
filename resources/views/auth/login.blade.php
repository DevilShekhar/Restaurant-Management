<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">

        <h2 class="text-3xl font-bold text-center mb-6">
            Restaurant Admin
        </h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('web.login') }}" method="POST">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email"
                class="w-full border p-3 mb-4 rounded"
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="w-full border p-3 mb-4 rounded"
            >

            <button
                class="w-full bg-green-600 text-white p-3 rounded"
            >
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>