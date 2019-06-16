<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloode extends Model
{
    
    protected $table='bloodes';
    public $timestamps = true;
  	
  	protected $fillable = [
        'name', 'email', 'phone' ,'blood_type','country','description'
    ];


}
