<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; }
    .qr { position: fixed; right: 40px; bottom: 40px; width: 120px; height: 120px; }
    .tte { position: fixed; right: 40px; bottom: 170px; font-size: 12px; }
  </style>
</head>
<body>
  <h2>SERTIFIKAT</h2>
  <p>Nama: <b>{{ $cert->participant?->name }}</b></p>
  <p>Event: {{ $cert->event?->name }}</p>
  <p>No: {{ $cert->certificate_number }}</p>

  @if(!empty($showTte))
    <div class="tte">TTE: {{ $signerCode }} | {{ now()->format('d-m-Y H:i') }}</div>
  @endif

  @if(!empty($showBarcode))
    <img class="qr" src="{{ $qrDataUri }}" alt="QR Verify">
  @endif
</body>
</html>