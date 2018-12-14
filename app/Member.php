<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{


    public function claim() {
        return $this->hasMany('App\Claim');
    }

    public function treatments() {
        return $this->belongsToMany('App\Treatment')->withTimestamps();
    }

    public static function getForDropdown()
    {
        return self::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();
    }
}
