@extends('layouts.app')
@section('title','Tambah Peserta')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h4 class="mb-0">Tambah Peserta</h4>
    <div class="text-muted">Tambahkan peserta ke event.</div>
  </div>
  <a href="{{ route('admin.participants.index', ['event_id' => request('event_id')]) }}"
     class="btn btn-outline-secondary rounded-3">
    Kembali
  </a>
</div>

@if ($errors->any())
  <div class="alert alert-danger">
    <div class="fw-semibold mb-1">Periksa input:</div>
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('admin.participants.store') }}" class="card border-0 shadow-sm rounded-4">
  @csrf
  <div class="card-body">
    <div class="row g-3">

      <div class="col-md-6">
        <label class="form-label">Event</label>
        <select name="event_id" class="form-select" required>
          <option value="">-- Pilih Event --</option>
          @foreach($events as $ev)
            <option value="{{ $ev->id }}" @selected(old('event_id', $eventId) == $ev->id)>
              {{ $ev->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
          <option value="draft"  @selected(old('status','draft')==='draft')>Draft</option>
          <option value="terbit" @selected(old('status')==='terbit')>Terbit</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input name="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Email (opsional)</label>
        <input name="email" type="email" class="form-control" value="{{ old('email') }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">NIK (opsional)</label>
        <input name="nik" class="form-control" value="{{ old('nik') }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">Instansi (opsional)</label>
        <input name="institution" class="form-control" value="{{ old('institution') }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">Kab./Kota/Propinsi (opsional)</label>
        <select name="daerah" class="form-select">
          <option value="">-- Pilih Daerah --</option>
          @foreach(['Prov. Kalimantan Timur', 'Kab. Paser', 'Kab. Berau', 'Kab. Kutai Kartanegara', 'Kab. Kutai Barat', 'Kab. Kutai Timur', 'Kab. Penajam Paser Utara', 'Kab. Mahakam Ulu', 'Kota Balikpapan', 'Kota Samarinda', 'Kota Bontang'] as $d)
            <option value="{{ $d }}" @selected(old('daerah') === $d)>{{ $d }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Jenjang (opsional)</label>
        <select name="jenjang" class="form-select">
          <option value="">-- Pilih Jenjang --</option>
          @foreach(['PAUD-TK', 'SD', 'SMP', 'SMA', 'SMK', 'PNF', 'Umum'] as $j)
            <option value="{{ $j }}" @selected(old('jenjang') === $j)>{{ $j }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Peran (opsional)</label>
        <input name="peran" class="form-control" value="{{ old('peran') }}">
      </div>

      <div class="col-md-12">
        <label class="form-label">Keterangan (opsional)</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan') }}</textarea>
      </div>

    </div>
  </div>

  <div class="card-footer bg-white d-flex justify-content-end">
    <button class="btn btn-primary rounded-3">
      <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
    </button>
  </div>
</form>
@endsection
