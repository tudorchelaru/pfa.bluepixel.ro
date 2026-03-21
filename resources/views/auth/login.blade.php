<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PFA Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            border-radius: 24px;
            padding: 2.5rem;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 420px;
        }
        .login-title {
            text-align: center;
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            text-align: center;
            color: rgba(255,255,255,0.7);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }
        .form-label { color: rgba(255,255,255,0.95); font-weight: 600; }
        .form-control {
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 12px;
            color: #fff;
            padding: 0.875rem 1.25rem;
            font-size: 1rem;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.5); }
        .form-control:focus {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.5);
            color: #fff;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.1);
        }
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(102,126,234,0.5); }
        .error-msg {
            background: rgba(220,53,69,0.2);
            border: 1px solid rgba(220,53,69,0.5);
            color: #fff;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .mb-3 { margin-bottom: 1.25rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1 class="login-title">PFA Expenses</h1>
        <p class="login-subtitle">Autentifica-te pentru a continua</p>

        @if ($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
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
</body>
</html>
