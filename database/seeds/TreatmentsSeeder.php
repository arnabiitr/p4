<?php

use Illuminate\Database\Seeder;
use App\Treatment;

class TreatmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $treatments = [
            ['Therapy'],
            ['Inavsive'],
            ['Surgery'],
            ['Alternative medicine'],
            ['Enzyme inhibitor']

        ];

        $count = count($treatments);

        foreach ($treatments as $key => $treatmentData) {


            $treatment = new Treatment();

            $treatment->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $treatment->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $treatment->treatmentname = $treatmentData[0];


            $treatment->save();
            $count--;
        }

    }
}
