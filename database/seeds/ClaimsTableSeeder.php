<?php

use Illuminate\Database\Seeder;
use App\old;

class ClaimsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Array of claim data to add
        $claims = [
            [1, 'ABC', 5000, 300,0],
            [1, 'CD', 5001, 301,0],
            [2, 'EF', 5001, 301,1],
            [2, 'GH', 5001, 301,2],
            [2, 'AD', 5001, 301,3]
        ];
        $count = count($claims);

        # Loop through each claim, adding them to the database
        foreach ($claims as $claimData) {
            $claim = new old();

            $claim->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $claim->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $claim->member_id = $claimData[0];
            $claim->diagnosis_code = $claimData[1];
            $claim->total_amount = $claimData[2];
            $claim->amount_paid = $claimData[3];
            $claim->status = $claimData[4];

            $claim->save();

            $count--;
        }
    }
}
