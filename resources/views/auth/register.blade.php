<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cont nou — NUVA.</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg?v=20260324-1">
<link rel="shortcut icon" href="/favicon.ico?v=20260324-1">
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
.finput.is-invalid { border-color: #fca5a5; }
.field-error { font-size: 12px; color: #dc2626; margin-top: 4px; }

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

.login-link {
  text-align: center;
  margin-top: 1.25rem;
  font-size: 13px;
  font-weight: var(--w-light);
  color: var(--muted);
}
.login-link a {
  color: var(--orange);
  text-decoration: none;
  font-weight: var(--w-reg);
}
.login-link a:hover { color: var(--orange-d); }
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

  <h1>Creează cont gratuit</h1>
  <p class="subtitle">Înregistrare rapidă, fără card de credit.</p>

  @if ($errors->any())
    <div class="error-box">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('register.post') }}">
    @csrf

    <div class="fgroup">
      <label class="flabel" for="first_name">Nume</label>
      <input class="finput @error('first_name') is-invalid @enderror"
             type="text" id="first_name" name="first_name"
             value="{{ old('first_name') }}"
             placeholder="ex: Popescu" autocomplete="given-name" required autofocus>
      @error('first_name')
        <p class="field-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="fgroup">
      <label class="flabel" for="last_name">Prenume</label>
      <input class="finput @error('last_name') is-invalid @enderror"
             type="text" id="last_name" name="last_name"
             value="{{ old('last_name') }}"
             placeholder="ex: Tudor" autocomplete="family-name" required>
      @error('last_name')
        <p class="field-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="fgroup">
      <label class="flabel" for="username">Username</label>
      <input class="finput @error('username') is-invalid @enderror"
             type="text" id="username" name="username"
             value="{{ old('username') }}"
             placeholder="ex: tudor.popescu" autocomplete="username" required>
      @error('username')
        <p class="field-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="fgroup">
      <label class="flabel" for="email">Email</label>
      <input class="finput @error('email') is-invalid @enderror"
             type="email" id="email" name="email"
             value="{{ old('email') }}"
             placeholder="tudor@exemplu.ro" autocomplete="email" required>
      @error('email')
        <p class="field-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="fgroup">
      <label class="flabel" for="password">Parolă</label>
      <input class="finput @error('password') is-invalid @enderror"
             type="password" id="password" name="password"
             placeholder="Minim 8 caractere" autocomplete="new-password" required>
      @error('password')
        <p class="field-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="fgroup">
      <label class="flabel" for="password_confirmation">Confirmă parola</label>
      <input class="finput"
             type="password" id="password_confirmation" name="password_confirmation"
             placeholder="••••••••" autocomplete="new-password" required>
    </div>

    <button type="submit" class="fsubmit">Creează cont →</button>
  </form>

  <p class="login-link">
    Ai deja cont? <a href="{{ route('login') }}">Autentifică-te</a>
  </p>
</div>
</body>
</html>
