<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    protected $fillable = ['title', 'except', 'body'];

    protected $table = 'menu_items';



}
