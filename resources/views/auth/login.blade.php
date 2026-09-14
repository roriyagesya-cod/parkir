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
  <div class="login-wrap">
    <div class="login-left">
      <div class="brand-mark"><span class="brand-dot"></span>PORTAL PARKIR</div>
      <div>
        <div class="headline">Setiap kendaraan,<br>tercatat rapi<span class="accent">.</span></div>
        <div class="sub">Sistem manajemen area parkir untuk pencatatan transaksi, tarif, dan aktivitas petugas secara real-time.</div>
      </div>
      <div class="plate-strip">
        <span class="plate-chip">AREA A · 40 slot</span>
        <span class="plate-chip">AREA B · 25 slot</span>
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

        <div class="demo-accounts">
          <div><b>Akun demo (setelah php artisan db:seed)</b></div>
          <div>Admin — admin / admin123</div>
          <div>petugas — petugas / petugas123</div>
          <div>Owner — owner / owner123</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
