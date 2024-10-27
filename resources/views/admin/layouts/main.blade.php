<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Mambalabu Gunshop</title>
    {{-- <title>@yield('title')</title> --}}
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            position: fixed;
            min-width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 400px;
        }

        .sidebar a {
            color: white;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }

        /* Ensure the sidebar takes up the same height as the content */
        .content, .sidebar {
            min-height: 100vh; /* Both the content and sidebar fill the viewport */
        }
    </style>
</head>

<body>
    <div class="sidebar p-3">
        <h4>MAMBALABU GUNSHOP ADMIN</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('subcategories.index') }}">Sub Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('items.index') }}">Items</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('penyewaan.index') }}">Penyewaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('penyewaan.history') }}">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{{ route('viewuser.index')}}}">Users</a>
            </li>
        </ul>

        
        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button :href="route('logout')"
                onclick="event.preventDefault();
                                this.closest('form').submit();"
            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                {{ __('Log Out') }}
        </button>
        </form> --}}
    </div>
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">@yield('menu')</a>
    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Check if user is authenticated -->
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <!-- Display logged-in admin's name -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-left">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            
        </nav>
        
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    @yield('script')
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
