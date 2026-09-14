<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — ParkirKabasa</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #101317;
    --bg-card: #1b1f26;
    --line: #2a2f38;
    --gold: #f0b429;
    --text: #f3f4f6;
    --text-dim: #9aa1ac;
    --text-faint: #656d79;
    --panel: #efece5;
    --panel-text: #1c1c1c;
    --panel-dim: #6b6b66;
  }
  *{ box-sizing:border-box; margin:0; padding:0; }
  html,body{ height:100%; }
  body{
    font-family:'Inter', sans-serif;
    display:grid; grid-template-columns: 1.05fr 0.95fr;
    min-height:100vh;
    background: var(--panel);
  }
  h1,h2,h3{ font-family:'Manrope', sans-serif; }
  a{ color:inherit; }

  /* ---------- left: brand panel ---------- */
  .side{
    background: var(--bg);
    color: var(--text);
    position: relative;
    overflow:hidden;
    padding: 56px 64px;
    display:flex; flex-direction:column; justify-content:space-between;
  }
  .side-lines{
    position:absolute; inset:0;
    background-image: repeating-linear-gradient(
      90deg, #a97e1e 0px, #a97e1e 2px, transparent 2px, transparent 130px
    );
    opacity: 0.14;
  }
  .brand{ position:relative; display:flex; align-items:center; gap:10px; }
  .brand-mark{
    width:34px; height:34px; border-radius:8px;
    background: var(--gold); color:#161a1f; font-weight:800;
    font-family:'Manrope',sans-serif; font-size:17px;
    display:flex; align-items:center; justify-content:center;
  }
  .brand-name{ font-weight:700; font-size:16px; }
  .brand-name .accent{ color: var(--gold); }

  .side-mid{ position:relative; max-width: 480px; }
  .side-mid h1{
    font-size: 40px; line-height:1.12; font-weight:800; letter-spacing:-0.02em;
    margin-bottom:18px;
  }
  .side-mid p{ font-size:15.5px; color: var(--text-dim); line-height:1.6; }

  .side-stats{ position:relative; display:flex; gap:34px; }
  .stat .num{ font-family:'Manrope',sans-serif; font-weight:800; font-size:24px; color: var(--gold); }
  .stat .lbl{ font-size:12.5px; color: var(--text-faint); margin-top:2px; }

  /* ---------- right: form panel ---------- */
  .form-side{
    display:flex; align-items:center; justify-content:center;
    padding: 40px;
  }
  .form-card{ width:100%; max-width: 380px; }
  .form-card h2{ font-size:26px; font-weight:800; color: var(--panel-text); margin-bottom:8px; }
  .form-card > p{ font-size:14px; color: var(--panel-dim); margin-bottom:32px; }

  .field{ margin-bottom:18px; }
  .field label{
    display:block; font-size:13.5px; font-weight:600; color: var(--panel-text);
    margin-bottom:7px;
  }
  .field input{
    width:100%; padding: 12px 14px; border-radius:8px;
    border:1px solid #d8d5cc; background:#fff; color:#1c1c1c;
    font-size:14px; font-family:'Inter',sans-serif;
  }
  .field input:focus{ outline:2px solid var(--gold); outline-offset:1px; }
  .field.password{ position:relative; }
  .field.password .toggle{
    position:absolute; right:14px; top:38px;
    font-size:12.5px; font-weight:600; color:#3b3b38; cursor:pointer; background:none; border:none;
  }

  .row-between{
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:24px; font-size:13.5px;
  }
  .remember{ display:flex; align-items:center; gap:8px; color:#3b3b38; }
  .remember input{ width:16px; height:16px; }
  .forgot{ font-weight:600; text-decoration: underline; color:#1c1c1c; }

  .btn-submit{
    width:100%; padding: 13px; border-radius:9px; border:none;
    background:#161a1f; color:#fff; font-weight:700; font-size:14.5px;
    cursor:pointer; transition: background .15s ease;
  }
  .btn-submit:hover{ background:#25292f; }

  .divider{
    display:flex; align-items:center; gap:12px; margin: 26px 0;
    color:#8b8b85; font-size:12.5px;
  }
  .divider::before, .divider::after{ content:''; flex:1; height:1px; background:#d8d5cc; }

  .signup{ text-align:center; font-size:13.5px; color:#3b3b38; }
  .signup a{ font-weight:700; text-decoration: underline; }

  .error-box{
    background:#fdecec; border:1px solid #f3b8b8; color:#9b1c1c;
    font-size:13px; padding:10px 14px; border-radius:8px; margin-bottom:18px;
  }

  @media (max-width: 900px){
    body{ grid-template-columns: 1fr; }
    .side{ display:none; }
  }
</style>
</head>
<body>

  <div class="side">
    <div class="side-lines"></div>
    <div class="brand">
      <div class="brand-mark">P</div>
      <div class="brand-name">Parkir<span class="accent">Kabasa</span></div>
    </div>

    <div class="side-mid">
      <h1>Kelola parkir tanpa antre catat manual.</h1>
      <p>Pantau slot kosong, catat keluar-masuk kendaraan, dan tutup kas harian dari satu layar.</p>
    </div>

    <div class="side-stats">
      <div class="stat"><div class="num">128</div><div class="lbl">Slot terisi</div></div>
      <div class="stat"><div class="num">47</div><div class="lbl">Slot kosong</div></div>
      <div class="stat"><div class="num">6</div><div class="lbl">Lokasi aktif</div></div>
    </div>
  </div>

  <div class="form-side">
    <div class="form-card">
      <h2>Masuk ke akun</h2>
      <p>Gunakan akun petugas atau admin ParkirKabasa Anda.</p>

      @if ($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="/login">
        @csrf

        <div class="field">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="mis. petugas.kabasa01" value="{{ old('username') }}">
        </div>

        <div class="field password">
          <label for="password">Kata sandi</label>
          <input type="password" id="password" name="password" placeholder="Masukkan kata sandi">
          <button type="button" class="toggle" onclick="
            const i=document.getElementById('password');
            i.type = i.type === 'password' ? 'text' : 'password';
            this.textContent = i.type === 'password' ? 'Lihat' : 'Sembunyikan';
          ">Lihat</button>
        </div>

        <div class="row-between">
          <label class="remember">
            <input type="checkbox" name="remember">
            Ingat saya
          </label>
          <a class="forgot" href="#">Lupa kata sandi?</a>
        </div>

        <button type="submit" class="btn-submit">Masuk</button>
      </form>

      <div class="divider">atau</div>

      <div class="signup">
        Belum punya akun petugas? <a href="mailto:admin@parkirkabasa.test">Hubungi admin</a>
      </div>
    </div>
  </div>

</body>
</html>