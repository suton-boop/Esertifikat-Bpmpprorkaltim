<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'E-Sertifikat')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    .topbar { border-bottom: 1px solid #eee; background: #fff; }
    .brand-left img { height: 52px; }
    .brand-right img { height: 42px; }
    .breadcrumb-wrap { background: #f6f7f9; border-top: 1px solid #eee; border-bottom: 1px solid #eee; }
    .content-card { border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden; background: #fff; }
    .menu a { font-weight: 600; letter-spacing: .5px; }
    .menu a:hover { text-decoration: underline; }
  </style>
</head>
<body class="bg-white">

  {{-- HEADER --}}
 <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">

    {{-- ✅ SATU LOGO SAJA --}}
    <a class="navbar-brand d-flex align-items-center gap-3" href="/">
      <img src="{{ asset('images/logo-kemendikdasmen.png') }}" 
           alt="Kemendikdasmen"
           style="height:60px; object-fit: contain;">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav gap-3">
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="{{ route('public.verify.form') }}">Verification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="{{ route('public.search') }}">Cari Sertifikat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="{{ route('login') }}">Login</a>
        </li>
      </ul>
    </div>

  </div>
</nav>


  {{-- BREADCRUMB BAR --}}
  <div class="breadcrumb-wrap">
    <div class="container py-3">
      <div class="d-inline-flex align-items-center gap-2 bg-danger text-white px-3 py-2 rounded-3">
        <span class="fw-semibold">@yield('breadcrumb', 'Home')</span>
      </div>
    </div>
  </div>

  {{-- CONTENT --}}
  <div class="container py-5" style="min-height: 60vh;">
    @yield('content')
  </div>

  {{-- FOOTER CONTACT & SOCMED --}}
  <footer class="text-white py-4 position-relative overflow-hidden mt-5" style="background-color: #1778f2;">
    <!-- Pattern Background Decoration -->
    <div class="position-absolute w-100 h-100 opacity-10" style="top: 0; left: 0; background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.8) 1px, transparent 0); background-size: 30px 30px;"></div>
    
    <div class="container position-relative z-1">
        <div class="row justify-content-center">
            
            <div class="col-12 col-md-auto">
                {{-- <div class="text-center mb-4">
                    <h5 class="fw-bold text-white mb-1">Terhubung Bersama Kami</h5>
                </div> --}}
                
                <div class="d-flex flex-column gap-3 mx-auto mt-2" style="max-width: max-content;">
                    
                    <!-- Website -->
                    <a href="https://bpmpkaltim.kemendikdasmen.go.id" target="_blank" class="text-white text-decoration-none d-flex align-items-center gap-3" style="transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        <div class="text-dark bg-transparent d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 32px;">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-normal" style="font-size: 15px; letter-spacing: 0.3px; color: #f8f9fa;">https://bpmpkaltim.kemendikdasmen.go.id</div>
                        </div>
                    </a>

                    <!-- Youtube -->
                    <a href="https://youtube.com/" target="_blank" class="text-white text-decoration-none d-flex align-items-center gap-3" style="transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        <div class="bg-danger text-white rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 28px; border-radius: 8px !important; font-size: 18px;">
                            <i class="fa-brands fa-youtube"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-normal" style="font-size: 16px; letter-spacing: 0.3px; color: #f8f9fa;">BPMP Provinsi Kalimantan Timur</div>
                        </div>
                    </a>

                    <!-- Instagram -->
                    <a href="https://instagram.com/bpmpprovkaltim" target="_blank" class="text-white text-decoration-none d-flex align-items-center gap-3" style="transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                         <div class="text-white rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 10px !important; font-size: 26px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-normal" style="font-size: 16px; letter-spacing: 0.3px; color: #f8f9fa;">bpmpprovkaltim</div>
                        </div>
                    </a>

                    <!-- Facebook -->
                    <a href="https://facebook.com/" target="_blank" class="text-white text-decoration-none d-flex align-items-center gap-3 px-1" style="transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        <div class="text-white bg-transparent d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 32px;">
                            <i class="fa-brands fa-facebook-f"></i>
                        </div>
                        <div class="text-start ms-1">
                            <div class="fw-normal" style="font-size: 16px; letter-spacing: 0.3px; color: #f8f9fa;">BPMP Provinsi Kalimantan Timur</div>
                        </div>
                    </a>

                    <!-- Whatsapp -->
                    <div class="text-white d-flex align-items-center gap-3 mt-1">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 24px;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-normal" style="font-size: 15px; color: #f8f9fa; line-height: 1.2;">Unit Layanan Terpadu</div>
                            <div class="fw-normal" style="font-size: 16px; color: #f8f9fa; line-height: 1.2;">0821 4878 8787</div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
        <div class="border-top border-white border-opacity-25 mt-4 pt-3 text-center" style="font-size: 13px; color: #e9ecef;">
            &copy; {{ date('Y') }} Balai Penjaminan Mutu Pendidikan (BPMP) Provinsi Kalimantan Timur. All rights reserved.
        </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
