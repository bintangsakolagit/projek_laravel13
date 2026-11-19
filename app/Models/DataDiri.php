<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//memanggil class BelongTo
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataDiri extends Model
{
    // Deklarasi nama tabel secara eksplisit (opsional jika mengikuti konvensi Laravel 'data_diris')
    protected $table = 'data_diri';

    //nama kolom pada database yang boleh di isi
    protected $fillable = [
        'user_id',
        'foto',
        'alamat',
        'jenis_kelamin',
        'agama',
        'kewarganegaraan',
        'status',
    ];

    /**
     * Relasi balik ke tabel User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
