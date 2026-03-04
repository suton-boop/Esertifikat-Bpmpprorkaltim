@extends('layouts.app')
@section('title','Tambah Template')

@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
  <div>
    <div class="text-muted small mb-1">
      <i class="fa-regular fa-folder-open me-1"></i>
      Manajemen Sistem / Template Sertifikat / Tambah
    </div>
    <h4 class="page-title mb-1">Tambah Template</h4>
    <div class="page-subtitle">Upload file template sertifikat dan isikan datanya.</div>
  </div>

  <a href="{{ route('admin.system.templates.index') }}" class="btn btn-outline-secondary btn-icon">
    <i class="fa-solid fa-arrow-left"></i> Kembali
  </a>
</div>

@if ($errors->any())
  <div class="alert alert-danger card-soft">
    <div class="fw-semibold mb-1">Periksa kembali input:</div>
    <ul class="mb-0">
      @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST"
      action="{{ route('admin.system.templates.store') }}"
      enctype="multipart/form-data">
  @csrf

  <div class="row g-3">
    {{-- LEFT: MAIN INFO --}}
    <div class="col-lg-7">
      <div class="card card-soft">
        <div class="card-body">
          <div class="fw-semibold mb-2">Informasi Template</div>

          <div class="row g-3 mt-1">
            <div class="col-12">
              <label class="form-label">Nama Template</label>
              <input type="text"
                     name="name"
                     class="form-control"
                     value="{{ old('name') }}"
                     placeholder="Contoh: Penguatan Literasi"
                     required>
            </div>

            <div class="col-md-4">
              <label class="form-label">Kode</label>
              <div class="input-group shadow-sm">
                <input type="text"
                       name="code"
                       id="templateCode"
                       class="form-control bg-light fw-bold text-primary"
                       value="{{ old('code', 'TPL-' . strtoupper(Str::random(5))) }}"
                       placeholder="Otomatis"
                       readonly
                       required>
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('templateCode').value = 'TPL-' + Math.random().toString(36).substring(2, 7).toUpperCase();" title="Refresh/Generate Ulang Kode">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </button>
              </div>
              <div class="form-text mt-1">Kode otomatis digenerate secara acak.</div>
            </div>

            <div class="col-md-8">
              <label class="form-label">Status</label>
              <select name="is_active" class="form-select">
                <option value="1" @selected(old('is_active', 1) == 1)>Aktif</option>
                <option value="0" @selected(old('is_active') == 0)>Nonaktif</option>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label">Deskripsi Template (opsional)</label>
              <textarea name="description"
                        class="form-control"
                        rows="3"
                        placeholder="Catatan internal template.">{{ old('description') }}</textarea>
            </div>
          </div>
        </div>
      </div>

      {{-- BACKGROUND FILE --}}
      <div class="card card-soft mt-3">
        <div class="card-body">
          <div class="fw-semibold mb-2">Background</div>

          <label class="form-label">File Background Halaman Depan</label>
          <input type="file" name="background" class="form-control" required>

          <div class="form-text mt-2">
            Disarankan PNG atau JPG berukuran A4.
          </div>
        </div>
      </div>
    </div>

    {{-- RIGHT: JSON SETTINGS & PAGE 2 CONF --}}
    <div class="col-lg-5">
      
      <div class="card card-soft mb-3">
        <div class="card-body">
          <div class="fw-semibold mb-2">Konfigurasi Halaman 2 (Transkrip/Struktur)</div>
          
          <label class="form-label">Background Halaman 2 (Opsional)</label>
          <input type="file" name="page_2_background" class="form-control mb-2">

          <label class="form-label">Editor HTML Halaman 2</label>
          <textarea name="page_2_html"
                    class="form-control"
                    rows="8"
                    placeholder="Contoh: <table>...</table> atau @{{ nama_kolom_excel }}">{{ old('page_2_html') }}</textarea>
          <div class="form-text">
            Tabel struktur program atau nilai. Anda bisa memanggil nilai dari Excel. Kosongkan jika sertifikat hanya 1 halaman.
          </div>
        </div>
      </div>

      <div class="card card-soft">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="fw-semibold">Settings (JSON)</div>
          </div>

          <div class="form-text mb-2">
            Format JSON untuk letak text.
          </div>
          
          @php
             $defaultSettingsJSON = json_encode([
                 "fields" => [
                     "number" => ["x"=>0,"y"=>210,"w"=>1123,"font"=>16,"color"=>"#111111","align"=>"center","weight"=>"600"],
                     "name" => ["x"=>0,"y"=>315,"w"=>1123,"font"=>48,"color"=>"#0b5fa8","align"=>"center","weight"=>"700"],
                     "event" => ["x"=>0,"y"=>410,"w"=>1123,"font"=>20,"color"=>"#0b5fa8","align"=>"center","weight"=>"400"],
                     "desc" => ["x"=>120,"y"=>450,"w"=>880,"font"=>16,"color"=>"#111111","align"=>"justify","weight"=>"400"],
                     "date" => ["x"=>0,"y"=>567,"w"=>1123,"font"=>16,"color"=>"#111111","align"=>"center","weight"=>"500"]
                 ]
             ], JSON_PRETTY_PRINT);
          @endphp

          <textarea id="settingsJson"
                    name="settings"
                    class="form-control mono"
                    rows="18"
                    placeholder='{"fields":{"name":{"x":0,"y":0,"font":18}}}'>{{ old('settings', $defaultSettingsJSON) }}</textarea>
        </div>
      </div>
    </div>
  </div>

  {{-- ACTIONS --}}
  <div class="d-flex justify-content-end gap-2 mt-3">
    <a href="{{ route('admin.system.templates.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button class="btn btn-primary btn-icon">
      <i class="fa-solid fa-floppy-disk"></i> Simpan
    </button>
  </div>
</form>
@endsection
