@extends('public.layout')

@section('title', 'Verifikasi Sertifikat - BPMP Kaltim')
@section('breadcrumb', 'Verifikasi Sertifikat')

@section('content')
<div class="row border-bottom border-light pb-3 mb-4 mx-2">
    <div class="col-12 text-center text-md-start">
        <h5 class="fw-bold mb-0" style="color: #333;">e-Certificate Verification</h5>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-0 overflow-hidden mb-4 bg-white" style="border-top: 5px solid #dcdcdc !important;">
            <div class="card-body p-5 text-center">
                <h5 class="fw-bold mb-1 text-dark fs-5">To verify your certificate, please fill in your certificate number below!</h5>
                <p class="text-muted mb-4">Untuk memverifikasi sertifikat Anda, silakan masukkan Nomor Sertifikat Anda di bawah ini!</p>
                
                <form action="{{ route('public.verify.process') }}" method="POST" class="d-flex justify-content-center">
                    @csrf
                    <div class="input-group input-group-lg shadow-sm" style="max-width: 600px;">
                        <input type="text" name="certificate_number" class="form-control" style="border: 1px solid #ddd; font-size: 16px;" placeholder="Masukkan Nomor Sertifikat" required autofocus value="{{ old('certificate_number') }}">
                        <button class="btn fw-semibold px-4 text-white" type="submit" style="background-color: #5cb85c; border-color: #4cae4c; font-size: 16px;">
                            <i class="fa-solid fa-check-square me-1"></i> VERIFY
                        </button>
                    </div>
                </form>

                @if(session('error'))
                    <div class="alert alert-danger mt-4 d-inline-block text-start mb-0 rounded-1">
                        <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
