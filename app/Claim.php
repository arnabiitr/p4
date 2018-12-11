<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{

   public function getId() {
        return $this->id;
    }


    public function getDiagnosisCode() {
        return $this->diagnosis_code;
    }


    public function members() {
        return $this->belongsTo('App\Member','member_id');
    }
}
