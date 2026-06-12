{{-- resources/views/auth/reset-password.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Street 360 Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy-deep:  #0f1d3a;
            --navy-mid:   #152445;
            --navy-card:  #1a2d52;
            --navy-input: #c8cdd8;
            --gold:       #c8922a;
            --white:      #ffffff;
            --muted:      rgba(255,255,255,.45);
            --green:      #3a8c3f;
            --green-h:    #2e7233;
            --text-input: #1a2d52;
        }

        html, body {
            min-height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--navy-mid);
            color: var(--white);
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(200,146,42,.10) 0%, transparent 65%);
            pointer-events: none;
        }

        .page-wrap {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 0 24px 60px;
            max-width: 520px;
            margin: 0 auto;
        }

        /* Back link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-top: 38px;
            opacity: .8;
            transition: opacity .2s;
        }
        .back-link:hover { opacity: 1; }

        /* Heading */
        .heading { margin-top: 22px; }
        .heading h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(26px, 7vw, 36px);
            font-weight: 700;
            color: var(--white);
            letter-spacing: .01em;
        }
        .heading p {
            margin-top: 4px;
            font-size: 13px;
            color: var(--muted);
        }

        /* User badge */
        .user-badge {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--navy-card);
            border-radius: 8px;
            padding: 14px 18px;
            margin-top: 24px;
        }
        .avatar {
            width: 40px; height: 40px;
            background: #6b7ba4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            color: var(--white);
            flex-shrink: 0;
        }
        .user-badge span {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .06em;
            color: var(--gold);
        }

        /* Form section */
        .form-section { margin-top: 28px; }

        .field + .field { margin-top: 16px; }
        .field label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .field input {
            width: 100%;
            background: var(--navy-input);
            border: none;
            border-radius: 8px;
            padding: 13px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text-input);
            outline: none;
            transition: box-shadow .2s;
        }
        .field input::placeholder { color: #7a8aaa; }
        .field input:focus {
            box-shadow: 0 0 0 2px var(--gold);
        }

        .pw-wrap { position: relative; }
        .pw-wrap input { padding-right: 44px; }
        .pw-eye {
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: #7a8aaa;
            cursor: pointer;
            transition: color .2s;
        }
        .pw-eye:hover { color: var(--gold); }

        /* Alert */
        .alert-error {
            background: rgba(200,50,50,.15);
            border: 1px solid rgba(200,50,50,.35);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 13px;
            color: #f97676;
            margin-bottom: 18px;
        }
        .alert-success {
            background: rgba(58,140,63,.15);
            border: 1px solid rgba(58,140,63,.35);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 13px;
            color: #7de080;
            margin-bottom: 18px;
        }

        /* Submit */
        .btn-submit {
            display: block;
            width: 50%;
            margin: 32px auto 0;
            background: var(--green);
            border: none;
            border-radius: 9px;
            padding: 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #fff;
            cursor: pointer;
            transition: background .2s, transform .1s;
            box-shadow: 0 4px 18px rgba(58,140,63,.3);
        }
        .btn-submit:hover { background: var(--green-h); }
        .btn-submit:active { transform: scale(.98); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-wrap > * { animation: fadeUp .35s ease both; }
        .back-link    { animation-delay: .05s; }
        .heading      { animation-delay: .10s; }
        .user-badge   { animation-delay: .15s; }
        .form-section { animation-delay: .20s; }
    </style>
</head>
<body>
<div class="page-wrap">

    <a href="{{ route('admin.akun') }}" class="back-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Kelola Akun Admin
    </a>

    <div class="heading">
        <h1>Reset Password</h1>
        <p>Ganti Password Akun Admin</p>
    </div>

    <div class="user-badge">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}</div>
        <span>{{ strtoupper(auth()->user()->username ?? 'ADMIN123') }}</span>
    </div>

    <div class="form-section">

        @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
        @endif
        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.akun.reset-password') }}">
            @csrf

            <div class="field">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama Lengkap"
                       value="{{ old('nama', auth()->user()->name ?? '') }}">
            </div>

            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="Admin123@gmail.com"
                       value="{{ old('email', auth()->user()->email ?? '') }}">
            </div>

            <div class="field">
                <label>Password</label>
                <div class="pw-wrap">
                    <input type="password" id="pw1" name="password" placeholder="Password Baru">
                    <button type="button" class="pw-eye" onclick="togglePw('pw1','eye1')">
                        <svg id="eye1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="field">
                <label>Konfirmasi Ulang</label>
                <div class="pw-wrap">
                    <input type="password" id="pw2" name="password_confirmation" placeholder="Ulangi Password">
                    <button type="button" class="pw-eye" onclick="togglePw('pw2','eye2')">
                        <svg id="eye2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">SIMPAN</button>
        </form>
    </div>

</div>
<script>
function togglePw(id, eyeId) {
    const inp = document.getElementById(id);
    const eye = document.getElementById(eyeId);
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    eye.innerHTML = show
        ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
}
</script>
</body>
</html>