@extends('public.layout')

@section('title', 'Beranda Publik - E-Sertifikat')
@section('breadcrumb', 'Beranda')

@section('content')
<div class="row align-items-center g-5 py-5">
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Layanan E-Sertifikat Terpadu</h1>
        <p class="lead text-muted mb-4">Akses, cari, dan verifikasi sertifikat kegiatan Anda di Balai Penjaminan Mutu Pendidikan (BPMP) Provinsi Kalimantan Timur secara digital, instan, dan aman dengan Tanda Tangan Elektronik.</p>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="{{ route('public.search') }}" class="btn btn-primary btn-lg px-4 me-md-2 fw-semibold d-flex align-items-center gap-2">
                <i class="fa-solid fa-magnifying-glass"></i> Cari Sertifikat
            </a>
            <a href="{{ route('public.verify.form') }}" class="btn btn-outline-danger btn-lg px-4 fw-semibold d-flex align-items-center gap-2">
                <i class="fa-solid fa-qrcode"></i> Verifikasi TTE
            </a>
        </div>
    </div>
    <div class="col-lg-6 text-center">
        <!-- Dashboard Illustration (Using an icon composition since we don't have a specific illustration image) -->
        <div class="position-relative d-inline-block">
            <div class="bg-primary rounded-circle position-absolute" style="width: 300px; height: 300px; opacity: 0.1; top: 10%; left: 10%; filter: blur(20px);"></div>
            <div class="bg-info rounded-circle position-absolute" style="width: 250px; height: 250px; opacity: 0.1; bottom: 0; right: 0; filter: blur(20px);"></div>
            <i class="fa-solid fa-file-shield text-primary" style="font-size: 15rem; position: relative; z-index: 10; filter: drop-shadow(0 15px 15px rgba(0,0,0,0.1)); mb-4"></i>
        </div>
    </div>
</div>

<div class="row g-4 mt-5">
    <div class="col-md-4">
        <div class="card h-100 border shadow-sm rounded-4 text-center p-4 bg-white" style="border-top: 5px solid #0d6efd !important; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
            <div class="d-inline-flex bg-primary bg-opacity-10 text-primary rounded-circle mb-3 align-items-center justify-content-center mx-auto" style="width: 75px;height: 75px;">
                <i class="fa-regular fa-clock" style="font-size: 32px;"></i>
            </div>
            <h5 class="fw-bold text-dark">Akses Instan</h5>
            <p class="text-muted small mb-0">Sertifikat dapat diunduh kapan saja dan di mana saja. Tidak perlu menunggu dokumen fisik.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border shadow-sm rounded-4 text-center p-4 bg-white" style="border-top: 5px solid #198754 !important; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
            <div class="d-inline-flex bg-success bg-opacity-10 text-success rounded-circle mb-3 align-items-center justify-content-center mx-auto" style="width: 75px;height: 75px;">
                <i class="fa-solid fa-shield-halved" style="font-size: 32px;"></i>
            </div>
            <h5 class="fw-bold text-dark">Legal & Aman</h5>
            <p class="text-muted small mb-0">Telah terintegrasi Tanda Tangan Elektronik tersertifikasi, 100% legal dan terhindar dari pemalsuan data.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border shadow-sm rounded-4 text-center p-4 bg-white" style="border-top: 5px solid #dc3545 !important; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
            <div class="d-inline-flex bg-danger bg-opacity-10 text-danger rounded-circle mb-3 align-items-center justify-content-center mx-auto" style="width: 75px;height: 75px;">
                <i class="fa-solid fa-qrcode" style="font-size: 32px;"></i>
            </div>
            <h5 class="fw-bold text-dark">Verifikasi Mudah</h5>
            <p class="text-muted small mb-0">Cukup gunakan scanner terintegrasi kami atau input kode unik untuk memastikan validitas sertifikat.</p>
        </div>
    </div>
</div>
@endsection
