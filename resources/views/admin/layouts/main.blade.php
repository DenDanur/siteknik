<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            min-width: 250px;
            background-color: #343a40;
            color: white;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .sidebar a {
            color: white;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar p-3">
        <h4>Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category.index') }}">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('items.index') }}">Items</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Settings</a>
            </li>
            <!-- Tambahkan item menu lainnya sesuai kebutuhan -->
        </ul>
    </div>
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">@yield('menu')</a>
            <!-- Navbar content (e.g., user info, logout) can be added here -->
        </nav>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
