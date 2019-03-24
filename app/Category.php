<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     * Parent model of relation in which dynamic properties are looking for 
     * @var array
     */
    protected $fillable = [
      'category_name'  
    ];


    //
    public function products ()
    {
    	 return $this->hasMany('App\Product');
    }


}
