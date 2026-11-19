<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataDiri;

class DataDiriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil user pertama yang ada di database
        $user = User::first();

        // 2. Buat 1 data DataDiri milik user tersebut
        DataDiri::create([
            'user_id'         => $user->id,
            'foto'            => 'profile/default.jpg',
            'alamat'          => 'Jl. Raya No. 123, Jakarta',
            'jenis_kelamin'   => 'L',
            'agama'           => 'Islam',
            'kewarganegaraan' => 'WNI',
            'status'          => 'Belum Menikah',
        ]);
    }
}
