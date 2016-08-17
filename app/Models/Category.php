<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use SoftDeletes;
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu','ref_menu_id');
    }

    public function foods(){
        return $this->hasMany('App\Models\Food');
    }
}
