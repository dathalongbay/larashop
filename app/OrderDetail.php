<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //protected $fillable = ['title', 'except', 'body'];

    protected $table = 'orders_details';

    /*public function photos()
    {
        return $this->hasMany('App\ProductPhoto', 'product_id');
    }*/

}
