@extends('public.layout')

@section('title', 'Verifikasi Sertifikat - BPMP Kaltim')
@section('breadcrumb', 'Verifikasi Sertifikat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 mb-5">
        
        <div class="card border-0 shadow-sm rounded-0 bg-white" style="border-top: 5px solid #dff0d8 !important;">
            <div class="card-header border-bottom py-3" style="background-color: #dff0d8; color: #3c763d;">
                <h6 class="mb-0 fw-semibold text-success ms-2" style="font-size: 15px;">e-Certificate Verification</h6>
            </div>
            
            <div class="card-body p-4 p-md-5">
                @if($isValid && $cert)
                    <div class="mb-5">
                        <h3 class="fw-normal mb-1 d-flex align-items-center gap-2" style="color: #333;">
                            <i class="fa-solid fa-check-square fs-2" style="color: #333;"></i> Sertifikat Anda valid
                        </h3>
                        <p class="fs-6 fw-bold mb-0" style="margin-left: 38px;">{{ $cert->certificate_number }}</p>
                    </div>
                    
                    <div class="mb-5">
                        <h4 class="fw-normal mb-2 text-dark d-flex align-items-center gap-2">
                            <i class="fa-solid fa-user fs-4 text-dark"></i> Participant Profile
                        </h4>
                        <div class="ms-1">
                            <h5 class="fw-bold mb-1 fs-5">{{ $cert->participant->name }}</h5>
                            <div class="text-secondary fs-6 mb-1">{{ $cert->participant->institution ?? '-' }}</div>
                            <div class="text-secondary fs-6">-</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="fw-normal mb-2 text-dark d-flex align-items-center gap-2 ms-0">
                            <i class="fa-solid fa-book fs-4 text-dark"></i> Program
                        </h4>
                        <div class="ms-1">
                            <h5 class="fw-bold mb-4 fs-6 text-dark" style="line-height: 1.5;">{{ $cert->event->name }}</h5>
                            
                            <div class="text-dark">
                                @if($cert->event->event_type)
                                    <div>{{ $cert->event->event_type }}</div>
                                @else
                                    <div class="text-muted small mb-1">Kegiatan E-Sertifikat BPMP</div>
                                @endif
                                <div>
                                    {{ $cert->event->start_date ? \Carbon\Carbon::parse($cert->event->start_date)->translatedFormat('d F Y') : '-' }} - 
                                    {{ $cert->event->end_date ? \Carbon\Carbon::parse($cert->event->end_date)->translatedFormat('d F Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-3 mt-5 shadow-sm rounded-3 w-100" style="background-color: #f7f9fa; border: 1px dashed #ced4da;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-file-signature text-success fs-3 border-end pe-3"></i>
                            <div class="ms-2">
                                <h6 class="mb-0 fw-bold ext-dark">Digital TTE Valid</h6>
                                <p class="mb-0 small text-muted">Ditandatangani oleh Kepala BPMP Provinsi Kaltim</p>
                            </div>
                        </div>
                        <div>
                             <a href="{{ route('public.download', $cert->verify_token) }}" target="_blank" class="btn btn-success btn-sm rounded-1 shadow-sm px-3 fw-bold" style="background-color: #5cb85c; border-color: #4cae4c; font-size: 13px;">
                                 <i class="fa-solid fa-download me-1"></i> UNDUH SERTIFIKAT
                             </a>
                        </div>
                    </div>
                @else
                    <div style="background-color: #f2dede; border: 1px solid #ebccd1; border-top: 15px solid #ebccd1; padding: 50px 20px; text-align: center; border-radius: 4px;">
                        <h2 class="fw-normal mb-2 fs-3" style="color: #333;">Verifikasi tidak valid !</h2>
                        <p class="mb-4 text-muted fs-6">Sertifikat anda tidak ada dalam database kami</p>

                        <div class="my-4">
                            <i class="fa-solid fa-xmark" style="font-size: 30px; color: #333;"></i>
                        </div>

                        <h4 class="fw-normal fs-4 text-dark" style="margin-top: 20px;">We cannot find your certification data.</h4>
                        <h4 class="fw-normal fs-4 text-dark">Unfortunately, your certificate is not valid.</h4>
                        
                        <div class="mt-5">
                            <a href="{{ route('public.verify.form') }}" class="btn text-white fw-bold px-4 rounded-1 shadow-sm" style="background-color: #f0ad4e; border-color: #eea236; font-size: 14px;">
                                <i class="fa-solid fa-rotate-left me-1"></i> Kembali ke Pencarian
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection
