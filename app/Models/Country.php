<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

}
