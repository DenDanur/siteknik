<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mambalabu Gunshop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow-lg p-8 h-full max-w-sm w-full flex flex-col items-center text-center">
        <h1 class="text-2xl font-bold text-white mb-6">Mambalabu Gunshop</h1>
        <div class="mambalabu w-32 h-32 mb-16">
            <img src="{{ asset('images/mambalabu.jpeg') }}" alt="">
        </div>
        <div class="flex gap-4">
            @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-primary dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-secondary dark:hover:bg-white focus:bg-secondary dark:focus:bg-white active:bg-primary dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Register</a>
                @endif
            @endauth
        @endif
        </div>

    </div>
</body>
</html>
