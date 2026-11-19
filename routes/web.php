<?php

use Illuminate\Support\Facades\Route;
//memanggil AuthController
use App\Http\Controllers\AuthController;
//memanggil PasswordController
use App\Http\Controllers\PasswordController;
//memanggil DataDiriController 
use App\Http\Controllers\DataDiriController;
//memanggil ProjekController 
use App\Http\Controllers\ProjekController;
//memanggil controller
use App\Http\Controllers\HalamanDepanController;

//untuk menampilkan halaman landing page portofolio
Route::get('/', [HalamanDepanController::class, 'index'])->name('home');
    
// Route khusus tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login098', [AuthController::class, 'showLoginForm123'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('proses_login');
});

// Route yang diproteksi middleware 'auth' (hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('portofolio.dashboard');
    });

    // route ubah password 
    Route::get('/ubah-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/ubah-password', [PasswordController::class, 'update'])->name('password.update');

    //Route DataDiri
    Route::get('/dataDiri', [DataDiriController::class, 'index'])->name('dataDiri');
    // Menampilkan detail data diri & form update
    Route::get('/dataDiri/edit/{id}', [DataDiriController::class, 'edit'])->name('dataDiri.edit'); 
    //route proses edit data diri
    Route::put('/dataDiri/update/{dataDiri}', [DataDiriController::class, 'update'])->name('dataDiri.update');

    //Route Projek
    //Untuk menjalankan method index di ProjekController
    Route::get('/projek', [ProjekController::class, 'index'])->name('projek');
    //untuk menjalankan method create 
    Route::get('/projek/create', [ProjekController::class, 'create'])->name('projek.create');
    //untuk menjalankan method store
    Route::post('/projek/store', [ProjekController::class, 'store'])->name('projek.store');
    // Menampilkan detail projek & form update
    Route::get('/projek/edit/{projek}', [ProjekController::class, 'edit'])->name('projek.edit'); 
    //route proses edit projek
    Route::put('/projek/update/{projek}', [ProjekController::class, 'update'])->name('projek.update');
    //route untuk proses hapus projek
    Route::delete('/projek/{projek}', [ProjekController::class, 'destroy'])->name('projek.destroy');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
