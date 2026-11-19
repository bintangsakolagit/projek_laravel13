<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Projek extends Model
{
    //Mendefinisikan tabel kita
    protected $table = 'projek';

    //mendefisinikan nama nama tabel yang boleh di isi
    protected $fillable = [
        'user_id',
        'nama_projek',
        'kategori',
        'peran',
        'teknologi',
        'logo',
        'deskripsi',
        'link',
        'github_link',
        'is_featured',
    ];

    //membuat realasi dengan tabel user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
