<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $fillable = ['title', 'except', 'body'];

    protected $table = 'product_photos';

    public function product()
    {
        return $this->belongsToMany('App\ProductPhoto', 'product_id');
    }



}
