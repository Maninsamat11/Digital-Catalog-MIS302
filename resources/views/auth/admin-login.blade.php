<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access — Mood Set-Up Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root { 
            /* White Theme Colors aligned with the Mood Set-up Studio palette */
            --bg: #f4f4f7; 
            --surface: #ffffff; 
            --card: #ffffff; 
            --border: rgba(0, 0, 0, 0.08); 
            --accent: #004b4e;     /* Signature Teal */
            --accent2: #ce3530;    /* Signature Red */
            --text: #1c1c1e;       /* Deep Ink */
            --muted: #8e8e93;      /* Muted Gray */
            --danger: #ce3530; 
            --success: #007a56; 
            --white: #ffffff;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        h1,h2 { font-family: 'Syne', sans-serif; }

        .login-wrap { width: 100%; max-width: 420px; }
        .logo { text-align: center; margin-bottom: 2rem; }
        .logo h1 { font-size: 1.4rem; font-weight: 800; color: var(--accent); }
        .logo h1 span { color: var(--accent2); }
        .logo p { color: var(--muted); font-size: 0.875rem; margin-top: 0.3rem; }

        /* Card with clean, subtle shadows */
        .card { 
            background: var(--card); 
            border: 1px solid var(--border); 
            border-radius: 16px; 
            padding: 2.25rem 2rem; 
            box-shadow: 0 10px 30px rgba(0, 75, 78, 0.03), 0 1px 8px rgba(0, 0, 0, 0.02); 
            overflow: hidden; 
        }
        
        /* Tab Styling */
        .tabs { display: flex; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }
        .tab-btn { background: none; border: none; color: var(--muted); font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; cursor: pointer; transition: 0.3s; position: relative; }
        .tab-btn.active { color: var(--accent); }
        .tab-btn.active::after { content: ''; position: absolute; bottom: -1rem; left: 0; width: 100%; height: 2px; background: var(--accent); }

        .form-group { margin-bottom: 1.1rem; }
        .form-group label { display: block; font-size: 0.82rem; color: var(--muted); margin-bottom: 0.4rem; font-weight: 500; }
        .form-control { 
            width: 100%; 
            padding: 0.75rem 0.9rem; 
            background: var(--white); 
            border: 1px solid rgba(0, 0, 0, 0.12); 
            border-radius: 8px; 
            color: var(--text); 
            font-size: 0.9rem; 
            outline: none; 
            transition: all 0.2s ease; 
            font-family: 'DM Sans', sans-serif; 
        }
        .form-control:focus { 
            border-color: var(--accent); 
            box-shadow: 0 0 0 3px rgba(0, 75, 78, 0.08);
        }
        
        .btn-login { 
            width: 100%; 
            padding: 0.8rem; 
            background: var(--accent); 
            color: var(--white); 
            border: none; 
            border-radius: 8px; 
            font-size: 0.95rem; 
            font-weight: 700; 
            cursor: pointer; 
            font-family: 'Syne', sans-serif; 
            margin-top: 0.5rem; 
            transition: background 0.2s, transform 0.1s;
        }
        .btn-login:hover {
            background: #00373a;
        }
        .btn-login:active {
            transform: scale(0.98);
        }
        
        /* Role Selector in light gray palette */
        .role-selector { display: flex; background: rgba(0, 0, 0, 0.04); border-radius: 8px; padding: 4px; margin-bottom: 1.5rem; border: 1px solid rgba(0, 0, 0, 0.05); }
        .role-selector label { flex: 1; text-align: center; padding: 8px; font-size: 0.8rem; cursor: pointer; border-radius: 6px; transition: 0.2s; color: var(--muted); font-weight: 600; }
        .role-selector input { display: none; }
        .role-selector input:checked + span { background: var(--white); color: var(--accent); box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: block; padding: 4px; border-radius: 4px; }

        .hidden { display: none; }
        
        /* Alert Styled for Light Mode Red Palette */
        .alert { 
            padding: 0.75rem 1rem; 
            border-radius: 8px; 
            margin-bottom: 1.25rem; 
            font-size: 0.85rem; 
            background: #fdf1f0; 
            border: 1px solid rgba(206, 53, 48, 0.2); 
            color: var(--danger); 
            font-weight: 500;
        }
        .back-link { text-align: center; margin-top: 1.5rem; font-size: 0.85rem; color: var(--muted); }
        .back-link a { color: var(--accent); text-decoration: none; font-weight: 500; }
        .back-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="logo">
        <h1>Mood Set-up<span>Studio</span></h1>
        <p id="page-subtitle">Access your account</p>
    </div>

    <div class="card">
        <div class="tabs">
            <button class="tab-btn active" onclick="toggleForm('login')">Sign In</button>
        </div>

        @if($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <!-- LOGIN FORM -->
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Admin/Customer Toggle -->
            <div class="role-selector">
                <label>
                    <input type="radio" name="role" value="admin" onchange="updateSub('admin')">
                    <span>Staff Member</span>
                </label>
            </div>

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

    function updateSub(role) {
        const sub = document.getElementById('page-subtitle');
        sub.innerText = role === 'admin' ? "Staff Terminal Access" : "Access your account";
    }
</script>
</body>
</html>