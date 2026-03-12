@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
@php 
    $isSuper = $user->role?->name === 'superadmin'; 
@endphp

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 fw-bold text-dark">Profil Pengguna</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item small"><a href="{{ route('admin.system.users.index') }}" class="text-decoration-none text-muted">Manajemen User</a></li>
                        <li class="breadcrumb-item small active text-primary fw-semibold" aria-current="page">Edit User</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.system.users.index') }}" class="btn btn-outline-secondary rounded-pill px-4 transition-all shadow-sm bg-white">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 p-3 font-outfit">
            <div class="d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-2 me-3">
                    <i class="fa-solid fa-circle-exclamation fs-5"></i>
                </div>
                <div class="fw-bold">Terdapat beberapa kesalahan input. Silakan periksa kembali.</div>
            </div>
            <ul class="mt-2 mb-0 small opacity-85 ms-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
            <div class="card-header bg-primary bg-gradient-premium text-white p-4 border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3 backdrop-blur" style="width: 56px; height: 56px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-user-pen fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Ubah Informasi Pengguna</h5>
                        <p class="mb-0 opacity-75 small">Pastikan data yang dimasukkan sudah benar dan email tetap unik dalam sistem.</p>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.system.users.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="card-body p-4 p-md-5 bg-white">
                    <div class="row g-4">
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase ls-1">Nama Lengkap</label>
                            <div class="input-group input-group-lg custom-input-group">
                                <span class="input-group-text bg-light border-0"><i class="fa-solid fa-user text-muted opacity-50"></i></span>
                                <input name="name" class="form-control bg-light border-0 fs-6 ps-0" value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase ls-1">Alamat Email</label>
                            <div class="input-group input-group-lg custom-input-group">
                                <span class="input-group-text bg-light border-0"><i class="fa-solid fa-envelope text-muted opacity-50"></i></span>
                                <input name="email" type="email" class="form-control bg-light border-0 fs-6 ps-0" value="{{ old('email', $user->email) }}" required placeholder="email@example.com">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase ls-1">Role / Hak Akses</label>
                            <div class="input-group input-group-lg custom-input-group {{ $isSuper ? 'opacity-75' : '' }}">
                                <span class="input-group-text bg-light border-0"><i class="fa-solid fa-shield-halved text-muted opacity-50"></i></span>
                                <select name="role_id" class="form-select bg-light border-0 fs-6 ps-0" required @disabled($isSuper)>
                                    @foreach($roles as $r)
                                    <option value="{{ $r->id }}" @selected(old('role_id', $user->role_id)==$r->id)>
                                        {{ $r->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if($isSuper)
                                <input type="hidden" name="role_id" value="{{ $user->role_id }}">
                                <div class="form-text text-danger d-flex align-items-center mt-2 ps-1">
                                    <i class="fa-solid fa-lock me-2"></i>
                                    <span>Akses <span class="fw-bold">Superadmin</span> dikunci demi keamanan sistem inti.</span>
                                </div>
                            @endif
                        </div>

                        <div class="col-12 mt-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1"><hr class="opacity-10"></div>
                                <div class="mx-3 text-muted small fw-bold text-uppercase ls-2">Pengaturan Password</div>
                                <div class="flex-grow-1"><hr class="opacity-10"></div>
                            </div>
                            
                            <div class="alert bg-soft-primary border-0 rounded-4 d-flex align-items-center mb-4 p-3 shadow-none">
                                <div class="text-primary me-3">
                                    <i class="fa-solid fa-key fs-4"></i>
                                </div>
                                <div class="small">
                                    <span class="fw-bold d-block text-primary">Keamanan Akun</span>
                                    <span class="text-muted">Biarkan kolom password kosong jika Anda tidak ingin mengubah password user ini.</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase ls-1">Password Baru</label>
                            <div class="input-group input-group-lg custom-input-group">
                                <span class="input-group-text bg-light border-0"><i class="fa-solid fa-lock text-muted opacity-50"></i></span>
                                <input name="password" type="password" class="form-control bg-light border-0 fs-6 ps-0" placeholder="Minimal 6 karakter">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-bold text-muted small text-uppercase ls-1">Konfirmasi Password</label>
                            <div class="input-group input-group-lg custom-input-group">
                                <span class="input-group-text bg-light border-0"><i class="fa-solid fa-check-double text-muted opacity-50"></i></span>
                                <input name="password_confirmation" type="password" class="form-control bg-light border-0 fs-6 ps-0" placeholder="Ulangi password baru">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white p-4 p-md-5 text-end border-top border-light">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-up transition-all bg-gradient-premium border-0">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
    
    .font-outfit { font-family: 'Plus Jakarta Sans', sans-serif; }
    .transition-all { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .hover-up:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(13, 110, 253, 0.25) !important; }
    .ls-1 { letter-spacing: 0.5px; }
    .ls-2 { letter-spacing: 1.5px; }
    .bg-gradient-premium { 
        background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%) !important; 
    }
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.05); }
    .backdrop-blur { backdrop-filter: blur(8px); webkit-backdrop-filter: blur(8px); }
    
    .custom-input-group {
        border-radius: 16px;
        overflow: hidden;
        border: 2px solid transparent;
        transition: all 0.2s ease;
    }
    .custom-input-group:focus-within {
        border-color: rgba(33, 147, 176, 0.3);
        background-color: #fff;
    }
    .custom-input-group .form-control:focus, 
    .custom-input-group .form-select:focus {
        background-color: transparent !important;
        box-shadow: none;
    }
    .custom-input-group .input-group-text {
        padding-left: 20px;
        padding-right: 15px;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\f105";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 0.75rem;
        color: #adb5bd;
    }
</style>
@endsection
