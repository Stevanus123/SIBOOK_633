<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'carts';

    protected $fillable =
    [
        'user_id',
        'diskon_id',
    ];

    protected $primaryKey = 'cart_id';

    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id', 'diskon_id');
    }
}
