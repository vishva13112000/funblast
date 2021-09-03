<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
     protected $table='ride';
    protected $PrimaryKey=['id'];
    protected $guarded = ['id'];
}
