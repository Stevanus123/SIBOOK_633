<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerbitBuku extends Model
{
    protected $table = 'usul_terbit';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'sinopsis',
        'file_naskah',
        'sampul',
        'status',
        'catatan'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
