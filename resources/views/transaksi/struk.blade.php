@extends('layouts.app')
@section('title', 'Struk Parkir — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Struk parkir</h1><div class="desc">Struk untuk kendaraan {{ $transaksi->kendaraan->plat_nomor }}.</div></div></div>

  <div class="struk" id="strukPrint">
    <div class="center">PORTAL PARKIR<br>{{ $transaksi->area->nama_area }}</div>
    <hr>
    <div class="row"><span>Plat nomor</span><span>{{ $transaksi->kendaraan->plat_nomor }}</span></div>
    <div class="row"><span>Jenis</span><span>{{ $transaksi->kendaraan->jenis_kendaraan }}</span></div>
    <div class="row"><span>Masuk</span><span>{{ $transaksi->waktu_masuk->format('d M Y H:i') }}</span></div>
    <div class="row"><span>Keluar</span><span>{{ $transaksi->waktu_keluar ? $transaksi->waktu_keluar->format('d M Y H:i') : '-' }}</span></div>
    <div class="row"><span>Durasi</span><span>{{ $transaksi->durasi_jam ?? 0 }} jam</span></div>
    <div class="row"><span>Tarif/jam</span><span>Rp{{ number_format($transaksi->tarif->tarif_per_jam,0,',','.') }}</span></div>
    <hr>
    <div class="row total"><span>TOTAL</span><span>Rp{{ number_format($transaksi->biaya_total,0,',','.') }}</span></div>
    <hr>
    <div class="center">Terima kasih</div>
  </div>

  <div class="form-actions" style="justify-content:center;margin-top:20px;">
    <a href="{{ route('transaksi.index') }}" class="btn btn-ghost">Kembali</a>
    <button class="btn btn-amber" onclick="window.print()">Cetak</button>
  </div>
@endsection
