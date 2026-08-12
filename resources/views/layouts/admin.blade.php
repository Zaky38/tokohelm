<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <style>
        body { background-color: #f8fafc; }
        .navbar { box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .card-dashboard {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-white">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo + Sapaan (VERTIKAL) -->
        <div class="d-flex flex-column align-items-start">
            <img src="{{ asset('images/helmlogo.png') }}" width="150">
        </div>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger btn-sm">Logout</button>
        </form>

    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>