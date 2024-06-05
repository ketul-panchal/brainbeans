<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<style>
        body {
            display: flex;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 40px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .navbar {
            margin-bottom: 20px;
            padding: 20px;
            background: linear-gradient(#83B4FF,#5A72A0);
        }
        .navbar a{
            color:aliceblue;
            font-weight: 800;
            font-size: x-large;
        }
    </style>
</head>
<body>
<div class="sidebar">
        <h2>Hello, Admin</h2>
        <a href="{{ route('pos.index') }}">POS</a>
        <a href="{{ route('pos.invoices') }}">Invoices</a>
        <a href="{{ route('products.index') }}">Products</a>
    </div>
    <div class="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">POS System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                
            </div>
        </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>