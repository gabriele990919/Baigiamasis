<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Story App</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    @include('layouts.navigation')

<div class="max-w-5xl mx-auto p-6">

    <!-- NAV -->
    <div class="flex justify-between items-center mb-6">

        <a href="/" class="text-xl font-bold">Galerija</a>

        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button>Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>

    </div>

    <!-- CONTENT -->
    {{ $slot }}

</div>

</body>
</html>
