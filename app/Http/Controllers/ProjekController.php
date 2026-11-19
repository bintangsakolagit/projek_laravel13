<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Projek\ProjekRequest;
use App\Models\Projek;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projek = Projek::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('portofolio.projek.index', compact('projek'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portofolio.projek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjekRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('projek-logos', 'public');
        }

        Projek::create($data);

        return redirect()->route('projek')
            ->with('success', 'Projek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projek $projek)
    {
        return view('portofolio.projek.edit', compact('projek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjekRequest $request, Projek $projek)
    {
        // Ambil data yang sudah tervalidasi dari UpdateProjekRequest
        $validated = $request->validated();

        // Cek jika ada file logo baru yang diupload
        if ($request->hasFile('logo')) {
            // Hapus file logo lama jika ada di storage
            if ($projek->logo && Storage::disk('public')->exists($projek->logo)) {
                Storage::disk('public')->delete($projek->logo);
            }

            // Simpan logo baru
            $validated['logo'] = $request->file('logo')->store('projek-logos', 'public');
        }

        // Tangani nilai boolean untuk switch is_featured
        $validated['is_featured'] = $request->boolean('is_featured');

        // Update database
        $projek->update($validated);

        return redirect()->back()->with('success', 'Data projek berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projek $projek)
    {
        // 1. Hapus file logo dari storage jika ada
        if ($projek->logo && Storage::disk('public')->exists($projek->logo)) {
            Storage::disk('public')->delete($projek->logo);
        }

        // 2. Hapus data projek dari database
        $projek->delete();

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('projek')->with('success', 'Data projek berhasil dihapus!');
    }
}
