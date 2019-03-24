<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    //
    public function category()
    {
    	return $this->belongsTo('App\Category','category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand','category_id');
    }

    public function sells()
    {
        return $this->hasMany('App\SellProduct','product_id');
    }
}
