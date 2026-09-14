<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ParkirKabasa — Kelola parkir tanpa antre catat manual</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #101317;
    --bg-raised: #171b21;
    --bg-card: #1b1f26;
    --line: #2a2f38;
    --gold: #f0b429;
    --gold-dim: #a97e1e;
    --text: #f3f4f6;
    --text-dim: #9aa1ac;
    --text-faint: #656d79;
  }
  *{ box-sizing: border-box; margin:0; padding:0; }
  html,body{
    background: var(--bg);
    color: var(--text);
    font-family: 'Inter', sans-serif;
    scroll-behavior: smooth;
  }
  h1,h2,h3, .display{
    font-family: 'Manrope', sans-serif;
  }
  a{ color: inherit; text-decoration: none; }
  img{ max-width:100%; display:block; }

  .wrap{ max-width: 1180px; margin: 0 auto; padding: 0 32px; }

  /* ---------- top bar ---------- */
  .topbar{
    position: sticky; top:0; z-index: 40;
    background: rgba(16,19,23,0.85);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--line);
  }
  .topbar-inner{
    display:flex; align-items:center; justify-content:space-between;
    padding: 18px 0;
  }
  .brand{ display:flex; align-items:center; gap:10px; }
  .brand-mark{
    width:34px; height:34px; border-radius:8px;
    background: var(--gold);
    color:#161a1f; font-weight:800; font-family:'Manrope',sans-serif;
    display:flex; align-items:center; justify-content:center;
    font-size:17px;
  }
  .brand-name{ font-weight:700; font-size:16px; letter-spacing:-0.01em; }
  .brand-name .accent{ color: var(--gold); }
  .nav-links{ display:flex; gap:32px; font-size:14px; color:var(--text-dim); }
  .nav-links a:hover{ color: var(--text); }
  .top-actions{ display:flex; align-items:center; gap:14px; }
  .btn{
    display:inline-flex; align-items:center; justify-content:center;
    padding: 10px 20px; border-radius: 8px; font-size:14px; font-weight:600;
    border:1px solid transparent; cursor:pointer;
    transition: transform .15s ease, background .15s ease, border-color .15s ease;
  }
  .btn:hover{ transform: translateY(-1px); }
  .btn-ghost{ color: var(--text-dim); border-color: var(--line); }
  .btn-ghost:hover{ color:var(--text); border-color:#3a4150; }
  .btn-gold{ background: var(--gold); color:#161a1f; }
  .btn-gold:hover{ background:#f5c351; }

  /* ---------- hero ---------- */
  .hero{
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid var(--line);
  }
  .hero-lines{
    position:absolute; inset:0;
    background-image: repeating-linear-gradient(
      90deg, var(--gold-dim) 0px, var(--gold-dim) 2px, transparent 2px, transparent 130px
    );
    opacity: 0.14;
    mask-image: linear-gradient(to bottom, black, transparent 85%);
  }
  .hero-inner{
    position: relative;
    display:grid; grid-template-columns: 1.15fr 0.85fr; gap: 56px;
    align-items:center;
    padding: 88px 0 76px;
  }
  .eyebrow-row{
    display:flex; align-items:center; gap:10px;
    color: var(--gold); font-size: 13px; font-weight:600; margin-bottom:22px;
  }
  .eyebrow-dot{ width:6px; height:6px; border-radius:50%; background: var(--gold); }
  .hero h1{
    font-size: 52px; line-height: 1.06; font-weight:800; letter-spacing:-0.02em;
    color: var(--text);
    max-width: 620px;
  }
  .hero p.lead{
    margin-top: 22px;
    font-size: 17px; line-height:1.6; color: var(--text-dim);
    max-width: 480px;
  }
  .hero-cta{ display:flex; gap:14px; margin-top: 34px; }
  .btn-lg{ padding: 14px 26px; font-size:15px; border-radius: 9px; }

  .hero-stats{
    display:flex; gap:30px; margin-top: 46px;
  }
  .stat .num{ font-family:'Manrope',sans-serif; font-weight:800; font-size:26px; color: var(--gold); }
  .stat .lbl{ font-size:13px; color: var(--text-faint); margin-top:2px; }

  /* ---------- hero visual: mock ticket console ---------- */
  .console{
    background: var(--bg-card);
    border: 1px solid var(--line);
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 30px 60px -20px rgba(0,0,0,0.55);
  }
  .console-head{
    display:flex; align-items:center; justify-content:space-between;
    padding-bottom:16px; margin-bottom:16px; border-bottom:1px solid var(--line);
  }
  .console-head .loc{ font-size:13px; font-weight:600; color:var(--text); }
  .console-head .live{
    display:flex; align-items:center; gap:6px; font-size:11px; color:#6bd08a;
  }
  .live-dot{ width:6px; height:6px; border-radius:50%; background:#6bd08a; box-shadow:0 0 0 3px rgba(107,208,138,0.18); }
  .console-row{
    display:flex; align-items:center; justify-content:space-between;
    padding: 11px 0; border-bottom: 1px dashed var(--line);
    font-size: 13px;
  }
  .console-row:last-child{ border-bottom:none; }
  .plate{
    font-family:'Manrope',sans-serif; font-weight:700; letter-spacing: 0.04em;
    background:#12151a; border:1px solid var(--line); border-radius:6px;
    padding: 4px 9px; font-size:12.5px;
  }
  .tag{
    font-size:11px; font-weight:600; padding: 4px 9px; border-radius: 20px;
  }
  .tag-in{ background: rgba(240,180,41,0.14); color: var(--gold); }
  .tag-out{ background: rgba(107,208,138,0.14); color:#6bd08a; }
  .console-foot{
    margin-top: 18px; padding-top:16px; border-top:1px solid var(--line);
    display:flex; justify-content:space-between; align-items:center;
  }
  .console-foot .cash-lbl{ font-size:12px; color:var(--text-faint); }
  .console-foot .cash-num{ font-family:'Manrope',sans-serif; font-weight:800; font-size:19px; }

  /* ---------- section shared ---------- */
  section{ padding: 92px 0; border-bottom: 1px solid var(--line); }
  .section-head{ max-width: 560px; margin-bottom: 52px; }
  .section-kicker{ color: var(--gold); font-size: 13px; font-weight:600; margin-bottom:12px; }
  .section-head h2{ font-size: 32px; font-weight:800; letter-spacing:-0.015em; line-height:1.2; }
  .section-head p{ margin-top:14px; color: var(--text-dim); font-size:15.5px; line-height:1.6; }

  /* features */
  .feature-grid{
    display:grid; grid-template-columns: repeat(3, 1fr); gap: 1px;
    background: var(--line); border:1px solid var(--line); border-radius: 14px; overflow:hidden;
  }
  .feature{
    background: var(--bg-card); padding: 30px 26px;
  }
  .feature .num{ font-family:'Manrope',sans-serif; font-weight:800; color: var(--text-faint); font-size:13px; margin-bottom:18px; }
  .feature h3{ font-size:17px; font-weight:700; margin-bottom:10px; }
  .feature p{ font-size:14px; color: var(--text-dim); line-height:1.6; }

  /* how it works */
  .flow{
    display:grid; grid-template-columns: repeat(4, 1fr);
    gap: 0;
    position: relative;
  }
  .flow::before{
    content:''; position:absolute; top:19px; left:6%; right:6%; height:1px;
    background: var(--line);
  }
  .flow-step{ position: relative; padding-right: 20px; }
  .flow-step .dot{
    width:38px; height:38px; border-radius:50%;
    background: var(--bg-card); border:1px solid var(--line);
    display:flex; align-items:center; justify-content:center;
    font-family:'Manrope',sans-serif; font-weight:800; font-size:14px; color: var(--gold);
    margin-bottom: 20px; position:relative; z-index:2;
  }
  .flow-step h3{ font-size:15.5px; font-weight:700; margin-bottom:8px; }
  .flow-step p{ font-size:13.5px; color:var(--text-dim); line-height:1.55; }

  /* roles */
  .role-grid{ display:grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
  .role-card{
    background: var(--bg-card); border:1px solid var(--line); border-radius:14px;
    padding: 28px;
  }
  .role-card .role-top{ display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; }
  .role-badge{
    font-size:11px; font-weight:700; color: var(--gold); background: rgba(240,180,41,0.1);
    padding:5px 10px; border-radius:20px;
  }
  .role-card h3{ font-size:19px; font-weight:700; margin-bottom:10px; }
  .role-card p{ font-size:14px; color:var(--text-dim); line-height:1.6; margin-bottom:20px; }
  .role-card .btn{ width:100%; }

  /* final cta */
  .cta-final{ border-bottom:none; padding: 100px 0 90px; text-align:center; }
  .cta-final h2{ font-size:34px; font-weight:800; letter-spacing:-0.015em; max-width:600px; margin:0 auto; }
  .cta-final p{ margin-top:14px; color:var(--text-dim); font-size:15.5px; }
  .cta-final .hero-cta{ justify-content:center; margin-top:30px; }

  footer{ padding: 30px 0 40px; }
  .foot-inner{ display:flex; align-items:center; justify-content:space-between; }
  .foot-inner .brand-name{ font-size:14px; }
  .foot-inner .copy{ font-size:13px; color: var(--text-faint); }

  @media (max-width: 900px){
    .hero-inner{ grid-template-columns: 1fr; padding: 56px 0 48px; }
    .hero h1{ font-size:38px; }
    .nav-links{ display:none; }
    .feature-grid{ grid-template-columns: 1fr; }
    .flow{ grid-template-columns: 1fr; row-gap: 28px; }
    .flow::before{ display:none; }
    .role-grid{ grid-template-columns: 1fr; }
    .hero-stats{ flex-wrap: wrap; row-gap: 18px; }
    .foot-inner{ flex-direction:column; gap:10px; text-align:center; }
  }
</style>
</head>
<body>

  <div class="topbar">
    <div class="wrap topbar-inner">
      <div class="brand">
        <div class="brand-mark">P</div>
        <div class="brand-name">Parkir<span class="accent">Kabasa</span></div>
      </div>
      <nav class="nav-links">
        <a href="#fitur">Fitur</a>
        <a href="#alur">Cara kerja</a>
        <a href="#peran">Untuk siapa</a>
      </nav>
      <div class="top-actions">
        <a class="btn btn-ghost" href="mailto:admin@parkirkabasa.test">Hubungi admin</a>
        <a class="btn btn-gold" href="/login">Masuk</a>
      </div>
    </div>
  </div>

  <div class="hero">
    <div class="hero-lines"></div>
    <div class="wrap hero-inner">
      <div>
        <div class="eyebrow-row"><span class="eyebrow-dot"></span> Selamat datang di ParkirKabasa</div>
        <h1>Satu layar untuk<br>seluruh operasional parkir Anda.</h1>
        <p class="lead">Pantau slot kosong, catat keluar-masuk kendaraan secara real-time, dan tutup kas harian tanpa lagi mengandalkan buku catatan manual.</p>
        <div class="hero-cta">
          <a class="btn btn-gold btn-lg" href="/login">Masuk sebagai petugas</a>
          <a class="btn btn-ghost btn-lg" href="#alur">Lihat cara kerjanya</a>
        </div>
        <div class="hero-stats">
          <div class="stat"><div class="num">128</div><div class="lbl">Slot terisi</div></div>
          <div class="stat"><div class="num">47</div><div class="lbl">Slot kosong</div></div>
          <div class="stat"><div class="num">6</div><div class="lbl">Lokasi aktif</div></div>
        </div>
      </div>

      <div class="console">
        <div class="console-head">
          <div class="loc">Lokasi — Kabasa Mall P2</div>
          <div class="live"><span class="live-dot"></span> Langsung</div>
        </div>
        <div class="console-row">
          <span class="plate">B 1928 KZ</span>
          <span class="tag tag-in">Masuk · 07:38</span>
        </div>
        <div class="console-row">
          <span class="plate">D 4471 QS</span>
          <span class="tag tag-out">Keluar · 07:41</span>
        </div>
        <div class="console-row">
          <span class="plate">B 9021 FA</span>
          <span class="tag tag-in">Masuk · 07:44</span>
        </div>
        <div class="console-row">
          <span class="plate">L 335 JT</span>
          <span class="tag tag-out">Keluar · 07:46</span>
        </div>
        <div class="console-foot">
          <span class="cash-lbl">Kas hari ini</span>
          <span class="cash-num">Rp 1.284.000</span>
        </div>
      </div>
    </div>
  </div>

  <section id="fitur">
    <div class="wrap">
      <div class="section-head">
        <div class="section-kicker">Fitur inti</div>
        <h2>Semua yang dibutuhkan petugas lapangan, dalam satu tempat.</h2>
        <p>Dirancang untuk dipakai sambil berdiri di gerbang parkir — cepat diisi, mudah dibaca, minim kesalahan input.</p>
      </div>
      <div class="feature-grid">
        <div class="feature">
          <div class="num">01</div>
          <h3>Slot real-time</h3>
          <p>Lihat jumlah slot terisi dan kosong per lokasi secara langsung, tanpa perlu keliling mengecek fisik.</p>
        </div>
        <div class="feature">
          <div class="num">02</div>
          <h3>Catat keluar-masuk</h3>
          <p>Input plat nomor dan waktu dalam hitungan detik, menggantikan buku catatan dan nota kertas.</p>
        </div>
        <div class="feature">
          <div class="num">03</div>
          <h3>Tutup kas harian</h3>
          <p>Rekap pemasukan otomatis tersusun di akhir shift, siap diserahkan tanpa dihitung ulang manual.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="alur">
    <div class="wrap">
      <div class="section-head">
        <div class="section-kicker">Cara kerja</div>
        <h2>Dari kendaraan masuk sampai kas ditutup.</h2>
      </div>
      <div class="flow">
        <div class="flow-step">
          <div class="dot">1</div>
          <h3>Petugas masuk akun</h3>
          <p>Login dengan akun yang diberikan admin untuk lokasi yang ditugaskan.</p>
        </div>
        <div class="flow-step">
          <div class="dot">2</div>
          <h3>Catat kendaraan</h3>
          <p>Input plat nomor saat kendaraan masuk dan keluar dari gerbang.</p>
        </div>
        <div class="flow-step">
          <div class="dot">3</div>
          <h3>Slot terupdate</h3>
          <p>Jumlah slot kosong menyesuaikan otomatis di seluruh layar terhubung.</p>
        </div>
        <div class="flow-step">
          <div class="dot">4</div>
          <h3>Tutup shift</h3>
          <p>Rekap kas harian muncul otomatis, tinggal diserahkan ke admin.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="peran">
    <div class="wrap">
      <div class="section-head">
        <div class="section-kicker">Untuk siapa</div>
        <h2>Dibangun untuk dua peran yang berbeda kebutuhannya.</h2>
      </div>
      <div class="role-grid">
        <div class="role-card">
          <div class="role-top">
            <h3>Petugas lapangan</h3>
            <span class="role-badge">Harian</span>
          </div>
          <p>Fokus pada pencatatan cepat di gerbang: masuk, keluar, dan tutup kas di akhir shift.</p>
          <a class="btn btn-gold" href="/login">Masuk sebagai petugas</a>
        </div>
        <div class="role-card">
          <div class="role-top">
            <h3>Admin</h3>
            <span class="role-badge">Pengawasan</span>
          </div>
          <p>Pantau semua lokasi sekaligus, kelola akun petugas, dan lihat rekap kas dari waktu ke waktu.</p>
          <a class="btn btn-ghost" href="/login">Masuk sebagai admin</a>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-final">
    <div class="wrap">
      <h2>Berhenti mencatat parkir di kertas hari ini.</h2>
      <p>Masuk dengan akun petugas atau admin ParkirKabasa Anda untuk mulai.</p>
      <div class="hero-cta">
        <a class="btn btn-gold btn-lg" href="/login">Masuk ke akun</a>
        <a class="btn btn-ghost btn-lg" href="mailto:admin@parkirkabasa.test">Belum punya akun? Hubungi admin</a>
      </div>
    </div>
  </section>

  <footer>
    <div class="wrap foot-inner">
      <div class="brand-name">Parkir<span class="accent" style="color:var(--gold)">Kabasa</span></div>
      <div class="copy">© 2026 ParkirKabasa. Dibuat untuk operasional parkir yang lebih rapi.</div>
    </div>
  </footer>

</body>
</html>