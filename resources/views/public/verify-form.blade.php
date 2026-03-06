@extends('public.layout')

@section('title', 'Verifikasi Sertifikat - BPMP Kaltim')
@section('breadcrumb', 'Verifikasi Sertifikat')

@section('content')
<div class="row justify-content-center" data-aos="fade-up">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
            <div class="card-body p-4 p-md-5 text-center">
                <div class="d-inline-flex bg-primary bg-opacity-10 text-primary rounded-circle mb-4 align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="fa-solid fa-file-shield" style="font-size: 32px;"></i>
                </div>
                
                <h4 class="fw-bold text-dark mb-2">Verifikasi Keaslian Sertifikat</h4>
                <p class="text-muted mb-4 px-md-5">
                    Silakan masukkan <strong>Nomor Sertifikat</strong> Anda untuk memverifikasi keaslian dokumen dan status Tanda Tangan Elektronik (TTE).
                </p>
                
                <div class="alert alert-info border-0 shadow-none bg-light text-primary rounded-4 py-3 px-4 mb-5 mx-auto" style="max-width: 600px;">
                    <div class="d-flex align-items-center gap-3 text-start">
                        <i class="fa-solid fa-circle-info fs-4"></i>
                        <div class="small">
                            <strong>Tips:</strong> Nomor sertifikat biasanya tertera di bagian bawah atau di bawah Judul Sertifikat (Contoh: 1234/CERT/BPMP/2024).
                        </div>
                    </div>
                </div>

                <form action="{{ route('public.verify.process') }}" method="POST" class="d-flex justify-content-center">
                    @csrf
                    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden" style="max-width: 550px; border: 1px solid #e2e8f0;">
                        <span class="input-group-text bg-white border-0 ps-4 text-muted">
                            <i class="fa-solid fa-hashtag"></i>
                        </span>
                        <input type="text" name="certificate_number" class="form-control border-0 py-3" placeholder="Masukkan Nomor Sertifikat di sini..." required autofocus value="{{ old('certificate_number') }}">
                        <button class="btn btn-success px-4 fw-bold shadow-none" type="submit">
                            VERIFIKASI
                        </button>
                    </div>
                </form>

                @if(session('error'))
                    <div class="alert alert-danger mt-4 d-inline-block text-start mb-0 rounded-3 border-0 shadow-sm px-4">
                        <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                    </div>
                @endif
                
                <div class="mt-5 pt-4 border-top border-light">
                    <p class="text-muted small mb-0">Atau verifikasi secara instan dengan memindai <strong>QR Code</strong> yang terdapat pada sertifikat fisik menggunakan kamera smartphone Anda.</p>
                </div>
            </div>
        </div>
        
        <!-- Safety Info -->
        <div class="row g-3 mt-2">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-4 shadow-xs border border-light">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark small">Data Aman</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Proteksi data pribadi peserta</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-4 shadow-xs border border-light">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-3">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark small">Resmi BPMP</div>
                        <div class="text-muted" style="font-size: 0.75rem;">Database terintegrasi pusat</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .input-group:focus-within {
        border-color: #198754 !important;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15) !important;
    }
    .shadow-xs {
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
</style>
@endsection
