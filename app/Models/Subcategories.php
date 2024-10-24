<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    protected $fillable = ['name','category_id'];


    public function category()
{
    return $this->belongsTo(Categories::class, 'category_id');
}
}
