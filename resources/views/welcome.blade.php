<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - {{ $user->name ?? 'Developer' }}</title>

     <!-- Memuat Aset Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light text-dark">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">{{ $user->name ?? 'Portofolio' }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projek">Projek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if($user)
        <!-- Hero Section -->
        <header class="bg-primary text-white py-5">
            <div class="container py-4">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        @if($user->dataDiri && $user->dataDiri->foto)
                            <img src="{{ asset('storage/' . $user->dataDiri->foto) }}" 
                                 alt="Foto {{ $user->name }}" 
                                 class="rounded-circle img-thumbnail shadow object-fit-cover" 
                                 width="220" height="220">
                        @else
                            <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center shadow fs-1 fw-bold" 
                                 style="width: 220px; height: 220px;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8 text-center text-md-start">
                        <span class="badge bg-light text-primary mb-2 px-3 py-2 rounded-pill fw-semibold">
                            Selamat Datang di Portofolio Saya
                        </span>
                        <h1 class="display-4 fw-bold">{{ $user->name }}</h1>
                        <p class="lead mb-4">{{ $user->email }}</p>
                        <a href="#projek" class="btn btn-light btn-lg fw-semibold text-primary me-2">Lihat Projek</a>
                        <a href="#profil" class="btn btn-outline-light btn-lg">Data Diri</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Section Data Diri -->
        <section id="profil" class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title mb-0 fw-bold text-primary">Informasi Data Diri</h3>
                            </div>
                            <div class="card-body p-4">
                                @if($user->dataDiri)
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <th class="w-25 text-muted">Nama Lengkap</th>
                                                <td class="fw-semibold">: {{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Jenis Kelamin</th>
                                                <td>: {{ $user->dataDiri->jenis_kelamin ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Agama</th>
                                                <td>: {{ $user->dataDiri->agama ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Kewarganegaraan</th>
                                                <td>: {{ $user->dataDiri->kewarganegaraan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Status</th>
                                                <td>: 
                                                    <span class="badge bg-success">
                                                        {{ $user->dataDiri->status ?? '-' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-muted">Alamat</th>
                                                <td>: {{ $user->dataDiri->alamat ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        Data diri belum dilengkapi.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Projek -->
        <section id="projek" class="py-5 bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Daftar Projek</h2>
                    <p class="text-muted">Kumpulan karya dan projek yang pernah dikerjakan</p>
                </div>

                @if($user->projek->count() > 0)
                    <div class="row g-4">
                        @foreach($user->projek as $item)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 shadow-sm border-{{ $item->is_featured ? 'primary' : 'light' }}">
                                    @if($item->logo)
                                        <img src="{{ asset('storage/' . $item->logo) }}" 
                                             class="card-img-top object-fit-cover" 
                                             alt="{{ $item->nama_projek }}" 
                                             height="200">
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <span class="fw-semibold">{{ $item->kategori ?? 'Projek' }}</span>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge bg-info text-dark">{{ $item->kategori }}</span>
                                            @if($item->is_featured)
                                                <span class="badge bg-warning text-dark">Unggulan</span>
                                            @endif
                                        </div>

                                        <h5 class="card-title fw-bold">{{ $item->nama_projek }}</h5>
                                        <p class="text-muted small mb-2">Peran: <strong>{{ $item->peran }}</strong></p>
                                        <p class="card-text text-secondary flex-grow-1">
                                            {{ $item->deskripsi }}
                                        </p>

                                        @if($item->teknologi)
                                            <div class="mb-3">
                                                @foreach(explode(',', $item->teknologi) as $tech)
                                                    <span class="badge bg-light text-dark border me-1">{{ trim($tech) }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-footer bg-white border-top-0 pb-3 pt-0 d-flex gap-2">
                                        @if($item->link)
                                            <a href="{{ $item->link }}" target="_blank" class="btn btn-primary btn-sm flex-fill">
                                                Lihat Demo
                                            </a>
                                        @endif
                                        @if($item->github_link)
                                            <a href="{{ $item->github_link }}" target="_blank" class="btn btn-outline-dark btn-sm flex-fill">
                                                GitHub
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        Belum ada data projek yang ditambahkan.
                    </div>
                @endif
            </div>
        </section>

        <!-- Footer / Kontak -->
        <footer id="kontak" class="bg-dark text-white py-4 mt-5">
            <div class="container text-center">
                <h5 class="fw-bold mb-2">{{ $user->name }}</h5>
                <p class="text-white-50 mb-3">Hubungi saya melalui email: {{ $user->email }}</p>
                <hr class="border-secondary">
                <p class="small text-white-50 mb-0">&copy; {{ date('Y') }} {{ $user->name }}. Dibuat dengan Laravel & Bootstrap 5.</p>
            </div>
        </footer>

    @else
        <!-- Tampilan jika tabel users masih kosong -->
        <div class="container py-5 text-center">
            <div class="alert alert-danger">
                Data User belum tersedia di database. Silakan jalankan Seeder atau tambahkan data terlebih dahulu.
            </div>
        </div>
    @endif

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>