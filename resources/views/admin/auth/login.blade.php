<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portfolio CMS</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #050508; --surface: #0d0d1a; --border: #1e293b; --border2: #334155;
            --text: #cbd5e1; --muted: #64748b; --cyan: #22d3ee; --cyan-dim: rgba(34,211,238,.12);
            --purple: #a78bfa; --red: #f43f5e;
        }
        html, body { height: 100%; font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); font-size: 14px; }
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-card {
            width: 100%; max-width: 400px; background: var(--surface);
            border: 1px solid var(--border); border-radius: 1rem; padding: 2.5rem 2rem;
        }
        .login-logo {
            display: flex; align-items: center; gap: .75rem; margin-bottom: 2rem;
        }
        .login-logo-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1.1rem; color: #050508;
        }
        .login-logo-text { font-weight: 600; font-size: 1.1rem; color: var(--text); }
        h1 { font-size: 1.4rem; font-weight: 700; margin-bottom: .4rem; }
        .subtitle { font-size: .85rem; color: var(--muted); margin-bottom: 1.75rem; }
        .form-group { display: flex; flex-direction: column; gap: .4rem; margin-bottom: 1rem; }
        label { font-size: .8rem; font-weight: 500; color: var(--text); }
        input {
            width: 100%; padding: .6rem .9rem; background: var(--bg);
            border: 1px solid var(--border2); border-radius: .45rem;
            color: var(--text); font-size: .875rem; outline: none; transition: border-color .15s;
        }
        input:focus { border-color: var(--cyan); }
        .remember { display: flex; align-items: center; gap: .5rem; font-size: .82rem; color: var(--muted); margin-bottom: 1.25rem; }
        .remember input[type=checkbox] { width: 15px; height: 15px; accent-color: var(--cyan); }
        .btn {
            width: 100%; padding: .65rem 1rem; background: var(--cyan); color: #050508;
            border: none; border-radius: .45rem; font-size: .875rem; font-weight: 600;
            cursor: pointer; transition: background .15s;
        }
        .btn:hover { background: #67e8f9; }
        .alert-error {
            background: rgba(244,63,94,.1); color: var(--red); border: 1px solid rgba(244,63,94,.25);
            border-radius: .45rem; padding: .75rem 1rem; font-size: .82rem; margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo">
        <div class="login-logo-icon">P</div>
        <div class="login-logo-text">Portfolio CMS</div>
    </div>
    <h1>Welcome back</h1>
    <p class="subtitle">Sign in to your admin dashboard</p>

    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn">Sign In</button>
    </form>
</div>
</body>
</html>
