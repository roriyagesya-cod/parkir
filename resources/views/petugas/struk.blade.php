@extends('layouts.app')
@section('title', 'Struk Parkir – Portal Parkir')

@php
  $masuk  = \Carbon\Carbon::parse($transaksi->waktu_masuk);
  $keluar = $transaksi->waktu_keluar ? \Carbon\Carbon::parse($transaksi->waktu_keluar) : null;

  $durasi = $transaksi->durasi_jam ?? $transaksi->durasi ?? 0;

  $tarif = $transaksi->tarif_per_jam
        ?? $transaksi->tarif->tarif_per_jam
        ?? $transaksi->tarif->tarif
        ?? $transaksi->tarif->harga
        ?? $transaksi->kendaraan->tarif->tarif_per_jam
        ?? 0;

  $total = $transaksi->total_bayar
        ?? $transaksi->total_biaya
        ?? $transaksi->biaya
        ?? $transaksi->total
        ?? ($durasi * $tarif);
@endphp

@section('content')
  <div class="page-head no-print"><div><h1>Struk parkir</h1></div></div>

  <div class="struk" id="strukPrint">
    <div class="center head">
      <img src="{{ asset('img/logo.png') }}" alt="Kabasa" class="struk-logo">
      <small>PORTAL PARKIR KABASA</small>
      <small>{{ $transaksi->area->nama_area ?? '' }}</small>
    </div>
    <div class="center"><span class="badge">LUNAS</span></div>

    <hr>
    <div class="row"><span>Plat nomor</span><span>{{ $transaksi->kendaraan->plat_nomor }}</span></div>
    <div class="row"><span>Jenis</span><span>{{ $transaksi->kendaraan->jenis_kendaraan ?? '-' }}</span></div>
    <div class="row"><span>Masuk</span><span>{{ $masuk->format('d M Y H:i') }}</span></div>
    <div class="row"><span>Keluar</span><span>{{ $keluar ? $keluar->format('d M Y H:i') : '-' }}</span></div>
    <div class="row"><span>Durasi</span><span>{{ $durasi }} jam</span></div>
    <div class="row"><span>Tarif/jam</span><span>Rp{{ number_format($tarif, 0, ',', '.') }}</span></div>
    <hr>
    <div class="row total"><span>TOTAL</span><span>Rp{{ number_format($total, 0, ',', '.') }}</span></div>
    <hr>
    @if (class_exists(\SimpleSoftwareIO\QrCode\Facades\QrCode::class))
      <div class="qr">{!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(90)->margin(0)->generate('STRUK-' . $transaksi->getKey()) !!}</div>
    @endif
    <div class="center thanks">Terima kasih</div>
  </div>

  <div class="form-actions no-print" style="justify-content:center">
    <a href="{{ route('transaksi.index') }}" class="btn btn-ghost">Kembali</a>
    <button class="btn btn-amber" onclick="window.print()">Cetak</button>
  </div>

  @push('styles')
  <style>
    .struk {
      width: 320px;
      margin: 0 auto;
      background: #fff;
      padding: 24px 22px 28px;
      border-radius: 10px;
      box-shadow: 0 8px 24px rgba(0,0,0,.12);
      font-family: 'IBM Plex Mono', monospace;
      font-size: 13px;
      color: #222;
    }
    .struk .center { text-align: center; }
    .struk .head small {
      display: block;
      font-size: 12px;
      font-weight: 500;
      letter-spacing: 1px;
      color: #777;
      line-height: 1.5;
    }
    .struk-logo {
      display: block;
      width: 190px;
      height: auto;
      margin: -6px auto 2px;
    }
    .struk .thanks { color: #888; font-size: 12px; margin-top: 8px; }
    .struk .badge {
      display: inline-block;
      background: #e6f7ec;
      color: #1a7f3c;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 1px;
      padding: 3px 12px;
      border-radius: 99px;
      margin-top: 6px;
    }
    .struk hr { border: 0; border-top: 2px dashed #ccc; margin: 14px 0; }
    .struk .row { display: flex; justify-content: space-between; padding: 3px 0; }
    .struk .row span:first-child { color: #888; }
    .struk .row span:last-child { font-weight: 500; }
    .struk .row.total {
      background: #fff4d6;
      border-left: 4px solid #f5a800;
      border-radius: 4px;
      padding: 10px 12px;
      font-size: 18px;
      font-weight: 700;
    }
    .struk .row.total span:first-child { color: #222; }
    .struk .qr { display: flex; justify-content: center; margin-top: 4px; }

    .form-actions .btn { text-decoration: none; }
    .form-actions .btn-ghost {
      border: 1px solid #ccc;
      background: #fff;
      color: #333;
      font-weight: 600;
    }
    .form-actions .btn-ghost:hover { background: #f3f3f3; }

    @media print {
      body * { visibility: hidden; }
      #strukPrint, #strukPrint * { visibility: visible; }
      #strukPrint {
        position: absolute;
        left: 0; top: 0;
        width: 100%;
        box-shadow: none;
        border-radius: 0;
      }
      .struk-logo { filter: grayscale(1) contrast(1.4); }
      .no-print { display: none !important; }
    }
  </style>
  @endpush
@endsection