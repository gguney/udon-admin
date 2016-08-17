<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Management extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;

    public function owner()
    {
        return $this->belongsTo('App\Models\User','ref_owner_id');
    }

    public function menus(){
        return $this->hasMany('App\Models\Menu');
    }
}
