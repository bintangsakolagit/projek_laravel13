<!-- memanggil file layout yang digunakan -->
@extends('layouts.app')

<!-- mengirimkan string dashboard ke variable title -->
@section('title', 'Data Diri')

<!-- isi konten yang disesuaikan kebutuhan -->
@section('content')

<h1>ini halaman data diri</h1>

<table class="table table-secondary table-striped">
  <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Foto</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Agama</th>
        <th scope="col">Kewarganegaraan</th>
        <th scope="col">Status</th>
        <th scope="col">Alamat</th>
        <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">1</th>
            <td>
                <img src="{{ asset('storage/' . $user->dataDiri->foto) }}" 
                alt="default.jpg"
                class="rounded border object-fit-cover" 
                width="48" 
                height="48">
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->dataDiri->jenis_kelamin }}</td>
            <td>{{ $user->dataDiri->agama }}</td>
            <td>{{ $user->dataDiri->kewarganegaraan }}</td>
            <td>{{ $user->dataDiri->status }}</td>
            <td>{{ $user->dataDiri->alamat }}</td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('dataDiri.edit', $user->dataDiri->id) }}" class="btn btn-warning">Edit</a>
                    <a href="" class="btn btn-primary">Detail</a>
                </div>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

<!-- akhir tutup konten -->
@endsection