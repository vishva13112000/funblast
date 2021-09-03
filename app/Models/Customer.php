<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $table='customer';
    protected $PrimaryKey=['id'];
    protected $guarded = ['id'];

     public function branches()
    {
        return $this->belongsTo('\App\Models\Branch', 'branch_id', 'id');
    }
}
