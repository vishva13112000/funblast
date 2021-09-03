<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
     protected $table='amount';
    protected $PrimaryKey=['id'];
    protected $guarded = ['id'];

    public function customer(){
     return $this->belongsTo('App\Models\Customer','customer_id','id');

    }
}

