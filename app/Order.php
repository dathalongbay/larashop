<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //protected $fillable = ['title', 'except', 'body'];

    protected $table = 'orders';



    public function products()
    {
        return $this->hasMany('App\OrderDetail', 'order_id');
    }

}
