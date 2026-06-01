<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="p-10">

    <h1 class="text-3xl font-bold">
        Dashboard
    </h1>

    <p class="mt-4 text-green-600">
        Login Successful
    </p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button
            class="bg-red-600 text-white px-4 py-2 rounded mt-5"
        >
            Logout
        </button>
    </form>

</div>

</body>
</html>