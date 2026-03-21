<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PFA Expenses')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        .navbar-custom {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 1rem 2rem;
        }

        .navbar-custom .brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        .nav-links .btn-logout {
            background: rgba(220,53,69,0.3);
            border: 1px solid rgba(220,53,69,0.5);
        }

        .nav-links .btn-logout:hover {
            background: rgba(220,53,69,0.5);
        }

        .page-content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .glass-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .alert-success-custom {
            background: rgba(40,167,69,0.2);
            border: 1px solid rgba(40,167,69,0.5);
            color: #fff;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .alert-danger-custom {
            background: rgba(220,53,69,0.2);
            border: 1px solid rgba(220,53,69,0.5);
            color: #fff;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .form-label { color: rgba(255,255,255,0.95); font-weight: 600; }

        .form-control, .form-select {
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 10px;
            color: #fff;
            padding: 0.75rem 1rem;
        }

        .form-control::placeholder { color: rgba(255,255,255,0.5); }
        .form-control:focus, .form-select:focus {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.5);
            color: #fff;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.1);
        }

        .form-select option { background: #764ba2; color: #fff; }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: #fff;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102,126,234,0.5);
            color: #fff;
        }

        .btn-danger-custom {
            background: rgba(220,53,69,0.7);
            border: 1px solid rgba(220,53,69,0.8);
            border-radius: 8px;
            color: #fff;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-danger-custom:hover { background: rgba(220,53,69,0.9); color: #fff; }

        .btn-edit-custom {
            background: rgba(255,193,7,0.3);
            border: 1px solid rgba(255,193,7,0.5);
            border-radius: 8px;
            color: #fff;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-edit-custom:hover { background: rgba(255,193,7,0.5); color: #fff; }

        table { color: #fff; }

        table thead th {
            background: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.9);
            border-color: rgba(255,255,255,0.2);
            font-weight: 600;
        }

        table tbody td {
            border-color: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.9);
            vertical-align: middle;
        }

        table tbody tr:hover { background: rgba(255,255,255,0.05); }

        .badge-incasare {
            background: rgba(40,167,69,0.4);
            border: 1px solid rgba(40,167,69,0.6);
            color: #fff;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-plata {
            background: rgba(220,53,69,0.4);
            border: 1px solid rgba(220,53,69,0.6);
            color: #fff;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .user-info {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }
    </style>
    @stack('styles')
</head>
<body>

@auth
<nav class="navbar-custom d-flex justify-content-between align-items-center flex-wrap gap-2">
    <a href="{{ route('dashboard') }}" class="brand">PFA Expenses</a>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('registru.create') }}">+ Adauga</a>
        <a href="{{ route('registru.index') }}">Editare Registru</a>
        <a href="{{ route('registre.index') }}">Registre</a>
        <a href="{{ route('pdf.index') }}">Genereaza PDF</a>
        <span class="user-info">| {{ Auth::user()->username }}</span>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="nav-links btn-logout" style="border:none;cursor:pointer;background:rgba(220,53,69,0.3);border:1px solid rgba(220,53,69,0.5);color:rgba(255,255,255,0.85);padding:0.4rem 1rem;border-radius:8px;">Logout</button>
        </form>
    </div>
</nav>
@endauth

<div class="page-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
