<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function regions()
    {
        return $this->hasMany('App\Models\Region');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','ref_country_id');
    }
}
