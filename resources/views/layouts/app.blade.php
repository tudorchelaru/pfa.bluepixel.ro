<!DOCTYPE html>
<html lang="ro" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PFA Expenses')</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.ico">

    {{-- PWA: add to home screen --}}
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f172a">
    <meta name="mobile-web-app-capable" content="yes">

    {{-- iOS Safari specific --}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="PFA Expenses">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ── CSS Variables — dark (default) ─────────────── */
        :root,
        [data-theme="dark"] {
            --bg:                  #0f172a;
            --bg-card:             #1e293b;
            --bg-nav:              #1e293b;
            --bg-input:            rgba(255,255,255,0.07);
            --border:              #334155;
            --border-input:        rgba(255,255,255,0.18);
            --accent:              #3b82f6;
            --accent-hover:        #2563eb;
            --text:                #f1f5f9;
            --text-muted:          #94a3b8;
            --text-link:           rgba(241,245,249,0.85);
            --nav-hover:           rgba(255,255,255,0.09);
            --row-hover:           rgba(255,255,255,0.04);
            --shadow:              0 8px 32px rgba(0,0,0,0.4);
            --nav-shadow:          0 1px 0 #334155;
            --select-bg:           #1e293b;
            --badge-plata-bg:      rgba(239,68,68,0.18);
            --badge-plata-border:  rgba(239,68,68,0.45);
            --badge-plata-text:    #fca5a5;
            --badge-inc-bg:        rgba(34,197,94,0.18);
            --badge-inc-border:    rgba(34,197,94,0.45);
            --badge-inc-text:      #86efac;
            --sumar-inc-bg:        rgba(34,197,94,0.1);
            --sumar-inc-border:    rgba(34,197,94,0.3);
            --sumar-pla-bg:        rgba(239,68,68,0.1);
            --sumar-pla-border:    rgba(239,68,68,0.3);
            --sumar-sold-bg:       rgba(255,255,255,0.06);
            --luna-bg:             rgba(15,23,42,0.85);
            --luna-border:         rgba(59,130,246,0.25);
            --luna-accent:         #3b82f6;
            --entry-card-bg:       rgba(255,255,255,0.04);
            --entry-card-border:   rgba(255,255,255,0.09);
            --entry-metoda-bg:     rgba(255,255,255,0.07);
            --btn-logout-bg:       rgba(239,68,68,0.18);
            --btn-logout-border:   rgba(239,68,68,0.4);
            --plata-fields-bg:     rgba(59,130,246,0.08);
            --plata-fields-border: rgba(59,130,246,0.25);
            --atas-bg:             rgba(59,130,246,0.2);
            --atas-border:         rgba(59,130,246,0.45);
            --popup-bg:            #0f172a;
            --popup-border:        rgba(255,255,255,0.15);
        }

        /* ── CSS Variables — light ───────────────────────── */
        [data-theme="light"] {
            --bg:                  #f8fafc;
            --bg-card:             #ffffff;
            --bg-nav:              #ffffff;
            --bg-input:            #f8fafc;
            --border:              #e2e8f0;
            --border-input:        #cbd5e1;
            --text:                #0f172a;
            --text-muted:          #64748b;
            --text-link:           #334155;
            --nav-hover:           rgba(59,130,246,0.07);
            --row-hover:           rgba(0,0,0,0.03);
            --shadow:              0 4px 20px rgba(0,0,0,0.08);
            --nav-shadow:          0 1px 0 #e2e8f0, 0 2px 8px rgba(0,0,0,0.05);
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
            --luna-bg:             #f1f5f9;
            --luna-border:         rgba(59,130,246,0.2);
            --luna-accent:         #3b82f6;
            --entry-card-bg:       #f8fafc;
            --entry-card-border:   #e2e8f0;
            --entry-metoda-bg:     #f1f5f9;
            --btn-logout-bg:       #fee2e2;
            --btn-logout-border:   #fca5a5;
            --plata-fields-bg:     rgba(59,130,246,0.05);
            --plata-fields-border: rgba(59,130,246,0.2);
            --atas-bg:             rgba(59,130,246,0.1);
            --atas-border:         rgba(59,130,246,0.3);
            --popup-bg:            #ffffff;
            --popup-border:        #e2e8f0;
        }

        /* ── Reset & Base ────────────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: var(--bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            transition: background 0.2s ease, color 0.2s ease;
        }

        /* ── Navbar ──────────────────────────────────────── */
        .navbar-custom {
            background: var(--bg-nav);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--nav-shadow);
            padding: 0.75rem 1.25rem;
            transition: background 0.2s ease;
        }

        [data-theme="dark"] .navbar-custom {
            background: linear-gradient(135deg, #1e293b 0%, #162032 100%);
        }

        .navbar-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
        }

        .navbar-custom .brand {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            flex-shrink: 0;
            filter: drop-shadow(0 0 6px rgba(249,212,35,0.6));
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
            background: var(--text);
            border-radius: 2px;
            transition: all 0.3s;
        }

        .navbar-top-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 0.35rem;
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
            font-size: 0.88rem;
            border: none;
            background: none;
            cursor: pointer;
        }

        .nav-links a:hover,
        .nav-links button:hover {
            background: var(--nav-hover);
            color: var(--text);
        }

        .btn-logout {
            background: var(--btn-logout-bg) !important;
            border: 1px solid var(--btn-logout-border) !important;
            color: var(--badge-plata-text) !important;
        }

        .btn-logout:hover {
            background: rgba(239,68,68,0.3) !important;
        }

        /* Theme toggle */
        .btn-theme-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--nav-hover);
            border: 1px solid var(--border);
            cursor: pointer;
            font-size: 1rem;
            padding: 0;
            transition: background 0.2s, border-color 0.2s;
            color: var(--text);
            line-height: 1;
        }

        .btn-theme-toggle:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        /* ── Page layout ─────────────────────────────────── */
        .page-content {
            padding: 1.5rem 1.25rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ── Glass card ──────────────────────────────────── */
        .glass-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            animation: fadeInUp 0.3s ease-out forwards;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        /* ── Page title ──────────────────────────────────── */
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        /* ── Alerts ──────────────────────────────────────── */
        .alert-success-custom {
            background: var(--sumar-inc-bg);
            border: 1px solid var(--sumar-inc-border);
            color: var(--badge-inc-text);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .alert-danger-custom {
            background: var(--sumar-pla-bg);
            border: 1px solid var(--sumar-pla-border);
            color: var(--badge-plata-text);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        /* ── Forms ───────────────────────────────────────── */
        .form-label {
            color: var(--text);
            font-weight: 600;
        }

        .form-control,
        .form-select {
            background: var(--bg-input);
            border: 1.5px solid var(--border-input);
            border-radius: 10px;
            color: var(--text);
            padding: 0.75rem 1rem;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-control::placeholder { color: var(--text-muted); }

        .form-control:focus,
        .form-select:focus {
            background: var(--bg-input);
            border-color: var(--accent);
            color: var(--text);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }

        .form-select option { background: var(--select-bg); color: var(--text); }

        /* ── Buttons ─────────────────────────────────────── */
        .btn-primary-custom {
            background: var(--accent);
            border: none;
            border-radius: 10px;
            color: #fff;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,130,246,0.35);
            color: #fff;
        }

        .btn-danger-custom {
            background: var(--badge-plata-bg);
            border: 1px solid var(--badge-plata-border);
            border-radius: 8px;
            color: var(--badge-plata-text);
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
        }

        .btn-danger-custom:hover {
            background: rgba(239,68,68,0.3);
            color: var(--badge-plata-text);
        }

        .btn-edit-custom {
            background: rgba(234,179,8,0.12);
            border: 1px solid rgba(234,179,8,0.3);
            border-radius: 8px;
            color: var(--text);
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
        }

        .btn-edit-custom:hover {
            background: rgba(234,179,8,0.25);
            color: var(--text);
        }

        /* ── Tables ──────────────────────────────────────── */
        table { color: var(--text); }

        table thead th {
            background: transparent;
            color: var(--text-muted);
            border-color: var(--border);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        table tbody td {
            border-color: var(--border);
            color: var(--text);
            vertical-align: middle;
        }

        table tbody tr {
            transition: background-color 0.15s ease;
        }

        table tbody tr:hover { background: var(--row-hover); }

        /* ── Badges ──────────────────────────────────────── */
        .badge-incasare {
            background: var(--badge-inc-bg);
            border: 1px solid var(--badge-inc-border);
            color: var(--badge-inc-text);
            padding: 0.2rem 0.55rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-plata {
            background: var(--badge-plata-bg);
            border: 1px solid var(--badge-plata-border);
            color: var(--badge-plata-text);
            padding: 0.2rem 0.55rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* ── User info ───────────────────────────────────── */
        .user-info { color: var(--text-muted); font-size: 0.9rem; }

        /* ── Table action buttons ────────────────────────── */
        .btn-tbl {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            border-radius: 6px;
            font-size: 0.8rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            padding: 0.2rem 0.45rem;
            vertical-align: middle;
            white-space: nowrap;
            transition: opacity 0.15s, transform 0.1s;
        }

        .btn-tbl:hover { opacity: 0.82; transform: scale(1.06); }

        .btn-tbl-green  { background: rgba(34,197,94,0.18);  border: 1px solid rgba(34,197,94,0.4) !important;  color: #86efac; }
        .btn-tbl-yellow { background: rgba(234,179,8,0.18);  border: 1px solid rgba(234,179,8,0.4) !important;  color: #fde68a; }
        .btn-tbl-red    { background: rgba(239,68,68,0.18);  border: 1px solid rgba(239,68,68,0.4) !important;  color: #fca5a5; }

        [data-theme="light"] .btn-tbl-green  { color: #15803d; }
        [data-theme="light"] .btn-tbl-yellow { color: #92400e; }
        [data-theme="light"] .btn-tbl-red    { color: #dc2626; }

        /* ── Registru table sizing ───────────────────────── */
        .registru-table { font-size: 0.85rem; }
        .registru-table th { font-size: 0.75rem; white-space: nowrap; padding: 0.4rem 0.5rem; }
        .registru-table td { padding: 0.4rem 0.5rem; vertical-align: middle; }
        .registru-table .col-doc { max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .registru-table .col-suma { white-space: nowrap; font-weight: 600; }
        .registru-table .col-actiuni { white-space: nowrap; }

        /* ── Sumar row ───────────────────────────────────── */
        .sumar-row { display: flex; gap: 0.75rem; flex-wrap: wrap; }
        .sumar-row span { padding: 0.4rem 0.9rem; border-radius: 8px; font-size: 0.88rem; white-space: nowrap; }
        .sumar-inc  { background: var(--sumar-inc-bg);  border: 1px solid var(--sumar-inc-border);  color: var(--badge-inc-text); }
        .sumar-pla  { background: var(--sumar-pla-bg);  border: 1px solid var(--sumar-pla-border);  color: var(--badge-plata-text); }
        .sumar-sold { background: var(--sumar-sold-bg); border: 1px solid var(--border);             color: var(--text); }

        /* ── Luna header ─────────────────────────────────── */
        .luna-section { margin-bottom: 1.75rem; }

        .luna-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 1rem;
            margin-bottom: 0.5rem;
            background: var(--luna-bg);
            border: 1px solid var(--luna-border);
            border-left: 4px solid var(--luna-accent);
            border-radius: 8px;
            transition: background 0.2s;
        }

        .luna-titlu {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .luna-sumar { display: flex; gap: 0.75rem; font-size: 0.85rem; font-weight: 700; }

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

        /* ── Entry cards (mobile) ────────────────────────── */
        .entry-cards { display: flex; flex-direction: column; gap: 0.6rem; }

        .entry-card {
            background: var(--entry-card-bg);
            border: 1px solid var(--entry-card-border);
            border-radius: 12px;
            padding: 0.75rem;
            animation: fadeInUp 0.25s ease-out forwards;
            opacity: 0;
            transition: background 0.2s;
        }

        .entry-card:nth-child(1) { animation-delay: 0.04s; }
        .entry-card:nth-child(2) { animation-delay: 0.08s; }
        .entry-card:nth-child(3) { animation-delay: 0.12s; }
        .entry-card:nth-child(4) { animation-delay: 0.16s; }
        .entry-card:nth-child(5) { animation-delay: 0.20s; }
        .entry-card:nth-child(n+6) { animation-delay: 0.24s; }

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

        .entry-card-data { font-size: 0.8rem; color: var(--text-muted); }

        .entry-card-metoda {
            font-size: 0.75rem;
            color: var(--text-muted);
            background: var(--entry-metoda-bg);
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
        }

        .entry-card-suma { font-size: 1rem; font-weight: 700; white-space: nowrap; color: var(--text); }

        .entry-card-doc { font-size: 0.78rem; color: var(--text-muted); margin-bottom: 0.5rem; word-break: break-word; }

        .entry-card-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-top: 0.1rem;
            padding-top: 0.5rem;
            border-top: 1px solid var(--entry-card-border);
        }

        /* ── Card buttons (mobile) ───────────────────────── */
        .card-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            transition: opacity 0.15s;
        }
        .card-btn:hover { opacity: 0.83; }

        .card-btn-green  { background: rgba(34,197,94,0.18);  border: 1px solid rgba(34,197,94,0.4) !important;  color: #86efac; }
        .card-btn-yellow { background: rgba(234,179,8,0.18);  border: 1px solid rgba(234,179,8,0.4) !important;  color: #fde68a; }
        .card-btn-red    { background: rgba(239,68,68,0.18);  border: 1px solid rgba(239,68,68,0.4) !important;  color: #fca5a5; }

        [data-theme="light"] .card-btn-green  { color: #15803d; }
        [data-theme="light"] .card-btn-yellow { color: #92400e; }
        [data-theme="light"] .card-btn-red    { color: #dc2626; }

        /* ── Attachment badge ────────────────────────────── */
        .atas-badge {
            display: inline-flex;
            align-items: center;
            margin-left: 0.4rem;
            padding: 0.1rem 0.45rem;
            border-radius: 5px;
            font-size: 0.72rem;
            font-weight: 700;
            background: var(--atas-bg);
            border: 1px solid var(--atas-border);
            color: var(--accent);
            cursor: pointer;
            vertical-align: middle;
            white-space: nowrap;
            transition: background 0.15s;
        }
        .atas-badge:hover { background: rgba(59,130,246,0.35); }

        /* ── Charts ──────────────────────────────────────── */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        /* ── Chart period filter ─────────────────────────── */
        .chart-filter-wrap {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .chart-filter-bar {
            display: flex;
            gap: 0.4rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .chart-filter-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-right: 0.25rem;
        }

        .chart-filter-btn {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            color: var(--text-muted);
            border: 1px solid var(--border);
            background: transparent;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
            white-space: nowrap;
        }

        .chart-filter-btn:hover {
            background: var(--nav-hover);
            color: var(--text);
            border-color: var(--accent);
        }

        .chart-filter-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        /* ── Plata fields container ──────────────────────── */
        .plata-fields-box {
            background: var(--plata-fields-bg);
            padding: 1.25rem;
            border-radius: 14px;
            border: 1px solid var(--plata-fields-border);
            margin-bottom: 1rem;
        }

        /* ── Bon popup ───────────────────────────────────── */
        .bon-popup {
            background: var(--popup-bg);
            border: 1px solid var(--popup-border);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }

        .bon-popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0.9rem;
            border-bottom: 1px solid var(--border);
        }

        .bon-popup-label { font-size: 0.82rem; color: var(--text-muted); }

        .bon-popup-open {
            font-size: 0.78rem;
            color: var(--accent);
            text-decoration: none;
            padding: 0.2rem 0.5rem;
            border: 1px solid var(--atas-border);
            border-radius: 5px;
        }

        .bon-popup-close {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.1rem;
            cursor: pointer;
            line-height: 1;
            padding: 0 0.2rem;
        }

        /* ── PDF/Registre link card ──────────────────────── */
        .year-link-card {
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.3);
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            text-decoration: none;
            color: var(--text);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s, transform 0.15s;
        }
        .year-link-card:hover {
            background: rgba(59,130,246,0.22);
            transform: translateY(-1px);
            color: var(--text);
        }

        /* ── Loading spinner ─────────────────────────────── */
        @keyframes spin { to { transform: rotate(360deg); } }

        .btn-spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255,255,255,0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            vertical-align: middle;
        }

        /* ── Animations ──────────────────────────────────── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Responsive ──────────────────────────────────── */
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
            #navLinks a, #navLinks button { width: auto; }
            #navLinks .user-info { padding: 0.4rem 0.5rem; }
        }

        @media (max-width: 767px) {
            .nav-toggler { display: flex; }
            .nav-links {
                display: none;
                flex-direction: column;
                align-items: stretch;
                margin-top: 0.75rem;
                padding-top: 0.75rem;
                border-top: 1px solid var(--border);
                gap: 0.25rem;
            }
            .nav-links.open { display: flex; }
            .nav-links a, .nav-links button {
                padding: 0.65rem 1rem;
                font-size: 0.95rem;
                text-align: left;
                width: 100%;
            }
            .nav-links .user-info { padding: 0.4rem 1rem; font-size: 0.85rem; }
            .page-content { padding: 1rem 0.75rem; }
            .glass-card { padding: 1.25rem 1rem; border-radius: 14px; }
            .page-title { font-size: 1.4rem; }
            .sumar-row { gap: 0.4rem; }
            .sumar-row span { padding: 0.35rem 0.6rem; font-size: 0.8rem; }
            .registru-table { font-size: 0.72rem; }
            .registru-table th { font-size: 0.65rem; padding: 0.3rem 0.2rem; }
            .registru-table td { padding: 0.3rem 0.2rem; }
            .registru-table .col-doc { max-width: 80px; }
            .btn-tbl { font-size: 0.7rem; border-radius: 4px; }
            .badge-incasare, .badge-plata { padding: 0.15rem 0.3rem; font-size: 0.65rem; }
            .charts-grid { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>

{{-- Apply theme before first paint (no flash) --}}
<script>
(function() {
    var saved = localStorage.getItem('pfa-theme');
    var theme;
    if (saved) {
        // User has manually toggled → respect their choice
        theme = saved;
    } else {
        // No manual preference → decide by server hour
        // Dark: 20:00–07:59 | Light: 08:00–19:59
        var hour = {{ date('G') }};
        theme = (hour >= 20 || hour < 8) ? 'dark' : 'light';
    }
    document.documentElement.setAttribute('data-theme', theme);
})();
</script>

<body>

@auth
<nav class="navbar-custom">
    <div class="navbar-top">
        <a href="{{ route('dashboard') }}" class="brand">
            <span class="brand-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <defs>
                        <linearGradient id="coinGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#f9d423"/>
                            <stop offset="100%" style="stop-color:#ff4e50"/>
                        </linearGradient>
                    </defs>
                    <circle cx="12" cy="12" r="10" fill="url(#coinGrad)"/>
                    <text x="12" y="16.5" font-family="Arial" font-size="12" font-weight="900" text-anchor="middle" fill="rgba(255,255,255,0.95)">₣</text>
                </svg>
            </span>
            PFA Expenses
        </a>
        <div class="navbar-top-right">
            <button class="btn-theme-toggle" id="themeToggleBtn" onclick="toggleTheme()" title="Toggle dark/light mode">🌙</button>
            <button class="nav-toggler" onclick="this.classList.toggle('open');document.getElementById('navLinks').classList.toggle('open');" aria-label="Meniu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
    <div class="nav-links" id="navLinks">
        <a href="{{ route('registru.index') }}">Registrul meu</a>
        <a href="{{ route('registru.create') }}">+ Adauga</a>
        <a href="{{ route('registre.index') }}">Registre</a>
        <a href="{{ route('pdf.index') }}">Genereaza PDF</a>
        <span class="user-info" style="padding:0.4rem 0.5rem;">{{ Auth::user()->username }}</span>
        <a href="{{ route('profile.change-password') }}" style="border:1px solid var(--border);">Schimba parola</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout" style="cursor:pointer;border-radius:8px;width:100%;padding:0.4rem 0.85rem;font-size:0.88rem;">Logout</button>
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
    padding:0.85rem 1.1rem;box-shadow:0 8px 32px rgba(0,0,0,0.35);
    display:none;align-items:center;gap:0.85rem;max-width:340px;width:calc(100% - 2rem);">
    <img src="/apple-touch-icon.png" style="width:40px;height:40px;border-radius:9px;flex-shrink:0;">
    <div style="flex:1;min-width:0;">
        <div style="font-weight:700;font-size:0.88rem;color:var(--text);">PFA Expenses</div>
        <div id="pwa-banner-msg" style="font-size:0.78rem;color:var(--text-muted);margin-top:0.1rem;"></div>
    </div>
    <div style="display:flex;gap:0.4rem;flex-shrink:0;">
        <button id="pwa-install-btn" style="display:none;background:var(--accent);border:none;color:#fff;
            padding:0.4rem 0.85rem;border-radius:8px;font-size:0.82rem;font-weight:600;cursor:pointer;">
            Instalează
        </button>
        <button onclick="closePwaBanner()" style="background:none;border:none;color:var(--text-muted);
            font-size:1.3rem;cursor:pointer;line-height:1;padding:0 0.2rem;">&times;</button>
    </div>
</div>

<script>
// ── Service Worker ────────────────────────────────────
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').catch(function(){});
}

// ── PWA Install banner ────────────────────────────────
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

// Android Chrome: captureaza evenimentul de install
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

// iOS Safari: nu are prompt automat, afisam instructiuni
document.addEventListener('DOMContentLoaded', function() {
    var isIOS = /iphone|ipad|ipod/i.test(navigator.userAgent);
    var isInApp = window.navigator.standalone === true;
    if (isIOS && !isInApp) {
        showBanner('Apasă   ⎙ Share  →  "Adaugă pe ecran"', false);
    }
});

// ── Dark / Light toggle ───────────────────────────────
function toggleTheme() {
    var html = document.documentElement;
    var current = html.getAttribute('data-theme') || 'dark';
    var next = current === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('pfa-theme', next);
    updateToggleIcon(next);
    // Notify charts if present
    if (typeof onThemeChange === 'function') onThemeChange(next);
}

function updateToggleIcon(theme) {
    var btn = document.getElementById('themeToggleBtn');
    if (btn) btn.textContent = theme === 'dark' ? '🌙' : '☀️';
}

// Set correct icon immediately
(function() {
    var t = localStorage.getItem('pfa-theme') || 'dark';
    updateToggleIcon(t);
})();

// ── Loading spinner on form submit ────────────────────
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
