<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    //
	public function products()
	{
		return $this->hasMany('App\Sell');
	}

}
