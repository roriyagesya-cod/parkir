<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Portal Parkir')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <div class="shell">
    <div class="sidebar">
      <div class="brand"><span class="brand-dot"></span>PORTAL PARKIR</div>
      <nav class="nav">
        <div class="section-label">Utama</div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>

        @if(session('user_role') === 'admin')
          <div class="section-label">Master data</div>
          <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Pengguna</a>
          <a href="{{ route('tarif.index') }}" class="{{ request()->routeIs('tarif.*') ? 'active' : '' }}">Tarif parkir</a>
          <a href="{{ route('area.index') }}" class="{{ request()->routeIs('area.*') ? 'active' : '' }}">Area parkir</a>
          <a href="{{ route('kendaraan.index') }}" class="{{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">Kendaraan</a>
          <div class="section-label">Pengawasan</div>
          <a href="{{ route('log.index') }}" class="{{ request()->routeIs('log.*') ? 'active' : '' }}">Log aktivitas</a>
        @endif

        @if(session('user_role') === 'petugas')
          <div class="section-label">Operasional</div>
          <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">Transaksi parkir</a>
        @endif

        @if(session('user_role') === 'owner')
          <div class="section-label">Laporan</div>
          <a href="{{ route('rekap.index') }}" class="{{ request()->routeIs('rekap.*') ? 'active' : '' }}">Rekap transaksi</a>
        @endif
      </nav>
      <div class="who">
        <b>{{ session('user_name') }}</b>
        <div class="role-tag">{{ ucfirst(session('user_role')) }}</div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="logout-btn" type="submit">Keluar</button>
        </form>
      </div>
    </div>
    <div class="main">
      @if(session('status'))
        <div class="status-box">{{ session('status') }}</div>
      @endif
      @if(session('error'))
        <div class="error-box">{{ session('error') }}</div>
      @endif
      @yield('content')
    </div>
  </div>
</body>
</html>
