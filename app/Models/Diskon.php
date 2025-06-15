<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $table = 'diskon';

    protected $fillable = [
        'nama_diskon',
        'kode',
        'deskripsi',
        'persen',
        'tglMulai',
        'tglSelesai'
    ];

    protected $primaryKey = 'diskon_id';
}
