<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'except', 'body'];


    public function images()
    {
        return $this->hasMany('App\BannerImage', 'banner_id');
    }


}
