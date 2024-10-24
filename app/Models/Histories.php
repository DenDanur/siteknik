<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Histories extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'denda',
        'jumlah',
        'total_harga'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
