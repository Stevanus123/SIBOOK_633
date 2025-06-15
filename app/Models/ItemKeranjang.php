<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemKeranjang extends Model
{
    protected $table = 'cart_items';

    protected $fillable =
    [
        'cart_id',
        'buku_id',
        'jumlah',
        'harga',
    ];

    protected $primaryKey = 'cartItems_id';

    public function buku()
    {
        return $this->belongsTo(Book::class, 'buku_id', 'buku_id');
    }
}
