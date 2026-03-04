@extends('layouts.app')
@section('title','Sertifikat Terbit')

@section('content')
@php
  $events       = $events ?? collect();
  $certificates = $certificates ?? null;

  $q       = $q ?? request('q', '');
  $eventId = $eventId ?? request('event_id', '');
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
  <div>
    <h4 class="mb-0">Sertifikat Terbit</h4>
    <div class="text-muted">Daftar sertifikat yang telah diterbitkan atau ditandatangani secara elektronik (TTE).</div>
  </div>
</div>

<form method="GET" action="{{ route('admin.certificates.published') }}"
      class="card border-0 shadow-sm rounded-4 mb-3">
  <div class="card-body">
    <div class="row g-2 align-items-end">
      <div class="col-lg-6">
        <label class="form-label small text-muted mb-1">Cari</label>
        <input type="text" name="q" class="form-control" value="{{ $q }}"
               placeholder="Cari nama / nomor referensi / NIK...">
      </div>

      <div class="col-lg-5">
        <label class="form-label small text-muted mb-1">Event</label>
        <select name="event_id" class="form-select">
          <option value="">-- Semua Event --</option>
          @foreach($events as $ev)
            <option value="{{ $ev->id }}" @selected((string)$eventId === (string)$ev->id)>
              {{ $ev->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-lg-1 d-flex gap-2">
        <button class="btn btn-primary w-100" title="Cari">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <a class="btn btn-outline-secondary" href="{{ route('admin.certificates.published') }}" title="Reset">
          <i class="fa-solid fa-rotate-left"></i>
        </a>
      </div>
    </div>
  </div>
</form>

<div class="card border-0 shadow-sm rounded-4">
  <div class="card-header bg-white border-0 d-flex flex-wrap justify-content-between align-items-center gap-2">
    <div>
      <div class="fw-semibold">Daftar Sertifikat Terbit</div>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="text-muted small">Total: {{ $certificates?->total() ?? 0 }}</div>
        <a href="{{ route('admin.certificates.published.export', request()->query()) }}" class="btn btn-sm btn-success text-white fw-medium">
            <i class="fa-solid fa-file-excel me-1"></i> Eksport ke Excel
        </a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th width="5%">#</th>
          <th>Nama Peserta</th>
          <th>Nomor Sertifikat</th>
          <th>Event</th>
          <th>Status</th>
          <th width="15%" class="text-end">Aksi</th>
        </tr>
      </thead>

      <tbody>
      @if(!$certificates || $certificates->isEmpty())
        <tr>
          <td colspan="6" class="text-center text-muted py-4">Belum ada sertifikat terbit.</td>
        </tr>
      @else
        @foreach($certificates as $cert)
          <tr>
            <td>{{ ($certificates->currentPage()-1)*$certificates->perPage() + $loop->iteration }}</td>

            <td class="fw-semibold">
              {{ $cert->participant->name ?? '-' }}
              @if($cert->participant->institution)
                <div class="text-muted small">{{ $cert->participant->institution }}</div>
              @endif
            </td>

            <td>
              <span class="fw-semibold text-primary">{{ $cert->certificate_number ?? '-' }}</span>
            </td>

            <td>{{ $cert->event?->name ?? '-' }}</td>

            <td>
              <span class="badge bg-success"><i class="fa-solid fa-check-circle me-1"></i> Terbit</span>
            </td>

            <td class="text-end">
              <div class="d-inline-flex gap-2">

                @php
                  $hasPdf = !empty($cert->signed_pdf_path) || !empty($cert->pdf_path);
                @endphp

                @if($hasPdf)
                  {{-- Preview --}}
                  <a class="btn btn-outline-success btn-sm rounded-3"
                     href="{{ route('admin.certificates.view', $cert->id) }}"
                     target="_blank"
                     title="Preview PDF Final">
                    <i class="fa-solid fa-eye"></i>
                  </a>

                  {{-- Download --}}
                  <a class="btn btn-outline-primary btn-sm rounded-3"
                     href="{{ route('admin.certificates.download', $cert->id) }}"
                     title="Download PDF">
                    <i class="fa-solid fa-download"></i>
                  </a>
                @else
                  <button class="btn btn-outline-secondary btn-sm rounded-3" disabled title="PDF belum ada">
                    <i class="fa-solid fa-eye"></i>
                  </button>
                  <button class="btn btn-outline-secondary btn-sm rounded-3" disabled title="PDF belum ada">
                    <i class="fa-solid fa-download"></i>
                  </button>
                @endif

              </div>
            </td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>

  @if($certificates && $certificates->hasPages())
    <div class="card-footer bg-white border-0 d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div class="text-muted small">
        Menampilkan {{ $certificates->firstItem() }} - {{ $certificates->lastItem() }}
        dari {{ $certificates->total() }} data
      </div>
      <div>{{ $certificates->links() }}</div>
    </div>
  @endif
</div>
@endsection
