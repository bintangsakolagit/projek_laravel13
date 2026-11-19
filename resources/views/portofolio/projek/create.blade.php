<!-- memanggil file layout yang digunakan -->
@extends('layouts.app')

<!-- mengirimkan string dashboard ke variable title -->
@section('title', 'Tambah Projek')

<!-- isi konten yang disesuaikan kebutuhan -->
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Tambah Projek Baru</h2>
                <a href="{{ route('projek') }}" class="btn btn-outline-secondary btn-sm">
                    &larr; Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('projek.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Projek -->
                        <div class="mb-3">
                            <label for="nama_projek" class="form-label">Nama Projek <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_projek') is-invalid @enderror" 
                                   id="nama_projek" 
                                   name="nama_projek" 
                                   value="{{ old('nama_projek') }}" 
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
                                    <option value="{{ $item }}" {{ old('kategori', 'Web App') === $item ? 'selected' : '' }}>
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
                                       value="{{ old('peran') }}" 
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
                                       value="{{ old('teknologi') }}" 
                                       placeholder="Contoh: Laravel, Bootstrap 5, MySQL">
                                @error('teknologi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Logo / Thumbnail -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo / Thumbnail Projek</label>
                            <input type="file" 
                                   class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/png, image/jpeg, image/jpg, image/webp">
                            <div class="form-text">Format: JPG, PNG, atau WEBP. Maksimal 2MB.</div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Projek</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Jelaskan fitur utama dan tujuan projek ini...">{{ old('deskripsi') }}</textarea>
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
                                       value="{{ old('link') }}" 
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
                                       value="{{ old('github_link') }}" 
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
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Tampilkan sebagai Projek Unggulan (Featured)
                                </label>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-light">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan Projek</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- akhir tutup konten -->
@endsection
