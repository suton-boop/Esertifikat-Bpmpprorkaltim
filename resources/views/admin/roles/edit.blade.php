@extends('layouts.app')
@section('title','Kelola Permission Role')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div>
        <h4 class="mb-0 fw-bold"><i class="fa-solid fa-user-shield me-2 text-primary"></i>Kelola Permission Role</h4>
        <div class="text-muted mt-1">
            Mengatur hak akses sistem untuk role: <span class="badge bg-primary fs-6">{{ Str::title($role->name) }}</span>
        </div>
    </div>

    <a href="{{ route('admin.system.roles.index') }}" class="btn btn-light border-secondary shadow-sm rounded-3 fw-semibold">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

{{-- ERROR VALIDATION --}}
@if ($errors->any())
<div class="alert alert-danger">
    <div class="fw-semibold mb-1">Terjadi kesalahan:</div>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.system.roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar Permission</span>

            <span class="badge bg-primary">
                Total: {{ $permissions->count() }}
            </span>
        </div>

        <div class="card-body p-4 bg-light">
            <div class="row g-3">

                {{-- CHECKBOX PERMISSION --}}
                @foreach($permissions as $p)
                <div class="col-md-4 col-lg-3">
                    <label class="card border-0 shadow-sm h-100 d-flex flex-row align-items-center p-3" style="cursor: pointer; transition: all 0.2s ease-in-out;" onmouseover="this.classList.add('shadow'); this.style.transform='translateY(-2px)'" onmouseout="this.classList.remove('shadow'); this.style.transform='none'">
                        <div class="form-check form-switch mb-0 d-flex align-items-center ps-0 w-100">
                            <input class="form-check-input m-0 me-3 shadow-none flex-shrink-0"
                                   type="checkbox"
                                   role="switch"
                                   name="permissions[]"
                                   value="{{ $p->id }}"
                                   id="perm{{ $p->id }}"
                                   {{ in_array($p->id, $rolePerms) ? 'checked' : '' }}
                                   style="width: 2.5em; height: 1.25em; cursor: pointer;">
                            <span class="form-check-label fw-bold text-dark text-break" style="cursor: pointer;">
                                {{ str_replace('-', ' ', Str::title($p->name)) }}
                            </span>
                        </div>
                    </label>
                </div>
                @endforeach

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Centang permission yang ingin diberikan ke role ini.
                </div>

                <button type="submit" class="btn btn-success rounded-3">
                    <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
