<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    public function shop()
    {
        return $this->belongsTo('\App\Models\Shop', 'shop_id', 'id');
    }
}
