<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ingredient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function foods()
    {
        return $this->belongsToMany('App\Models\Food', 'foods-ingredients');
    }
}
