@extends('layouts.app')
@section('title','Audit Trail')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
  <div>
    <h4 class="mb-0">Audit Trail <span class="badge bg-warning text-dark fs-6 ms-2">BETA</span></h4>
    <div class="text-muted">Riwayat log aktivitas sistem dan jejak rekaman transaksi pengguna.</div>
  </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
  <div class="card-body p-5 text-center">
    <div class="text-muted mb-3">
        <i class="fa-solid fa-person-digging" style="font-size: 4rem; opacity: 0.5;"></i>
    </div>
    <h5 class="fw-bold mb-2">Halaman Sedang Dalam Pengembangan</h5>
    <p class="text-muted mx-auto" style="max-width: 500px;">
        Fitur <strong>Audit Trail</strong> saat ini masih berupa *placeholder* (tampilan sementara waktu). Kelak, tabel ini akan mencatat segala aktivitas log server seperti siapa yang login, jam berapa sebuah sertifikat diubah statusnya, dan IP mana yang digunakan.
    </p>

    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary shadow-sm rounded-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
  </div>
</div>
@endsection
