<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detail()
    {
        return $this->hasOne(ItemDetail::class);
    }
}
