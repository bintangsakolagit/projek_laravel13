<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataDiri;
use App\Http\Requests\DataDiri\EditRequest;
use Illuminate\Support\Facades\Storage;

class DataDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // memanggil dan menjalanakan 2 query user dan dataDiri menggunakan with (Eager load) relasi dataDiri
        $users = User::with('dataDiri')->latest()->paginate(1);

        // mengirimkan data menggunakan variabel ke halaman views
        return view('portofolio.dataDiri.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data_diri sesuai dengan ID
        $dataDiri = DataDiri::findOrFail($id);

        return view('portofolio.dataDiri.edit', compact('dataDiri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRequest $request, DataDiri $dataDiri)
    {
        // Ambil data yang sudah lolos validasi (kecuali foto)
        $validatedData = $request->safe()->except('foto');

        // Handling Upload Foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($dataDiri->foto && Storage::disk('public')->exists($dataDiri->foto)) {
                Storage::disk('public')->delete($dataDiri->foto);
            }

            // Simpan foto baru ke folder 'storage/app/public/foto-profil'
            $path = $request->file('foto')->store('foto-profil', 'public');
            $validatedData['foto'] = $path;
        }

        // Update data di database
        $dataDiri->update($validatedData);

        return redirect()->back()->with('success', 'Data diri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
