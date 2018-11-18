<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    protected $fillable = ['title', 'except', 'body'];

    protected $table = 'banner_images';

    public function banner()
    {
        return $this->belongsTo('App\Banner', 'banner_id');
    }

}

