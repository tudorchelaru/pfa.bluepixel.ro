<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Autentificare — NUVA.</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg?v=20260324-1">
<link rel="shortcut icon" href="/favicon.ico?v=20260324-1">
<link rel="manifest" href="/manifest.json?v=20260324-2">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="NUVA">
<link rel="apple-touch-icon" href="/pwa-icon-192.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,200;9..40,300;9..40,400&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:       #f7f5f0;
  --white:    #ffffff;
  --text:     #111111;
  --muted:    #8a8a8a;
  --border:   #e8e4dc;
  --orange:   #f97316;
  --orange-d: #ea580c;
  --font:     'DM Sans', sans-serif;
  --w-thin:   200;
  --w-light:  300;
  --w-reg:    400;
}

body {
  font-family: var(--font);
  font-weight: var(--w-light);
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem 1rem;
  -webkit-font-smoothing: antialiased;
}

@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 24px;
  padding: 2.5rem;
  width: 100%;
  max-width: 420px;
  animation: fadeUp .35s ease both;
}

/* Logo */
.logo-wrap { display: flex; flex-direction: column; align-items: center; gap: 3px; text-decoration: none; margin-bottom: 2rem; }
.logo-brand { display: flex; align-items: baseline; gap: 1px; }
.logo-text  { font-family: var(--font); font-weight: var(--w-reg); font-size: 26px; letter-spacing: 6.6px; text-transform: uppercase; color: var(--text); line-height: 1; }
.logo-dot   { font-family: var(--font); font-weight: var(--w-reg); font-size: 44px; color: var(--orange); line-height: 1; letter-spacing: 0; }
.logo-tag   { font-family: var(--font); font-weight: var(--w-light); font-size: 12px; letter-spacing: .01em; color: var(--muted); font-style: italic; }

h1 {
  font-family: var(--font);
  font-weight: var(--w-thin);
  font-size: 26px;
  letter-spacing: -.3px;
  text-align: center;
  margin-bottom: .25rem;
  color: var(--text);
}
.subtitle {
  font-size: 13px;
  font-weight: var(--w-light);
  color: var(--muted);
  text-align: center;
  margin-bottom: 1.75rem;
  letter-spacing: .03em;
}

.error-box {
  background: #fee2e2;
  border: 1px solid #fca5a5;
  color: #dc2626;
  border-radius: 10px;
  padding: 10px 14px;
  font-size: 13px;
  margin-bottom: 1rem;
}
.success-box {
  background: #dcfce7;
  border: 1px solid #86efac;
  color: #166534;
  border-radius: 10px;
  padding: 10px 14px;
  font-size: 13px;
  margin-bottom: 1rem;
}

.fgroup { margin-bottom: 1rem; }
.flabel {
  display: block;
  font-size: 12px;
  font-weight: var(--w-light);
  letter-spacing: .08em;
  text-transform: uppercase;
  color: #888;
  margin-bottom: 6px;
}
.finput {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  font-family: var(--font);
  font-weight: var(--w-light);
  font-size: 14px;
  color: var(--text);
  background: #fafaf9;
  outline: none;
  transition: border-color .2s, box-shadow .2s;
}
.finput:focus {
  border-color: var(--orange);
  box-shadow: 0 0 0 3px rgba(249,115,22,.1);
  background: var(--white);
}

.fsubmit {
  width: 100%;
  padding: 12px;
  background: var(--orange);
  border: none;
  border-radius: 12px;
  font-family: var(--font);
  font-weight: var(--w-reg);
  font-size: 14px;
  letter-spacing: .06em;
  color: #fff;
  cursor: pointer;
  margin-top: .5rem;
  transition: all .2s;
}
.fsubmit:hover { background: var(--orange-d); transform: translateY(-1px); }

.register-link {
  text-align: center;
  margin-top: 1.25rem;
  font-size: 13px;
  font-weight: var(--w-light);
  color: var(--muted);
}
.register-link a {
  color: var(--orange);
  text-decoration: none;
  font-weight: var(--w-reg);
}
.register-link a:hover { color: var(--orange-d); }
</style>
</head>
<body>
<div class="card">
  <a href="{{ route('home') }}" class="logo-wrap">
    <div class="logo-brand">
      <span class="logo-text">NUVA</span><span class="logo-dot">.</span>
    </div>
    <span class="logo-tag">"Pentru profesioniști independenți."</span>
  </a>

  <h1>Intră în cont</h1>
  <p class="subtitle">Autentifică-te pentru a continua.</p>

  @if (session('success'))
    <div class="success-box">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="error-box">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div class="fgroup">
      <label class="flabel" for="username">Username</label>
      <input class="finput" type="text" id="username" name="username"
             value="{{ old('username') }}"
             placeholder="ex: tudor" autocomplete="username" required autofocus>
    </div>

    <div class="fgroup">
      <label class="flabel" for="password">Parolă</label>
      <input class="finput" type="password" id="password" name="password"
             placeholder="••••••••" autocomplete="current-password" required>
    </div>

    <button type="submit" class="fsubmit">Intră în cont →</button>
  </form>

  <p class="register-link">
    Nu ai cont? <a href="{{ route('register') }}">Creează unul gratuit</a>
  </p>
</div>
</body>
</html>
