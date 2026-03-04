@extends('layouts.app')
@section('title','Kelola Permission')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
  <div>
    <h4 class="mb-0 fw-bold"><i class="fa-solid fa-key me-2 text-primary"></i>Kelola Permission</h4>
    <div class="text-muted mt-1">Daftar hak akses sistem (dikelompokkan per modul fungsionalitas).</div>
  </div>

  <span class="badge bg-primary fs-6 px-3 py-2 shadow-sm rounded-pill">
    Total: {{ $permissions->count() }} Permission
  </span>
</div>

@php
  // helper label friendly
  $labels = [
    'dashboard-read'      => 'Lihat Dashboard',

    'event-manage'        => 'Kelola Event',
    'participant-manage'  => 'Kelola Peserta',
    'template-manage'     => 'Kelola Template Sertifikat',

    'certificate-generate'=> 'Generate Sertifikat',
    'certificate-send'    => 'Kirim Sertifikat via Email',
    'certificate-approve' => 'Persetujuan Sertifikat',

    'tte-manage'          => 'Kelola TTE (Tanda Tangan Elektronik)',
    'monitoring-read'     => 'Lihat Monitoring',
    'audit-read'          => 'Lihat Audit Trail',

    'user-manage'         => 'Kelola User',
    'role-manage'         => 'Kelola Role',
    'permission-manage'   => 'Kelola Permission',
  ];

  // mapping group berdasarkan prefix/kategori
  $groups = [
    'Dashboard' => ['dashboard-read'],
    'Event & Peserta' => ['event-manage','participant-manage'],
    'Sertifikat' => ['template-manage','certificate-generate','certificate-send','certificate-approve'],
    'TTE & Monitoring' => ['tte-manage','monitoring-read','audit-read'],
    'Manajemen Sistem' => ['user-manage','role-manage','permission-manage'],
  ];

  // buat lookup cepat: name => Permission model
  $permMap = $permissions->keyBy('name');
@endphp

<div class="row g-4">
  @foreach($groups as $groupName => $permNames)
    <div class="col-12 col-xl-6">
      <div class="card border-0 shadow-sm rounded-4 h-100 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'">
        <div class="card-header border-bottom-0 bg-transparent pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
          <div class="d-inline-flex align-items-center px-3 py-2 bg-primary bg-opacity-10 text-primary rounded-3 shadow-sm" style="border-left: 4px solid #0d6efd;">
             <h6 class="fw-bold mb-0" style="letter-spacing: 0.3px;">{{ $groupName }}</h6>
          </div>
          <span class="badge bg-light text-dark border rounded-pill px-3">
            {{ collect($permNames)->filter(fn($n)=>$permMap->has($n))->count() }}
          </span>
        </div>

        <div class="card-body px-4 pb-4">
          <div class="row g-3">
            @foreach($permNames as $name)
              @php
                $p = $permMap->get($name);
              @endphp

              @if($p)
                <div class="col-12 col-md-6">
                  <div class="border rounded-3 p-3 bg-light h-100 d-flex align-items-center p-2" style="border-color: #f1f5f9 !important;">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0 me-3" style="width: 40px; height: 40px;">
                      <i class="fa-solid fa-check text-success"></i>
                    </div>
                    <div>
                      <div class="fw-bold text-dark fs-6">{{ $labels[$name] ?? $name }}</div>
                      <div class="text-muted small font-monospace">{{ $name }}</div>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </div>

      </div>
    </div>
  @endforeach
</div>

{{-- Jika ada permission yang tidak masuk mapping, tampilkan di bawah --}}
@php
  $known = collect($groups)->flatten()->unique();
  $unknown = $permissions->filter(fn($p)=> !$known->contains($p->name));
@endphp

@if($unknown->count())
  <div class="card border-0 shadow-sm rounded-4 mt-4 bg-white" style="transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='none'">
    <div class="card-header border-bottom-0 bg-transparent pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
      <div class="d-inline-flex align-items-center px-3 py-2 bg-secondary bg-opacity-10 text-secondary rounded-3 shadow-sm" style="border-left: 4px solid #6c757d;">
        <h6 class="fw-bold mb-0" style="letter-spacing: 0.3px;"><i class="fa-solid fa-boxes-stacked me-2"></i>Lainnya (Uncategorized)</h6>
      </div>
      <span class="badge bg-secondary rounded-pill px-3">{{ $unknown->count() }}</span>
    </div>
    
    <div class="card-body px-4 pb-4">
      <div class="row g-3">
        @foreach($unknown as $p)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="border rounded-3 p-3 bg-light h-100 d-flex align-items-center" style="border-color: #f8f9fa !important;">
                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm flex-shrink-0 me-3 opacity-50" style="width: 40px; height: 40px;">
                      <i class="fa-solid fa-tag text-secondary"></i>
                </div>
                <div>
                  <div class="fw-bold text-dark">{{ $p->name }}</div>
                  <div class="text-muted" style="font-size:12px;">Permission belum dikelompokkan</div>
                </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
@endsection
