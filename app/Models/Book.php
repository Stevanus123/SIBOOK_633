<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'jumlah_halaman',
        'harga',
        'stok',
        'kategori_id',
        'diskon_id',
        'deskripsi',
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'kategori_id');
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id', 'diskon_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'buku_id');
    }

    protected $primaryKey = 'buku_id';
}
