<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PFA Expenses')</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.ico">
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
            padding: 0.75rem 1.25rem;
        }

        .navbar-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media (min-width: 768px) {
            .navbar-custom {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .navbar-top { flex-shrink: 0; }
            .nav-toggler { display: none !important; }
            #navLinks {
                display: flex !important;
                flex-direction: row;
                margin-top: 0;
                padding-top: 0;
                border-top: none;
            }
            #navLinks a, #navLinks button {
                width: auto;
            }
            #navLinks .user-info {
                padding: 0.4rem 0.5rem;
            }
        }

        .navbar-custom .brand {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }

        .nav-toggler {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
        }

        .nav-toggler span {
            display: block;
            width: 24px;
            height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .nav-links {
            display: flex;
            gap: 0.35rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a, .nav-links button {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.88rem;
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
            padding: 1.5rem 1.25rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (max-width: 767px) {
            .nav-toggler { display: flex; }

            .nav-links {
                display: none;
                flex-direction: column;
                align-items: stretch;
                margin-top: 0.75rem;
                padding-top: 0.75rem;
                border-top: 1px solid rgba(255,255,255,0.15);
                gap: 0.25rem;
            }

            .nav-links.open { display: flex; }

            .nav-links a, .nav-links button {
                padding: 0.65rem 1rem;
                font-size: 0.95rem;
                text-align: left;
                width: 100%;
            }

            .nav-links .user-info {
                padding: 0.4rem 1rem;
                font-size: 0.85rem;
                opacity: 0.7;
            }

            .page-content {
                padding: 1rem 0.75rem;
            }

            .glass-card {
                padding: 1.25rem 1rem;
                border-radius: 14px;
            }

            .page-title {
                font-size: 1.4rem;
            }
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

        /* Butoane icon-only in tabel */
        .btn-tbl {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 6px;
            font-size: 0.8rem;
            text-decoration: none;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 0;
            vertical-align: middle;
        }
        .btn-tbl-green  { background: rgba(40,167,69,0.35);  border: 1px solid rgba(40,167,69,0.5); }
        .btn-tbl-yellow { background: rgba(255,193,7,0.35);  border: 1px solid rgba(255,193,7,0.5); }
        .btn-tbl-red    { background: rgba(220,53,69,0.45);  border: 1px solid rgba(220,53,69,0.6); }

        .registru-table { font-size: 0.82rem; }
        .registru-table th { font-size: 0.75rem; font-weight: 600; white-space: nowrap; padding: 0.4rem 0.35rem; }
        .registru-table td { padding: 0.35rem 0.35rem; vertical-align: middle; }
        .registru-table .col-doc { max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .registru-table .col-suma { white-space: nowrap; font-weight: 600; }
        .registru-table .col-actiuni { white-space: nowrap; }

        .badge-incasare, .badge-plata {
            padding: 0.2rem 0.45rem;
            font-size: 0.72rem;
        }

        .sumar-row {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        .sumar-row span {
            padding: 0.4rem 0.9rem;
            border-radius: 8px;
            font-size: 0.88rem;
            white-space: nowrap;
        }
        .sumar-inc  { background: rgba(40,167,69,0.2);  border: 1px solid rgba(40,167,69,0.4); }
        .sumar-pla  { background: rgba(220,53,69,0.2);  border: 1px solid rgba(220,53,69,0.4); }
        .sumar-sold { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); }

        /* Carduri mobile */
        .entry-cards { display: flex; flex-direction: column; gap: 0.6rem; }

        .entry-card {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            padding: 0.75rem;
        }

        .entry-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.35rem;
        }

        .entry-card-left {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .entry-card-data {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7);
        }

        .entry-card-metoda {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.08);
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
        }

        .entry-card-suma {
            font-size: 1rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .entry-card-doc {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.6);
            margin-bottom: 0.5rem;
            word-break: break-word;
        }

        .entry-card-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-top: 0.1rem;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* Grupare pe luni */
        .luna-section { margin-bottom: 2rem; }

        .luna-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 1rem;
            margin-bottom: 0.5rem;
            background: rgba(30,15,60,0.7);
            border: 1px solid rgba(102,126,234,0.4);
            border-left: 4px solid rgba(102,126,234,1);
            border-radius: 8px;
        }

        .luna-titlu {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .luna-sumar {
            display: flex;
            gap: 0.75rem;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .sumar-inc-sm {
            color: #5dde8a;
            background: rgba(40,167,69,0.15);
            padding: 0.15rem 0.5rem;
            border-radius: 5px;
        }
        .sumar-pla-sm {
            color: #ff7a7a;
            background: rgba(220,53,69,0.15);
            padding: 0.15rem 0.5rem;
            border-radius: 5px;
        }

        /* Badge atasament inline */
        .atas-badge {
            display: inline-flex;
            align-items: center;
            margin-left: 0.4rem;
            padding: 0.1rem 0.45rem;
            border-radius: 5px;
            font-size: 0.72rem;
            font-weight: 700;
            background: rgba(102, 126, 234, 0.35);
            border: 1px solid rgba(102, 126, 234, 0.6);
            color: #fff;
            cursor: pointer;
            vertical-align: middle;
            white-space: nowrap;
            transition: background 0.15s;
        }
        .atas-badge:hover {
            background: rgba(102, 126, 234, 0.6);
        }

        /* Butoane card mobile */
        .card-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            color: #fff;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }
        .card-btn-green  { background: rgba(40,167,69,0.3);  border: 1px solid rgba(40,167,69,0.5); }
        .card-btn-yellow { background: rgba(255,193,7,0.25); border: 1px solid rgba(255,193,7,0.5); }
        .card-btn-red    { background: rgba(220,53,69,0.3);  border: 1px solid rgba(220,53,69,0.55); }

        /* Butoane tabel desktop */
        .btn-tbl {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            border-radius: 6px;
            font-size: 0.8rem;
            text-decoration: none;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 0.2rem 0.45rem;
            vertical-align: middle;
            white-space: nowrap;
        }
        .btn-tbl-green  { background: rgba(40,167,69,0.35);  border: 1px solid rgba(40,167,69,0.5); }
        .btn-tbl-yellow { background: rgba(255,193,7,0.35);  border: 1px solid rgba(255,193,7,0.5); }
        .btn-tbl-red    { background: rgba(220,53,69,0.45);  border: 1px solid rgba(220,53,69,0.6); }

        /* Tabel desktop */
        .registru-table { font-size: 0.85rem; }
        .registru-table th { font-size: 0.78rem; font-weight: 600; white-space: nowrap; padding: 0.4rem 0.5rem; }
        .registru-table td { padding: 0.4rem 0.5rem; vertical-align: middle; }
        .registru-table .col-doc { max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .registru-table .col-suma { white-space: nowrap; font-weight: 600; }
        .registru-table .col-actiuni { white-space: nowrap; }
        .registru-table .btn-tbl { padding: 0.2rem 0.45rem; font-size: 0.78rem; }

        @media (max-width: 767px) {
            .sumar-row { gap: 0.4rem; }
            .sumar-row span { padding: 0.35rem 0.6rem; font-size: 0.8rem; }
            .registru-table { font-size: 0.72rem; }
            .registru-table th { font-size: 0.65rem; padding: 0.3rem 0.2rem; }
            .registru-table td { padding: 0.3rem 0.2rem; }
            .registru-table .col-doc { max-width: 80px; }
            .btn-tbl { width: 22px; height: 22px; font-size: 0.7rem; border-radius: 4px; }
            .badge-incasare, .badge-plata { padding: 0.15rem 0.3rem; font-size: 0.65rem; }
            .glass-card { padding: 0.75rem 0.5rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

@auth
<nav class="navbar-custom">
    <div class="navbar-top">
        <a href="{{ route('dashboard') }}" class="brand">PFA Expenses</a>
        <button class="nav-toggler" onclick="this.classList.toggle('open');document.getElementById('navLinks').classList.toggle('open');" aria-label="Meniu">
            <span></span><span></span><span></span>
        </button>
    </div>
    <div class="nav-links" id="navLinks">
        <a href="{{ route('registru.index') }}">Registrul meu</a>
        <a href="{{ route('registru.create') }}">+ Adauga</a>
        <a href="{{ route('registre.index') }}">Registre</a>
        <a href="{{ route('pdf.index') }}">Genereaza PDF</a>
        <span class="user-info" style="color:rgba(255,255,255,0.6);font-size:0.85rem;padding:0.4rem 0.5rem;">{{ Auth::user()->username }}</span>
        <a href="{{ route('profile.change-password') }}" style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);">Schimba parola</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout" style="border:1px solid rgba(220,53,69,0.5);cursor:pointer;color:rgba(255,255,255,0.85);border-radius:8px;width:100%;">Logout</button>
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
