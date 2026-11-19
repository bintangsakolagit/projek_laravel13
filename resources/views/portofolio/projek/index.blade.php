<!-- memanggil file layout yang digunakan -->
@extends('layouts.app')

<!-- mengirimkan string dashboard ke variable title -->
@section('title', 'Projek')

<!-- isi konten yang disesuaikan kebutuhan -->
@section('content')

<!-- Header & Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Daftar Projek Saya</h2>
        <a href="{{ route('projek.create') }}" class="btn btn-primary">
            + Tambah Projek
        </a>
    </div>

<!-- Alert Notifikasi Sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" width="60">No</th>
                            <th width="80">Logo</th>
                            <th>Nama Projek</th>
                            <th>Kategori</th>
                            <th>Teknologi</th>
                            <th>Status</th>
                            <th class="text-end pe-4" width="210">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projek as $item)
                            <tr>
                                <td class="ps-4">
                                    {{ $projek->firstItem() + $loop->index }}
                                </td>

                                <!-- Logo / Thumbnail -->
                                <td>
                                    @if ($item->logo)
                                        <img src="{{ asset('storage/' . $item->logo) }}" 
                                             alt="{{ $item->nama_projek }}" 
                                             class="rounded border object-fit-cover" 
                                             width="48" 
                                             height="48">
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border py-2 px-2">
                                            No Img
                                        </span>
                                    @endif
                                </td>

                                <!-- Nama Projek & Peran -->
                                <td>
                                    <div class="fw-semibold">{{ $item->nama_projek }}</div>
                                    @if ($item->peran)
                                        <small class="text-muted">{{ $item->peran }}</small>
                                    @endif
                                </td>

                                <!-- Kategori -->
                                <td>
                                    <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle">
                                        {{ $item->kategori }}
                                    </span>
                                </td>

                                <!-- Teknologi -->
                                <td>
                                    <small class="text-muted">{{ $item->teknologi ?? '-' }}</small>
                                </td>

                                <!-- Status Featured -->
                                <td>
                                    @if ($item->is_featured)
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                            Featured
                                        </span>
                                    @else
                                        <span class="badge bg-light text-secondary border">
                                            Reguler
                                        </span>
                                    @endif
                                </td>

                                <!-- Tombol Aksi: Detail, Edit, Hapus -->
                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="" 
                                           class="btn btn-outline-info">
                                            Detail
                                        </a>
                                        <a href="{{ route('projek.edit', $item->id) }}" 
                                           class="btn btn-outline-warning">
                                            Edit
                                        </a>
                                        <form action="{{ route('projek.destroy', $item->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus projek {{ $item->nama_projek }}?')">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger rounded-start-0">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    Belum ada data projek yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($projek->hasPages())
            <div class="card-footer bg-white border-top-0 py-3">
                {{ $projek->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

<!-- akhir tutup konten -->
@endsection
