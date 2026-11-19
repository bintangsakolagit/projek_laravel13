<!-- memanggil file layout yang digunakan -->
@extends('layouts.app')

<!-- mengirimkan string dashboard ke variable title -->
@section('title', 'Data Diri')

<!-- isi konten yang disesuaikan kebutuhan -->
@section('content')

<div class="row justify-content-center">
        <div class="col-md-8">

        <!-- notifikasi jika berhasil ubah password -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Profil & Data Diri</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('dataDiri.update', $dataDiri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Preview Foto & Input File -->
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                @if($dataDiri->foto && \Storage::disk('public')->exists($dataDiri->foto))
                                    <img src="{{ asset('storage/' . $dataDiri->foto) }}" 
                                        id="img-preview"
                                        alt="Foto Profil" 
                                        class="rounded-circle img-thumbnail" 
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/150?text=No+Image" 
                                        id="img-preview"
                                        alt="Default Foto" 
                                        class="rounded-circle img-thumbnail" 
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                            </div>

                            <div class="col-md-6 mx-auto">
                                <label for="foto" class="form-label font-weight-bold">Ubah Foto Profil</label>
                                
                                <!-- Tambahkan id="foto" dan onchange="previewImage()" -->
                                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" onchange="previewImage()">
                                
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>

                        <hr>

                        <!-- Input Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $dataDiri->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Jenis Kelamin -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin', $dataDiri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $dataDiri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Agama -->
                            <div class="col-md-6 mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" value="{{ old('agama', $dataDiri->agama) }}">
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Kewarganegaraan -->
                            <div class="col-md-6 mb-3">
                                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control @error('kewarganegaraan') is-invalid @enderror" value="{{ old('kewarganegaraan', $dataDiri->kewarganegaraan ?? 'WNI') }}">
                                @error('kewarganegaraan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status Perkawinan</label>
                                <input type="text" name="status" id="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status', $dataDiri->status) }}" placeholder="Belum Menikah / Menikah">
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-md-end mt-4">
                            <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('#img-preview');

            // Pastikan ada file yang dipilih
            if (image.files && image.files[0]) {
                const oFReader = new FileReader();
                
                // Baca file sebagai Data URL (base64)
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    // Ubah atribut src gambar dengan file baru
                    imgPreview.src = oFREvent.target.result;
                }
            }
        }
    </script>
    
<!-- akhir tutup konten -->
@endsection