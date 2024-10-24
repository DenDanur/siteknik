<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    protected $fillable = ['item_id','description','stock','price','image'];

}
