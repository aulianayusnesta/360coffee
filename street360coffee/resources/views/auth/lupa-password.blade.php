<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Street 360.coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg-top:  #0f1d3a;
            --bg-bot:  #1a2d6b;
            --card-bg: #16234d;
            --badge-bg:#1e306e;
            --inp-bg:  #cdd2e8;
            --gold:    #d4a843;
            --green:   #3ea845;
            --green-h: #2f8836;
            --white:   #ffffff;
            --muted:   rgba(255,255,255,0.52);
            --label:   rgba(255,255,255,0.58);
            --font:    'Poppins', sans-serif;
        }

        html, body {
            min-height: 100%;
            font-family: var(--font);
            background: linear-gradient(170deg, var(--bg-top) 0%, var(--bg-bot) 100%);
            background-attachment: fixed;
            color: var(--white);
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .top-bar {
            width: 100%;
            max-width: 420px;
            padding: 20px 20px 0;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--white);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            opacity: .82;
        }

        .page-heading {
            width: 100%;
            max-width: 420px;
            padding: 14px 20px 0;
        }
        .page-heading h1 {
            font-size: 28px;
            font-weight: 900;
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 2px;
        }
        .page-heading p {
            font-size: 12px;
            color: var(--muted);
        }

        .card {
            width: 100%;
            max-width: 420px;
            margin: 16px 20px 30px;
            background: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 20px 18px 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.35);
        }

        .step-hint {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .account-badge {
            display: flex;
            align-items: stretch;
            background: var(--badge-bg);
            border-radius: 7px;
            overflow: hidden;
            margin-bottom: 16px;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .badge-avatar {
            width: 42px;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; font-weight: 900;
            color: #0f1d3a;
            flex-shrink: 0;
        }
        .badge-name {
            padding: 11px 14px;
            font-size: 13px; font-weight: 700;
            color: var(--gold);
            letter-spacing: 2px;
            text-transform: uppercase;
            display: flex; align-items: center;
        }

        .field { margin-bottom: 10px; }
        .field-label {
            display: block;
            font-size: 9px; font-weight: 700;
            color: var(--label);
            letter-spacing: 1.6px; text-transform: uppercase;
            margin-bottom: 4px;
        }
        .field-input {
            width: 100%;
            padding: 10px 12px;
            background: var(--inp-bg);
            border: 1.5px solid transparent;
            border-radius: 6px;
            color: #1a1a2e;
            font-family: var(--font); font-size: 13px; font-weight: 500;
            outline: none;
            transition: border-color .2s;
        }
        .field-input::placeholder { color: rgba(26,26,46,0.42); }
        .field-input:focus { border-color: var(--gold); }
        .field-input.is-error { border-color: #e05050 !important; }
        .field-input.is-ok    { border-color: #3ea845 !important; }

        .field-hint {
            font-size: 11px;
            margin-top: 4px;
            padding-left: 2px;
            min-height: 16px;
            line-height: 1.5;
        }
        .field-hint.error { color: #ff8a8a; }
        .field-hint.ok    { color: #7de080; }
        .field-hint.gold  { color: var(--gold); }
        .field-hint.warn  { color: #f0b554; }

        .alert-error {
            padding: 9px 12px;
            background: rgba(220,50,50,0.12);
            border: 1px solid rgba(220,50,50,0.28);
            border-radius: 6px;
            font-size: 12px; color: #ff8a8a;
            margin-bottom: 12px; line-height: 1.5;
        }

        .btn-submit {
            display: block; width: 100%; padding: 13px;
            background: var(--green); color: var(--white);
            font-family: var(--font); font-size: 13px; font-weight: 800;
            letter-spacing: 2.5px; text-transform: uppercase;
            border: none; border-radius: 8px; cursor: pointer;
            margin-top: 18px; text-align: center; text-decoration: none;
            transition: background .2s, transform .15s;
            box-shadow: 0 4px 16px rgba(62,168,69,0.32);
        }
        .btn-submit:hover  { background: var(--green-h); }
        .btn-submit:active { transform: scale(.98); }

        .success-wrap { text-align: center; padding: 14px 0 8px; }
        .success-icon {
            width: 56px; height: 56px; border-radius: 50%;
            background: rgba(62,168,69,0.16); border: 2px solid var(--green);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px; font-size: 22px; color: var(--green);
        }
        .success-wrap p { font-size: 13px; color: #7de080; line-height: 1.85; }
        .success-wrap .info-box {
            margin-top: 14px;
            background: rgba(212,168,67,0.1);
            border: 1px solid rgba(212,168,67,0.25);
            border-radius: 8px;
            padding: 12px 14px;
            text-align: left;
        }
        .success-wrap .info-box p {
            font-size: 12px;
            color: var(--gold);
            line-height: 1.7;
            margin-bottom: 4px;
        }
        .success-wrap .info-box p:last-child { margin-bottom: 0; }
        .success-wrap .info-box span {
            font-weight: 700;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="page">

    <div class="top-bar">
        @if(session('email_verified') && !session('password_changed'))
            <a href="{{ route('login') }}" class="back-link">← Kembali ke Login</a>
        @else
            <a href="{{ route('login') }}" class="back-link">← Kembali ke Login</a>
        @endif
    </div>

    <div class="page-heading">
        <h1>Lupa Password</h1>
        @if(session('password_changed'))
            <p>Data akun berhasil diperbarui</p>
        @elseif(session('email_verified'))
            <p>Reset password akun Admin / Kasir</p>
        @else
            <p>Reset password akun Admin / Kasir</p>
        @endif
    </div>

    <div class="card">

        {{-- STEP 1 — Verifikasi Email --}}
        @if(!session('email_verified') && !session('password_changed'))
            <p class="step-hint">Masukkan email yang terdaftar di akun Admin atau Kasir.</p>

            @if($errors->has('email'))
                <div class="alert-error">⚠ {{ $errors->first('email') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email.check') }}" autocomplete="off" novalidate>
                @csrf
                {{-- Dummy fields untuk mencegah autofill browser --}}
                <input type="text"     name="_dummy_user" style="display:none" tabindex="-1" autocomplete="off">
                <input type="password" name="_dummy_pass" style="display:none" tabindex="-1" autocomplete="off">

                <div class="field">
                    <label class="field-label">Email</label>
                    <input type="email" name="email" id="emailInput" class="field-input"
                           placeholder="Masukkan email terdaftar"
                           value="{{ old('email') }}"
                           autocomplete="off"
                           autofocus>
                    <div class="field-hint" id="emailHint"></div>
                </div>
                <button type="submit" class="btn-submit" onclick="return checkEmailFront()">Verifikasi Email</button>
            </form>
        @endif

        {{-- STEP 2 — Buat Password Baru --}}
        @if(session('email_verified') && !session('password_changed'))
            @php
                $em    = session('email_verified');
                $user  = \App\Models\User::where('email', $em)->first();
                $uname = $user->username ?? explode('@', $em)[0];
            @endphp

            <div class="account-badge">
                <div class="badge-avatar">{{ strtoupper(substr($uname, 0, 1)) }}</div>
                <div class="badge-name">{{ strtoupper($uname) }}</div>
            </div>

            @if($errors->any())
                <div class="alert-error">⚠ {{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.reset.save') }}" id="resetForm"
                  autocomplete="off" novalidate>
                @csrf
                {{-- Dummy fields untuk mencegah autofill browser --}}
                <input type="text"     name="_dummy_user" style="display:none" tabindex="-1" autocomplete="off">
                <input type="password" name="_dummy_pass" style="display:none" tabindex="-1" autocomplete="off">

                <input type="hidden" name="email" value="{{ $em }}">

                <div class="field">
                    <label class="field-label">Nama</label>
                    <input type="text" name="name" id="nameInput" class="field-input"
                           placeholder="Nama Lengkap"
                           value="{{ old('name', $user->name ?? '') }}"
                           autocomplete="off"
                           required oninput="validateAll()">
                    <div class="field-hint gold" id="nameHint">
                        Username: <span id="unameText">{{ strtolower(str_replace(' ', '', $user->name ?? $uname)) }}</span>
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Email</label>
                    <input type="text" name="akun_email" class="field-input"
                           placeholder="Email baru"
                           value="{{ old('akun_email', $em) }}"
                           autocomplete="off"
                           required>
                    {{-- name="akun_email" bukan "email"/"username" agar browser
                         tidak mengenali field ini sebagai credential --}}
                    @error('akun_email')
                        <div class="field-hint error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label class="field-label">Password Baru</label>
                    <input type="password" name="password" id="passInput" class="field-input"
                           placeholder="Password Baru (min. 6 karakter)"
                           autocomplete="new-password"
                           required maxlength="8" oninput="validateAll()">
                    <div class="field-hint" id="passHint"></div>
                </div>

                <div class="field">
                    <label class="field-label">Konfirmasi Ulang</label>
                    <input type="password" name="password_confirmation" id="confirmInput" class="field-input"
                           placeholder="Ulangi Password"
                           autocomplete="new-password"
                           required maxlength="8" oninput="validateAll()">
                    <div class="field-hint" id="confirmHint"></div>
                </div>

                <button type="submit" class="btn-submit" onclick="return submitForm()">Simpan</button>
            </form>
        @endif

        {{-- STEP 3 — Berhasil --}}
        @if(session('password_changed'))
            <div class="success-wrap">
                <div class="success-icon">✓</div>
                <p>Data akun berhasil diubah!<br>Silakan login dengan data baru berikut.</p>
                <div class="info-box">
                    {{-- ✅ Tampilkan USERNAME bukan email --}}
                    <p>Username &nbsp;: <span>{{ session('new_username') }}</span></p>
                    <p>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span>{{ session('new_email') }}</span></p>
                </div>
            </div>
            <a href="{{ route('login') }}" class="btn-submit" style="margin-top:20px">Kembali Login</a>
        @endif

    </div>
</div>

<script>
    const HAS_SYMBOL      = /[^a-zA-Z0-9 ]/;
    const HAS_SYMBOL_PASS = /[^a-zA-Z0-9]/;

    function checkEmailFront() {
        const el   = document.getElementById('emailInput');
        const hint = document.getElementById('emailHint');
        if (!el) return true;

        const val = el.value.trim();
        if (val === '') {
            el.classList.add('is-error');
            hint.className = 'field-hint error';
            hint.textContent = '✗ Email tidak boleh kosong';
            return false;
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(val)) {
            el.classList.add('is-error');
            hint.className = 'field-hint error';
            hint.textContent = '✗ Format email tidak valid';
            return false;
        }
        el.classList.remove('is-error');
        el.classList.add('is-ok');
        hint.className = 'field-hint ok';
        hint.textContent = '✓ Format email valid';
        return true;
    }

    function validateAll() {
        let allOk = true;

        const nameEl   = document.getElementById('nameInput');
        const nameHint = document.getElementById('nameHint');
        if (nameEl) {
            const nameVal = nameEl.value;
            if (nameVal.trim() === '') {
                nameEl.className = 'field-input';
                nameHint.className = 'field-hint gold';
                nameHint.innerHTML = 'Username: <span id="unameText">—</span>';
                allOk = false;
            } else if (HAS_SYMBOL.test(nameVal)) {
                nameEl.className = 'field-input is-error';
                nameHint.className = 'field-hint error';
                nameHint.innerHTML = '✗ Nama tidak boleh mengandung simbol';
                allOk = false;
            } else {
                const uname = nameVal.toLowerCase().replace(/\s+/g, '');
                nameEl.className = 'field-input is-ok';
                nameHint.className = 'field-hint gold';
                nameHint.innerHTML = 'Username: <span id="unameText">' + uname + '</span>';
            }
        }

        const passEl   = document.getElementById('passInput');
        const passHint = document.getElementById('passHint');
        if (passEl) {
            const passVal = passEl.value;
            if (passVal === '') {
                passEl.className = 'field-input';
                passHint.className = 'field-hint';
                passHint.textContent = '';
                allOk = false;
            } else if (HAS_SYMBOL_PASS.test(passVal)) {
                passEl.className = 'field-input is-error';
                passHint.className = 'field-hint error';
                passHint.textContent = '✗ Password tidak boleh mengandung simbol';
                allOk = false;
            } else if (passVal.length < 6) {
                passEl.className = 'field-input is-error';
                passHint.className = 'field-hint warn';
                passHint.textContent = '⚠ Password minimal 6 karakter (' + passVal.length + '/8)';
                allOk = false;
            } else {
                passEl.className = 'field-input is-ok';
                passHint.className = 'field-hint ok';
                passHint.textContent = '✓ Password valid (' + passVal.length + '/8 karakter)';
            }
            validateConfirmOnly();
        }

        const confOk = validateConfirmOnly();
        if (!confOk) allOk = false;

        return allOk;
    }

    function validateConfirmOnly() {
        const passEl   = document.getElementById('passInput');
        const confEl   = document.getElementById('confirmInput');
        const confHint = document.getElementById('confirmHint');
        if (!passEl || !confEl) return true;

        const passVal = passEl.value;
        const confVal = confEl.value;

        if (confVal === '') {
            confEl.className = 'field-input';
            confHint.className = 'field-hint';
            confHint.textContent = '';
            return false;
        }
        if (HAS_SYMBOL_PASS.test(confVal)) {
            confEl.className = 'field-input is-error';
            confHint.className = 'field-hint error';
            confHint.textContent = '✗ Password tidak boleh mengandung simbol';
            return false;
        }
        if (confVal !== passVal) {
            confEl.className = 'field-input is-error';
            confHint.className = 'field-hint error';
            confHint.textContent = '✗ Password tidak cocok';
            return false;
        }
        confEl.className = 'field-input is-ok';
        confHint.className = 'field-hint ok';
        confHint.textContent = '✓ Password cocok';
        return true;
    }

    function submitForm() {
        const ok = validateAll();
        if (!ok) return false;
        return true;
    }
</script>
</body>
</html>