<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HalamanDepanController extends Controller
{
    public function index()
    {
        // Mengambil data user pertama beserta relasi dataDiri dan projek
        $user = User::with([
            'dataDiri',
            'projek' => function ($query) {
                $query->orderByDesc('is_featured')->latest();
            }
        ])->first();

        return view('welcome', compact('user'));
    }
}
