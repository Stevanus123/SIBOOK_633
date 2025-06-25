<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];

    protected $primaryKey = 'kategori_id';

    // Category.php
    public function books()
    {
        return $this->hasMany(Book::class, 'kategori_id');
    }
}
