<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
/*    public function author() {
        return $this->belongsTo('App\Author');
    }*/

    public function claim() {
        return $this->hasMany('App\Claim');
    }


}
