@extends('layouts.app')
@section('title','Import User')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Import User</h4>
        <div class="text-muted small">Tambah banyak user sekaligus menggunakan file Excel atau CSV.</div>
    </div>
    <a href="{{ route('admin.system.users.index') }}" class="btn btn-outline-secondary rounded-3">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

@if(session('error'))
    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
@endif

<div class="row">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.system.users.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold">Pilih File Excel/CSV</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text mt-2 small">
                            Format file yang didukung: .xls, .xlsx, .csv. Maksimal 4MB.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2">
                        <i class="fa-solid fa-upload me-1"></i> Mulai Import
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 bg-light border-start border-4 border-primary">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fa-solid fa-circle-info me-2 text-primary"></i>Panduan Import</h6>
                <p class="small text-muted mb-3">Pastikan file Excel/CSV memiliki baris pertama sebagai header dengan urutan kolom berikut:</p>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered bg-white small mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Budi Santoso</td>
                                <td>budi@mail.com</td>
                                <td>secret123</td>
                                <td>operator</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="small text-muted mt-3 mb-0 ps-3">
                    <li><strong>Nama</strong>: Nama lengkap user.</li>
                    <li><strong>Email</strong>: Alamat email unik (tidak boleh duplikat).</li>
                    <li><strong>Password</strong>: Minimal 6 karakter.</li>
                    <li><strong>Role</strong>: Nama role (pilihan: <code>superadmin</code>, <code>admin</code>, <code>operator</code>, dll). Pastikan nama role sesuai dengan yang ada di sistem.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
