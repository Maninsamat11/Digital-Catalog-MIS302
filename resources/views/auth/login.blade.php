<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access — TechVault</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root { --bg:#0a0a0f; --surface:#111118; --card:#16161f; --border:#22222e; --accent:#6c63ff; --accent2:#00e5c0; --text:#e8e8f0; --muted:#666678; --danger:#ff4f6d; --success:#00e5c0; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        h1,h2 { font-family: 'Syne', sans-serif; }

        .login-wrap { width: 100%; max-width: 420px; }
        .logo { text-align: center; margin-bottom: 2rem; }
        .logo h1 { font-size: 1.8rem; font-weight: 800; }
        .logo h1 span { color: var(--accent2); }
        .logo p { color: var(--muted); font-size: 0.875rem; margin-top: 0.3rem; }

        .card { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 2rem; overflow: hidden; }
        
        /* Tab Styling */
        .tabs { display: flex; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }
        .tab-btn { background: none; border: none; color: var(--muted); font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; cursor: pointer; transition: 0.3s; position: relative; }
        .tab-btn.active { color: var(--accent2); }
        .tab-btn.active::after { content: ''; position: absolute; bottom: -1rem; left: 0; width: 100%; height: 2px; background: var(--accent2); }

        .form-group { margin-bottom: 1.1rem; }
        .form-group label { display: block; font-size: 0.82rem; color: var(--muted); margin-bottom: 0.4rem; }
        .form-control { width: 100%; padding: 0.7rem 0.9rem; background: var(--surface); border: 1px solid var(--border); border-radius: 8px; color: var(--text); font-size: 0.9rem; outline: none; transition: border-color 0.2s; font-family: 'DM Sans', sans-serif; }
        .form-control:focus { border-color: var(--accent); }
        
        .btn-login { width: 100%; padding: 0.75rem; background: var(--accent); color: #fff; border: none; border-radius: 8px; font-size: 0.95rem; font-weight: 600; cursor: pointer; font-family: 'Syne', sans-serif; margin-top: 0.5rem; }
        
        .role-selector { display: flex; background: var(--surface); border-radius: 8px; padding: 4px; margin-bottom: 1.5rem; border: 1px solid var(--border); }
        .role-selector label { flex: 1; text-align: center; padding: 8px; font-size: 0.8rem; cursor: pointer; border-radius: 6px; transition: 0.2s; color: var(--muted); font-weight: 600; }
        .role-selector input { display: none; }
        .role-selector input:checked + span { background: var(--card); color: var(--accent2); box-shadow: 0 2px 10px rgba(0,0,0,0.3); display: block; padding: 4px; border-radius: 4px; }

        .hidden { display: none; }
        .alert { padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem; background: rgba(255,79,109,0.1); border: 1px solid var(--danger); color: var(--danger); }
        .back-link { text-align: center; margin-top: 1.25rem; font-size: 0.85rem; color: var(--muted); }
        .back-link a { color: var(--accent); text-decoration: none; }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="logo">
        <h1>Mood Set-Up<span>Studio</span></h1>
        <p id="page-subtitle">Access your account</p>
    </div>

    <div class="card">
        <div class="tabs">
            <button class="tab-btn active" onclick="toggleForm('login')">Sign In</button>
            <button class="tab-btn" onclick="toggleForm('register')">Sign Up</button>
        </div>

        @if($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <!-- LOGIN FORM -->
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            
        

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-login">Enter</button>
        </form>

        <!-- REGISTER FORM (Hidden by default) -->
        <form id="register-form" class="hidden" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Create Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn-login" style="background: var(--accent2); color: #000;">Create Account</button>
        </form>
    </div>

    <p class="back-link"><a href="{{ route('home') }}">← Back to Store</a></p>
</div>

<script>
    function toggleForm(type) {
        const loginForm = document.getElementById('login-form');
        const regForm = document.getElementById('register-form');
        const sub = document.getElementById('page-subtitle');
        const btns = document.querySelectorAll('.tab-btn');

        btns.forEach(b => b.classList.remove('active'));

        if(type === 'login') {
            loginForm.classList.remove('hidden');
            regForm.classList.add('hidden');
            btns[0].classList.add('active');
            sub.innerText = "Access your account";
        } else {
            loginForm.classList.add('hidden');
            regForm.classList.remove('hidden');
            btns[1].classList.add('active');
            sub.innerText = "Join TechVault Community";
        }
    }

    
</script>
</body>
</html>