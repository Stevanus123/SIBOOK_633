<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReqTopUp extends Model
{
    protected $table = 'req_topup';

    protected $fillable =
    [
        'user_id',
        'jumlah',
        'status',
        'alasan',
        'pesan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
