<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use SoftDeletes;
    public function management()
    {
        return $this->belongsTo('App\Models\Management','ref_management_id');
    }

    public function categories(){
        return $this->hasMany('App\Models\Category');
    }
}
