<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'except', 'body'];

    public function photos()
    {
        return $this->hasMany('App\ProductPhoto', 'product_id');
    }

}
