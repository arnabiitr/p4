<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public function members()
    {
        return $this->belongsToMany('App\Member')->withTimestamps();
    }

    public static function getForCheckboxes()
    {
        $treatments = self::orderBy('treatmentname')->get();

        $treatmentsForCheckboxes = [];

        foreach ($treatments as $treatment) {
            $treatmentsForCheckboxes[$treatment['id']] = $treatment->treatmentname;
        }

        return $treatmentsForCheckboxes;
    }
}
