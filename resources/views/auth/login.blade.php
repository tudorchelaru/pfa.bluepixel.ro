<!DOCTYPE html>
<html lang="ro" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PFA Expenses</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.ico">

    {{-- PWA --}}
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f172a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="PFA Expenses">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <style>
        :root, [data-theme="dark"] {
            --bg:           #0f172a;
            --bg-card:      #1e293b;
            --border:       #334155;
            --border-input: rgba(255,255,255,0.18);
            --accent:       #3b82f6;
            --accent-hover: #2563eb;
            --text:         #f1f5f9;
            --text-muted:   #94a3b8;
            --input-bg:     rgba(255,255,255,0.07);
            --error-bg:     rgba(239,68,68,0.15);
            --error-border: rgba(239,68,68,0.4);
            --error-text:   #fca5a5;
            --shadow:       0 20px 60px rgba(0,0,0,0.5);
        }
        [data-theme="light"] {
            --bg:           #f8fafc;
            --bg-card:      #ffffff;
            --border:       #e2e8f0;
            --border-input: #cbd5e1;
            --text:         #0f172a;
            --text-muted:   #64748b;
            --input-bg:     #f8fafc;
            --error-bg:     #fee2e2;
            --error-border: #fca5a5;
            --error-text:   #dc2626;
            --shadow:       0 20px 60px rgba(0,0,0,0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background 0.2s;
        }

        .login-wrap {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }

        .login-card {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 2.5rem;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            animation: fadeInUp 0.35s ease-out forwards;
            transition: background 0.2s, border-color 0.2s;
        }

        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .login-logo-icon {
            filter: drop-shadow(0 0 8px rgba(249,212,35,0.7));
        }

        .login-title {
            text-align: center;
            color: var(--text);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .login-subtitle {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 0.92rem;
        }

        .form-label {
            display: block;
            color: var(--text);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }

        .form-control {
            width: 100%;
            background: var(--input-bg);
            border: 1.5px solid var(--border-input);
            border-radius: 12px;
            color: var(--text);
            padding: 0.875rem 1.1rem;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            font-family: inherit;
        }

        .form-control::placeholder { color: var(--text-muted); }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }

        .mb-3 { margin-bottom: 1.25rem; }

        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: var(--accent);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            margin-top: 0.5rem;
            font-family: inherit;
        }

        .btn-login:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(59,130,246,0.35);
        }

        .error-msg {
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        .theme-toggle-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.25rem;
        }

        .btn-theme-sm {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255,255,255,0.06);
            border: 1px solid var(--border);
            cursor: pointer;
            font-size: 0.95rem;
            padding: 0;
            transition: background 0.2s;
        }

        .btn-theme-sm:hover { background: var(--accent); border-color: var(--accent); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<script>
(function() {
    var saved = localStorage.getItem('pfa-theme');
    var theme;
    if (saved) {
        theme = saved;
    } else {
        var hour = {{ date('G') }};
        theme = (hour >= 20 || hour < 8) ? 'dark' : 'light';
    }
    document.documentElement.setAttribute('data-theme', theme);
})();
</script>
<body>
    <div class="login-wrap">
        <div class="login-card">
            <div class="theme-toggle-row">
                <button class="btn-theme-sm" id="loginThemeBtn" onclick="loginToggleTheme()" title="Toggle dark/light">🌙</button>
            </div>

            <div class="login-logo">
                <svg class="login-logo-icon" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none">
                    <defs>
                        <linearGradient id="cg" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#f9d423"/>
                            <stop offset="100%" style="stop-color:#ff4e50"/>
                        </linearGradient>
                    </defs>
                    <circle cx="12" cy="12" r="10" fill="url(#cg)"/>
                    <text x="12" y="16.5" font-family="Arial" font-size="12" font-weight="900" text-anchor="middle" fill="rgba(255,255,255,0.95)">₣</text>
                </svg>
            </div>
            <h1 class="login-title">PFA Expenses</h1>
            <p class="login-subtitle">Autentifica-te pentru a continua</p>

            @if ($errors->any())
                <div class="error-msg">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ old('username') }}" required autofocus placeholder="ex: tudor">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Parola</label>
                    <input type="password" class="form-control" id="password" name="password"
                        required placeholder="••••••••">
                </div>
                <button type="submit" class="btn-login">Intra in cont</button>
            </form>
        </div>
    </div>

    <script>
    function loginToggleTheme() {
        var html = document.documentElement;
        var next = (html.getAttribute('data-theme') || 'dark') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('pfa-theme', next);
        document.getElementById('loginThemeBtn').textContent = next === 'dark' ? '🌙' : '☀️';
    }
    (function() {
        var t = localStorage.getItem('pfa-theme') || 'dark';
        document.getElementById('loginThemeBtn').textContent = t === 'dark' ? '🌙' : '☀️';
    })();
    </script>
</body>
</html>
