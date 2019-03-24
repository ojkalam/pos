<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellProduct extends Model
{
    //
    public function sell()
	{
		return $this->belongsTo('App\SellProduct');
	}

	public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
