@extends('layouts.app')
@section('title','Laporan Sertifikat')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
  <div>
    <h4 class="mb-0">Laporan & Statistik</h4>
    <div class="text-muted">Ringkasan penerbitan E-Sertifikat per kegiatan.</div>
  </div>
  
  <form method="GET" action="{{ route('admin.reports') }}" class="d-flex gap-2">
    <select name="year" class="form-select border-0 shadow-sm rounded-3 fw-semibold text-primary" onchange="this.form.submit()" style="min-width: 140px; cursor: pointer;">
      @foreach($years as $y)
        <option value="{{ $y }}" @selected($y == $year)>Tahun {{ $y }}</option>
      @endforeach
    </select>
  </form>
</div>

{{-- WIDGETS --}}
<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Total Event</div>
            <h3 class="mb-0 fw-bold">{{ number_format($totalEvents) }}</h3>
          </div>
          <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-calendar-days"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Total Peserta</div>
            <h3 class="mb-0 fw-bold text-primary">{{ number_format($totalParticipants) }}</h3>
          </div>
          <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-users"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Draf Baru</div>
            <h3 class="mb-0 fw-bold text-warning">{{ number_format($totalDraft) }}</h3>
          </div>
          <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-file-invoice"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-muted small fw-semibold text-uppercase mb-1">Telah Terbit</div>
            <h3 class="mb-0 fw-bold text-success">{{ number_format($totalSigned) }}</h3>
          </div>
          <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px;">
            <i class="fa-solid fa-certificate"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- TABEL LAPORAN --}}
<div class="card border-0 shadow-sm rounded-4">
  <div class="card-header bg-white border-bottom-0 py-3">
    <h6 class="mb-0 mx-2 mt-2 fw-semibold">Rincian Per Event (Tahun {{ $year }})</h6>
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th width="5%" class="text-center">#</th>
          <th>Nama Event</th>
          <th>Tanggal</th>
          <th class="text-center">Total Peserta</th>
          <th class="text-center">Total Sertifikat</th>
          <th class="text-center">Draft</th>
          <th class="text-center">Waiting Approval</th>
          <th class="text-center">TTE Ready</th>
          <th class="text-center">Final (Terbit)</th>
        </tr>
      </thead>
      <tbody>
        @forelse($events as $ev)
          <tr>
            <td class="text-center text-muted">{{ ($events->currentPage() - 1) * $events->perPage() + $loop->iteration }}</td>
            <td class="fw-semibold">
                {{ $ev->name }}
            </td>
            <td>
                @if($ev->start_date)
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-regular fa-calendar text-muted"></i>
                        {{ \Carbon\Carbon::parse($ev->start_date)->translatedFormat('d M Y') }}
                    </div>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td class="text-center">
                <span class="badge bg-light text-dark border">{{ $ev->participants_count }}</span>
            </td>
            <td class="text-center">
                <span class="badge bg-secondary">{{ $ev->certificates_count }}</span>
            </td>
            
            <td class="text-center">
                @if($ev->cert_draft > 0)
                    <span class="badge bg-warning text-dark">{{ $ev->cert_draft }}</span>
                @else <span class="text-muted small">-</span> @endif
            </td>
            <td class="text-center">
                @if($ev->cert_submitted > 0)
                    <span class="badge bg-info text-dark">{{ $ev->cert_submitted }}</span>
                @else <span class="text-muted small">-</span> @endif
            </td>
            <td class="text-center">
                @if($ev->cert_approved > 0)
                    <span class="badge bg-primary">{{ $ev->cert_approved }}</span>
                @else <span class="text-muted small">-</span> @endif
            </td>
            <td class="text-center">
                @if($ev->cert_signed > 0)
                    <span class="badge bg-success shadow-sm px-2 py-1"><i class="fa-solid fa-check me-1"></i> {{ $ev->cert_signed }}</span>
                @else <span class="text-muted small">-</span> @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center py-5 text-muted">
                <div class="fs-1 text-light mb-3"><i class="fa-solid fa-folder-open"></i></div>
                Belum ada data event / sertifikat di tahun ini.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  
  @if($events->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="text-muted small ps-2">
                Menampilkan <strong>{{ $events->firstItem() }}</strong> hingga <strong>{{ $events->lastItem() }}</strong> dari total <strong>{{ $events->total() }}</strong> kegiatan
            </div>
            <div class="pe-2">{{ $events->links() }}</div>
        </div>
    </div>
  @endif
</div>
@endsection
