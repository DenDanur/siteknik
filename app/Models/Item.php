<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name','subcategory_id','description','stock','price','image'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategories::class, 'subcategory_id');
    }

    public function category()
    {
        return $this->hasOneThrough(Categories::class, Subcategories::class, 'id', 'id', 'subcategory_id', 'category_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
