@extends('layouts.app')
@section('title', 'Statistik Pengunjung')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
  <div>
    <h4 class="fw-bold mb-1">Statistik Pengunjung</h4>
    <div class="text-muted small">Pantau jumlah kunjungan dan aktivitas di platform.</div>
  </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-primary text-white">
            <h1 class="fw-bold mb-0 display-4">{{ number_format($totalVisitors) }}</h1>
            <div class="small opacity-75">Total Kunjungan</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-info text-white">
            <h1 class="fw-bold mb-0 display-4">{{ number_format($todayVisitors) }}</h1>
            <div class="small opacity-75">Kunjungan Hari Ini</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-0 py-3">
                <span class="fw-bold"><i class="fa-solid fa-chart-line me-2 text-primary"></i>Tren 30 Hari Terakhir</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Tanggal</th>
                            <th class="text-end pe-3">Unik Visitor (IP)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uniqueVisitors as $uv)
                        <tr>
                            <td class="ps-3">{{ date('d M Y', strtotime($uv->date)) }}</td>
                            <td class="text-end pe-3 fw-bold">{{ $uv->count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-3">
                <span class="fw-bold"><i class="fa-solid fa-history me-2 text-primary"></i>Kunjungan Terbaru</span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Waktu</th>
                            <th>IP Address</th>
                            <th>URL</th>
                            <th class="pe-3">User Agent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestVisitors as $v)
                        <tr>
                            <td class="ps-3 text-nowrap">{{ $v->created_at->format('H:i:s d/m/Y') }}</td>
                            <td class="text-primary font-monospace">{{ $v->ip_address }}</td>
                            <td class="text-truncate" style="max-width: 200px;" title="{{ $v->url }}">{{ str_replace(url('/'), '', $v->url) ?: '/' }}</td>
                            <td class="text-muted text-truncate pe-3" style="max-width: 250px;" title="{{ $v->user_agent }}">{{ $v->user_agent }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">Belum ada data kunjungan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
