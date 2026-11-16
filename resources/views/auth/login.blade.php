<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk — Parkir Kabasa</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

  <div id="splash" class="splash">
    <div class="splash__scene">
      <div class="splash__post"></div>
      <div class="splash__arm"></div>

      <svg class="splash__car" viewBox="0 0 120 52" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 36 V28 Q6 24 12 23 L34 20 L44 8 Q46 6 50 6 H82 Q86 6 88 9 L98 20 L110 24 Q114 26 114 31 V36 Z" fill="#f5a800"/>
        <path d="M50 11 H80 L91 20 H44 Z" fill="#1c1f22"/>
        <circle cx="30" cy="38" r="9" fill="#1c1f22" stroke="#f5a800" stroke-width="3"/>
        <circle cx="92" cy="38" r="9" fill="#1c1f22" stroke="#f5a800" stroke-width="3"/>
      </svg>

      <div class="splash__road"></div>
    </div>

    <p class="splash__brand">PORTAL PARKIR KABASA</p>
    <div class="splash__bar"><i></i></div>
    <p class="splash__text">Membuka palang…</p>
  </div>

  <div class="login-wrap">
    <div class="login-left">
      <div class="brand-mark"><span class="brand-dot"></span>PORTAL PARKIR KABASA</div>

      <div>
        <div class="headline">Lebih Mudah Dengan Parkir Kabasa,<br> Pasti Tercatat Rapi<span class="accent">.</span></div>
        <div class="sub">Sistem manajemen area parkir untuk pencatatan transaksi, tarif, dan aktivitas petugas secara real-time.</div>

        <div class="car-lane">
          <svg class="car-lane__car" viewBox="0 0 120 52" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 36 V28 Q6 24 12 23 L34 20 L44 8 Q46 6 50 6 H82 Q86 6 88 9 L98 20 L110 24 Q114 26 114 31 V36 Z" fill="#f5a800"/>
            <path d="M50 11 H80 L91 20 H44 Z" fill="#1c1f22"/>
            <g class="wheel">
              <circle cx="30" cy="38" r="9" fill="#1c1f22" stroke="#f5a800" stroke-width="3"/>
              <path d="M30 32 V44 M24 38 H36" stroke="#f5a800" stroke-width="2"/>
            </g>
            <g class="wheel">
              <circle cx="92" cy="38" r="9" fill="#1c1f22" stroke="#f5a800" stroke-width="3"/>
              <path d="M92 32 V44 M86 38 H98" stroke="#f5a800" stroke-width="2"/>
            </g>
          </svg>
          <div class="car-lane__road"></div>
        </div>
      </div>

      <div class="plate-strip">
        <span class="plate-chip">AREA A · 40 slot</span>
        <span class="plate-chip">AREA B · 25 slot</span>
        <span class="plate-chip">AREA C · 35 slot</span>
        <span class="plate-chip">MOTOR · Rp2.000/jam</span>
        <span class="plate-chip">MOBIL · Rp5.000/jam</span>
      </div>
    </div>

    <div class="login-right">
      <div class="login-card">
        <h2>Masuk ke akun Anda</h2>
        <div class="hint">Gunakan username dan kata sandi yang terdaftar.</div>

        @if ($errors->any())
          <div class="error-box">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
          @csrf
          <div class="field">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" autocomplete="username" required autofocus>
          </div>
          <div class="field">
            <label>Kata sandi</label>
            <input type="password" name="password" autocomplete="current-password" required>
          </div>
          <button class="btn btn-primary" type="submit">Masuk</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    const splash = document.getElementById('splash');
    if (sessionStorage.getItem('splashSeen')) {
      splash.remove();
    } else {
      setTimeout(() => {
        splash.classList.add('hide');
        setTimeout(() => splash.remove(), 900);
        sessionStorage.setItem('splashSeen', '1');
      }, 3700);
    }
  </script>
</body>
</html>