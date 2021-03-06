<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = ['id'];

    public function shopCategory()
    {
        return $this->belongsTo('\App\Models\ShopCategory', 'shopcategory_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo('\App\Models\Country', 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('\App\Models\State', 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('\App\Models\City', 'city_id', 'id');
    }
}
