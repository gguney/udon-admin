<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City','ref_city_id');
    }

}
