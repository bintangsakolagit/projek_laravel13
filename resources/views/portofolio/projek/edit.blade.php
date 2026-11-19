<!-- memanggil file layout yang digunakan -->
@extends('layouts.app')

<!-- mengirimkan string edit projek ke variable title -->
@section('title', 'Edit Projek')

<!-- isi konten yang disesuaikan kebutuhan -->
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Edit Projek</h2>
                <a href="{{ route('projek') }}" class="btn btn-outline-secondary btn-sm">
                    &larr; Kembali
                </a>
            </div>

            <!-- Alert Notifikasi Sukses -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('projek.update', $projek->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Projek -->
                        <div class="mb-3">
                            <label for="nama_projek" class="form-label">Nama Projek <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_projek') is-invalid @enderror" 
                                   id="nama_projek" 
                                   name="nama_projek" 
                                   value="{{ old('nama_projek', $projek->nama_projek) }}" 
                                   placeholder="Contoh: Sistem Informasi Akademik">
                            @error('nama_projek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori (Enum Select) -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" 
                                    id="kategori" 
                                    name="kategori">
                                @php
                                    $daftarKategori = ['Web App', 'Mobile App', 'UI/UX Design', 'Other'];
                                @endphp
                                @foreach ($daftarKategori as $item)
                                    <option value="{{ $item }}" {{ old('kategori', $projek->kategori) === $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Peran & Teknologi -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="peran" class="form-label">Peran</label>
                                <input type="text" 
                                       class="form-control @error('peran') is-invalid @enderror" 
                                       id="peran" 
                                       name="peran" 
                                       value="{{ old('peran', $projek->peran) }}" 
                                       placeholder="Contoh: Fullstack Developer">
                                @error('peran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="teknologi" class="form-label">Teknologi / Stack</label>
                                <input type="text" 
                                       class="form-control @error('teknologi') is-invalid @enderror" 
                                       id="teknologi" 
                                       name="teknologi" 
                                       value="{{ old('teknologi', $projek->teknologi) }}" 
                                       placeholder="Contoh: Laravel, Bootstrap 5, MySQL">
                                @error('teknologi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Logo / Thumbnail (2 Kolom Preview) -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo / Thumbnail Projek</label>
                            <input type="file" 
                                   class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/png, image/jpeg, image/jpg, image/webp"
                                   onchange="previewLogo(event)">
                            <div class="form-text mb-3">Format: JPG, PNG, atau WEBP. Maksimal 2MB. Biarkan kosong jika tidak ingin mengganti gambar.</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- 2 Kolom Preview Gambar -->
                            <div class="row g-3">
                                <!-- Kolom 1: Gambar Sebelumnya -->
                                <div class="col-md-6">
                                    <div class="border rounded p-3 text-center bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                                        <span class="badge bg-secondary mb-2">Logo Saat Ini</span>
                                        @if ($projek->logo)
                                            <img src="{{ asset('storage/' . $projek->logo) }}" 
                                                 alt="Logo Sebelumnya" 
                                                 class="img-fluid rounded border bg-white" 
                                                 style="max-height: 140px; object-fit: contain;">
                                        @else
                                            <div class="text-muted small py-4">Belum ada logo tersimpan</div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Kolom 2: Preview Gambar Baru -->
                                <div class="col-md-6">
                                    <div class="border rounded p-3 text-center bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                                        <span class="badge bg-primary mb-2">Preview Logo Baru</span>
                                        <img id="preview-logo-baru" 
                                             src="#" 
                                             alt="Preview Logo Baru" 
                                             class="img-fluid rounded border bg-white d-none" 
                                             style="max-height: 140px; object-fit: contain;">
                                        <div id="placeholder-logo-baru" class="text-muted small py-4">
                                            Pilih file gambar untuk melihat preview
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Projek</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Jelaskan fitur utama dan tujuan projek ini...">{{ old('deskripsi', $projek->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Link Demo & Link GitHub -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="link" class="form-label">Link Live Demo</label>
                                <input type="url" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       id="link" 
                                       name="link" 
                                       value="{{ old('link', $projek->link) }}" 
                                       placeholder="https://contoh-projek.com">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="github_link" class="form-label">Link Repository GitHub</label>
                                <input type="url" 
                                       class="form-control @error('github_link') is-invalid @enderror" 
                                       id="github_link" 
                                       name="github_link" 
                                       value="{{ old('github_link', $projek->github_link) }}" 
                                       placeholder="https://github.com/username/repo">
                                @error('github_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Is Featured (Switch) -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       role="switch" 
                                       id="is_featured" 
                                       name="is_featured" 
                                       value="1" 
                                       {{ old('is_featured', $projek->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Tampilkan sebagai Projek Unggulan (Featured)
                                </label>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('projek') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Perbarui Projek</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script Live Preview Gambar Baru -->
<script>
    function previewLogo(event) {
        const input = event.target;
        const previewImg = document.getElementById('preview-logo-baru');
        const placeholder = document.getElementById('placeholder-logo-baru');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('d-none');
                placeholder.classList.add('d-none');
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = '#';
            previewImg.classList.add('d-none');
            placeholder.classList.remove('d-none');
        }
    }
</script>

<!-- akhir tutup konten -->
@endsection