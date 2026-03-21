<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NUVA.')</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="manifest" href="/manifest.json">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="NUVA">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,200;9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">

    <style>
        /* ── Variables ────────────────────────────────────── */
        :root {
            --bg:                  #f7f5f0;
            --bg-card:             #ffffff;
            --bg-nav:              rgba(247,245,240,.95);
            --bg-input:            #fafaf9;
            --border:              #e8e4dc;
            --border-input:        #e5e7eb;
            --accent:              #f97316;
            --accent-hover:        #ea580c;
            --text:                #111111;
            --text-muted:          #8a8a8a;
            --text-link:           #444444;
            --nav-hover:           rgba(249,115,22,.07);
            --row-hover:           rgba(0,0,0,.025);
            --shadow:              0 4px 20px rgba(0,0,0,.07);
            --nav-shadow:          0 1px 0 #e8e4dc;
            --select-bg:           #ffffff;
            --badge-plata-bg:      #fee2e2;
            --badge-plata-border:  #fca5a5;
            --badge-plata-text:    #dc2626;
            --badge-inc-bg:        #dcfce7;
            --badge-inc-border:    #86efac;
            --badge-inc-text:      #16a34a;
            --sumar-inc-bg:        #dcfce7;
            --sumar-inc-border:    #86efac;
            --sumar-pla-bg:        #fee2e2;
            --sumar-pla-border:    #fca5a5;
            --sumar-sold-bg:       #f1f5f9;
            --luna-bg:             #f7f5f0;
            --luna-border:         rgba(249,115,22,.2);
            --luna-accent:         #f97316;
            --entry-card-bg:       #fafaf9;
            --entry-card-border:   #e8e4dc;
            --entry-metoda-bg:     #f1f5f9;
            --btn-logout-bg:       #fee2e2;
            --btn-logout-border:   #fca5a5;
            --plata-fields-bg:     rgba(249,115,22,.05);
            --plata-fields-border: rgba(249,115,22,.2);
            --atas-bg:             rgba(249,115,22,.1);
            --atas-border:         rgba(249,115,22,.3);
            --popup-bg:            #ffffff;
            --popup-border:        #e8e4dc;
        }

        /* ── Reset & Base ─────────────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: var(--bg);
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            letter-spacing: .01em;
        }

        /* ── Navbar ───────────────────────────────────────── */
        .navbar-custom {
            background: var(--bg-nav);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--nav-shadow);
            padding: 0.85rem 1.5rem;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            position: sticky;
            top: 0;
            z-index: 200;
        }

        .navbar-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
        }

        /* Logo */
        .brand {
            display: flex;
            flex-direction: column;
            gap: 1px;
            text-decoration: none;
            line-height: 1;
        }
        .brand-name {
            display: flex;
            align-items: baseline;
            gap: 1px;
        }
        .brand-nuva {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 23px;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--text);
            line-height: 1;
        }
        .brand-dot {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 36px;
            color: var(--accent);
            line-height: 1;
            letter-spacing: 0;
        }
        .brand-tag {
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            font-size: 11px;
            letter-spacing: .01em;
            color: var(--text-muted);
            font-style: italic;
        }

        .navbar-top-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            width: 22px;
            height: 1.5px;
            background: var(--text);
            border-radius: 2px;
            transition: all 0.25s;
        }

        .nav-links {
            display: flex;
            gap: 0.2rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a,
        .nav-links button {
            color: var(--text-link);
            text-decoration: none;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            transition: background 0.15s, color 0.15s;
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            font-size: 13px;
            letter-spacing: .03em;
            border: none;
            background: none;
            cursor: pointer;
        }

        .nav-links a:hover,
        .nav-links button:hover {
            background: var(--nav-hover);
            color: var(--accent);
        }

        .btn-logout {
            background: var(--btn-logout-bg) !important;
            border: 1px solid var(--btn-logout-border) !important;
            color: var(--badge-plata-text) !important;
        }

        .btn-logout:hover {
            background: #fecaca !important;
        }

        /* ── Page layout ──────────────────────────────────── */
        .page-content {
            padding: 1.75rem 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ── Glass card ───────────────────────────────────── */
        .glass-card {
            background: var(--bg-card);
            border-radius: 18px;
            padding: 1.75rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            animation: fadeInUp 0.3s ease-out forwards;
        }

        /* ── Page title ───────────────────────────────────── */
        .page-title {
            font-family: 'DM Sans', sans-serif;
            font-weight: 200;
            font-size: 2rem;
            letter-spacing: -.5px;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        /* ── Alerts ───────────────────────────────────────── */
        .alert-success-custom {
            background: var(--sumar-inc-bg);
            border: 1px solid var(--sumar-inc-border);
            color: var(--badge-inc-text);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            font-size: 13px;
        }

        .alert-danger-custom {
            background: var(--sumar-pla-bg);
            border: 1px solid var(--sumar-pla-border);
            color: var(--badge-plata-text);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            font-size: 13px;
        }

        /* ── Forms ────────────────────────────────────────── */
        .form-label {
            color: var(--text);
            font-weight: 400;
            font-size: 12px;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .form-control,
        .form-select {
            background: var(--bg-input);
            border: 1px solid var(--border-input);
            border-radius: 10px;
            color: var(--text);
            padding: 0.65rem 0.9rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control::placeholder { color: var(--text-muted); }

        .form-control:focus,
        .form-select:focus {
            background: #fff;
            border-color: var(--accent);
            color: var(--text);
            box-shadow: 0 0 0 3px rgba(249,115,22,.1);
        }

        .form-select option { background: var(--select-bg); color: var(--text); }

        /* ── Buttons ──────────────────────────────────────── */
        .btn-primary-custom {
            background: var(--accent);
            border: none;
            border-radius: 10px;
            color: #fff;
            padding: 0.6rem 1.25rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 13px;
            letter-spacing: .04em;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-block;
            white-space: nowrap;
        }

        .btn-primary-custom:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(249,115,22,.28);
            color: #fff;
        }

        .btn-danger-custom {
            background: var(--badge-plata-bg);
            border: 1px solid var(--badge-plata-border);
            border-radius: 8px;
            color: var(--badge-plata-text);
            padding: 0.35rem 0.75rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
        }

        .btn-danger-custom:hover {
            background: #fecaca;
            color: var(--badge-plata-text);
        }

        .btn-edit-custom {
            background: rgba(234,179,8,.1);
            border: 1px solid rgba(234,179,8,.3);
            border-radius: 8px;
            color: #92400e;
            padding: 0.35rem 0.75rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
        }

        .btn-edit-custom:hover {
            background: rgba(234,179,8,.22);
            color: #92400e;
        }

        /* ── Tables ───────────────────────────────────────── */
        table { color: var(--text); font-family: 'DM Sans', sans-serif; }

        table thead th {
            background: transparent;
            color: var(--text-muted);
            border-color: var(--border);
            font-weight: 400;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        table tbody td {
            border-color: var(--border);
            color: var(--text);
            vertical-align: middle;
            font-weight: 300;
            font-size: 13px;
        }

        table tbody tr { transition: background-color 0.15s ease; }
        table tbody tr:hover { background: var(--row-hover); }

        /* ── Badges ───────────────────────────────────────── */
        .badge-incasare {
            background: var(--badge-inc-bg);
            border: 1px solid var(--badge-inc-border);
            color: var(--badge-inc-text);
            padding: 0.2rem 0.55rem;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 400;
        }

        .badge-plata {
            background: var(--badge-plata-bg);
            border: 1px solid var(--badge-plata-border);
            color: var(--badge-plata-text);
            padding: 0.2rem 0.55rem;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 400;
        }

        /* ── User info ────────────────────────────────────── */
        .user-info { color: var(--text-muted); font-size: 12px; font-weight: 300; }

        /* ── Table action buttons ─────────────────────────── */
        .btn-tbl {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            border-radius: 6px;
            font-size: 11px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            padding: 0.2rem 0.45rem;
            vertical-align: middle;
            white-space: nowrap;
            transition: opacity 0.15s, transform 0.1s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-tbl:hover { opacity: 0.8; transform: scale(1.05); }

        .btn-tbl-green  { background: #dcfce7; border: 1px solid #86efac !important; color: #15803d; }
        .btn-tbl-yellow { background: rgba(234,179,8,.12); border: 1px solid rgba(234,179,8,.35) !important; color: #92400e; }
        .btn-tbl-red    { background: #fee2e2; border: 1px solid #fca5a5 !important; color: #dc2626; }

        /* ── Registru table sizing ────────────────────────── */
        .registru-table { font-size: 13px; }
        .registru-table th { font-size: 11px; white-space: nowrap; padding: 0.4rem 0.5rem; }
        .registru-table td { padding: 0.4rem 0.5rem; vertical-align: middle; }
        .registru-table .col-doc { max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .registru-table .col-suma { white-space: nowrap; font-weight: 500; }
        .registru-table .col-actiuni { white-space: nowrap; }

        /* ── Sumar row ────────────────────────────────────── */
        .sumar-row { display: flex; gap: 0.75rem; flex-wrap: wrap; }
        .sumar-row span { padding: 0.4rem 0.9rem; border-radius: 8px; font-size: 13px; white-space: nowrap; font-weight: 300; }
        .sumar-inc  { background: var(--sumar-inc-bg);  border: 1px solid var(--sumar-inc-border);  color: var(--badge-inc-text); }
        .sumar-pla  { background: var(--sumar-pla-bg);  border: 1px solid var(--sumar-pla-border);  color: var(--badge-plata-text); }
        .sumar-sold { background: var(--sumar-sold-bg); border: 1px solid var(--border);             color: var(--text); }

        /* ── Luna header ──────────────────────────────────── */
        .luna-section { margin-bottom: 1.75rem; }

        .luna-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 1rem;
            margin-bottom: 0.5rem;
            background: var(--luna-bg);
            border: 1px solid var(--luna-border);
            border-left: 3px solid var(--luna-accent);
            border-radius: 8px;
        }

        .luna-titlu {
            font-size: 11px;
            font-weight: 400;
            color: var(--text);
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .luna-sumar { display: flex; gap: 0.75rem; font-size: 12px; font-weight: 500; }

        .sumar-inc-sm {
            color: var(--badge-inc-text);
            background: var(--sumar-inc-bg);
            padding: 0.15rem 0.5rem;
            border-radius: 5px;
        }
        .sumar-pla-sm {
            color: var(--badge-plata-text);
            background: var(--sumar-pla-bg);
            padding: 0.15rem 0.5rem;
            border-radius: 5px;
        }

        /* ── Entry cards (mobile) ─────────────────────────── */
        .entry-cards { display: flex; flex-direction: column; gap: 0.6rem; }

        .entry-card {
            background: var(--entry-card-bg);
            border: 1px solid var(--entry-card-border);
            border-radius: 12px;
            padding: 0.75rem;
            animation: fadeInUp 0.25s ease-out forwards;
            opacity: 0;
        }

        .entry-card:nth-child(1) { animation-delay: 0.04s; }
        .entry-card:nth-child(2) { animation-delay: 0.08s; }
        .entry-card:nth-child(3) { animation-delay: 0.12s; }
        .entry-card:nth-child(4) { animation-delay: 0.16s; }
        .entry-card:nth-child(5) { animation-delay: 0.20s; }
        .entry-card:nth-child(n+6) { animation-delay: 0.24s; }

        .entry-card-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.35rem; }
        .entry-card-left { display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap; }
        .entry-card-data { font-size: 11px; color: var(--text-muted); }
        .entry-card-metoda { font-size: 11px; color: var(--text-muted); background: var(--entry-metoda-bg); padding: 0.1rem 0.4rem; border-radius: 4px; }
        .entry-card-suma { font-size: 1rem; font-weight: 500; white-space: nowrap; color: var(--text); }
        .entry-card-doc { font-size: 12px; color: var(--text-muted); margin-bottom: 0.5rem; word-break: break-word; }
        .entry-card-actions { display: flex; gap: 0.5rem; align-items: center; margin-top: 0.1rem; padding-top: 0.5rem; border-top: 1px solid var(--entry-card-border); }

        /* ── Card buttons (mobile) ────────────────────────── */
        .card-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 400;
            text-decoration: none;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity 0.15s;
            font-family: 'DM Sans', sans-serif;
        }
        .card-btn:hover { opacity: 0.8; }

        .card-btn-green  { background: #dcfce7; border: 1px solid #86efac !important; color: #15803d; }
        .card-btn-yellow { background: rgba(234,179,8,.12); border: 1px solid rgba(234,179,8,.35) !important; color: #92400e; }
        .card-btn-red    { background: #fee2e2; border: 1px solid #fca5a5 !important; color: #dc2626; }

        /* ── Attachment badge ─────────────────────────────── */
        .atas-badge {
            display: inline-flex;
            align-items: center;
            margin-left: 0.4rem;
            padding: 0.1rem 0.45rem;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 400;
            background: var(--atas-bg);
            border: 1px solid var(--atas-border);
            color: var(--accent);
            cursor: pointer;
            vertical-align: middle;
            white-space: nowrap;
            transition: background 0.15s;
        }
        .atas-badge:hover { background: rgba(249,115,22,.2); }

        /* ── Charts ───────────────────────────────────────── */
        .charts-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem; }

        .chart-title {
            font-size: 11px;
            font-weight: 400;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .chart-filter-wrap { display: flex; flex-direction: column; gap: 0.4rem; }
        .chart-filter-bar  { display: flex; gap: 0.4rem; align-items: center; flex-wrap: wrap; }
        .chart-filter-label { font-size: 11px; color: var(--text-muted); margin-right: 0.25rem; }

        .chart-filter-btn {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 300;
            text-decoration: none;
            color: var(--text-muted);
            border: 1px solid var(--border);
            background: transparent;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
            white-space: nowrap;
            font-family: 'DM Sans', sans-serif;
        }

        .chart-filter-btn:hover { background: var(--nav-hover); color: var(--accent); border-color: var(--accent); }
        .chart-filter-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }

        /* ── Plata fields container ───────────────────────── */
        .plata-fields-box {
            background: var(--plata-fields-bg);
            padding: 1.25rem;
            border-radius: 14px;
            border: 1px solid var(--plata-fields-border);
            margin-bottom: 1rem;
        }

        /* ── Bon popup ────────────────────────────────────── */
        .bon-popup { background: var(--popup-bg); border: 1px solid var(--popup-border); border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.12); }
        .bon-popup-header { display: flex; justify-content: space-between; align-items: center; padding: 0.6rem 0.9rem; border-bottom: 1px solid var(--border); }
        .bon-popup-label { font-size: 12px; color: var(--text-muted); }
        .bon-popup-open { font-size: 12px; color: var(--accent); text-decoration: none; padding: 0.2rem 0.5rem; border: 1px solid var(--atas-border); border-radius: 5px; }
        .bon-popup-close { background: none; border: none; color: var(--text-muted); font-size: 1.1rem; cursor: pointer; line-height: 1; padding: 0 0.2rem; }

        /* ── PDF/Registre link card ───────────────────────── */
        .year-link-card {
            background: rgba(249,115,22,.07);
            border: 1px solid rgba(249,115,22,.2);
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            text-decoration: none;
            color: var(--text);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s, transform 0.15s;
        }
        .year-link-card:hover { background: rgba(249,115,22,.14); transform: translateY(-1px); color: var(--text); }

        /* ── Loading spinner ──────────────────────────────── */
        @keyframes spin { to { transform: rotate(360deg); } }

        .btn-spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255,255,255,.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            vertical-align: middle;
        }

        /* ── Animations ───────────────────────────────────── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Responsive ───────────────────────────────────── */
        @media (min-width: 768px) {
            .navbar-custom { display: flex; justify-content: space-between; align-items: center; }
            .navbar-top { flex-shrink: 0; }
            .nav-toggler { display: none !important; }
            #navLinks { display: flex !important; flex-direction: row; margin-top: 0; padding-top: 0; border-top: none; }
            #navLinks a, #navLinks button { width: auto; }
            #navLinks .user-info { padding: 0.4rem 0.5rem; }
        }

        @media (max-width: 767px) {
            .nav-toggler { display: flex; }
            .nav-links { display: none; flex-direction: column; align-items: stretch; margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid var(--border); gap: 0.25rem; }
            .nav-links.open { display: flex; }
            .nav-links a, .nav-links button { padding: 0.65rem 1rem; font-size: 14px; text-align: left; width: 100%; }
            .nav-links .user-info { padding: 0.4rem 1rem; font-size: 12px; }
            .page-content { padding: 1rem 0.75rem; }
            .glass-card { padding: 1.25rem 1rem; border-radius: 14px; }
            .page-title { font-size: 1.5rem; }
            .sumar-row { gap: 0.4rem; }
            .sumar-row span { padding: 0.35rem 0.6rem; font-size: 12px; }
            .registru-table { font-size: 12px; }
            .registru-table th { font-size: 10px; padding: 0.3rem 0.2rem; }
            .registru-table td { padding: 0.3rem 0.2rem; }
            .registru-table .col-doc { max-width: 80px; }
            .btn-tbl { font-size: 10px; border-radius: 4px; }
            .badge-incasare, .badge-plata { padding: 0.15rem 0.3rem; font-size: 10px; }
            .charts-grid { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>

<body>

@auth
<nav class="navbar-custom">
    <div class="navbar-top">
        <a href="{{ route('dashboard') }}" class="brand">
            <div class="brand-name">
                <span class="brand-nuva">NUVA</span><span class="brand-dot">.</span>
            </div>
            <span class="brand-tag">"Pentru profesioniști independenți."</span>
        </a>
        <div class="navbar-top-right">
            <button class="nav-toggler"
                    onclick="this.classList.toggle('open');document.getElementById('navLinks').classList.toggle('open');"
                    aria-label="Meniu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
    <div class="nav-links" id="navLinks">
        <a href="{{ route('registru.index') }}">Registrul meu</a>
        <a href="{{ route('registru.create') }}">+ Adaugă</a>
        <a href="{{ route('registre.index') }}">Registre</a>
        <a href="{{ route('pdf.index') }}">Generează PDF</a>
        <a href="{{ route('account.index') }}"
           style="{{ request()->routeIs('account.*') ? 'color:var(--accent);' : '' }}">
            Contul meu
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout" style="cursor:pointer;border-radius:8px;padding:0.4rem 0.85rem;font-size:13px;white-space:nowrap;">
                Logout
            </button>
        </form>
    </div>
</nav>
@endauth

<div class="page-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- PWA install banner --}}
<div id="pwa-banner" style="display:none;position:fixed;bottom:1rem;left:50%;transform:translateX(-50%);z-index:9999;
    background:var(--bg-card);border:1px solid var(--border);border-radius:14px;
    padding:0.85rem 1.1rem;box-shadow:0 8px 32px rgba(0,0,0,.12);
    align-items:center;gap:0.85rem;max-width:340px;width:calc(100% - 2rem);">
    <img src="/apple-touch-icon.png" style="width:40px;height:40px;border-radius:9px;flex-shrink:0;">
    <div style="flex:1;min-width:0;">
        <div style="font-weight:400;font-size:13px;color:var(--text);">NUVA.</div>
        <div id="pwa-banner-msg" style="font-size:12px;color:var(--text-muted);margin-top:0.1rem;"></div>
    </div>
    <div style="display:flex;gap:0.4rem;flex-shrink:0;">
        <button id="pwa-install-btn" style="display:none;background:var(--accent);border:none;color:#fff;
            padding:0.4rem 0.85rem;border-radius:8px;font-size:12px;font-weight:400;cursor:pointer;">
            Instalează
        </button>
        <button onclick="closePwaBanner()" style="background:none;border:none;color:var(--text-muted);
            font-size:1.3rem;cursor:pointer;line-height:1;padding:0 0.2rem;">&times;</button>
    </div>
</div>

<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').catch(function(){});
}

var _deferredPrompt = null;

function closePwaBanner() {
    var b = document.getElementById('pwa-banner');
    if (b) b.style.display = 'none';
    sessionStorage.setItem('pwa-banner-closed', '1');
}

function showBanner(msg, showInstallBtn) {
    if (sessionStorage.getItem('pwa-banner-closed')) return;
    if (window.matchMedia('(display-mode: standalone)').matches) return;
    var b = document.getElementById('pwa-banner');
    if (!b) return;
    document.getElementById('pwa-banner-msg').textContent = msg;
    var btn = document.getElementById('pwa-install-btn');
    if (btn) btn.style.display = showInstallBtn ? 'inline-block' : 'none';
    b.style.display = 'flex';
}

window.addEventListener('beforeinstallprompt', function(e) {
    e.preventDefault();
    _deferredPrompt = e;
    showBanner('Adaugă aplicația pe ecranul principal.', true);
    var btn = document.getElementById('pwa-install-btn');
    if (btn) {
        btn.addEventListener('click', function() {
            _deferredPrompt.prompt();
            _deferredPrompt.userChoice.then(function() {
                _deferredPrompt = null;
                closePwaBanner();
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var isIOS = /iphone|ipad|ipod/i.test(navigator.userAgent);
    var isInApp = window.navigator.standalone === true;
    if (isIOS && !isInApp) {
        showBanner('Apasă ⎙ Share → "Adaugă pe ecran"', false);
    }
});

// ── Loading spinner on form submit ─────────────────────
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form:not([onsubmit])').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            var btn = e.submitter || form.querySelector('[type="submit"]');
            if (!btn || btn.disabled) return;
            btn.disabled = true;
            btn.dataset.origHtml = btn.innerHTML;
            btn.style.minWidth = btn.offsetWidth + 'px';
            btn.innerHTML = '<span class="btn-spinner"></span>';
        });
    });
});
</script>
@stack('scripts')
</body>
</html>
