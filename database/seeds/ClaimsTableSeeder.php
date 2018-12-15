<?php

use Illuminate\Database\Seeder;
use App\Claim;
use App\Member;

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
            ['Arit', 'ABC', 5000, 300,0],
            ['Arit', 'CD', 5001, 301,0],
            ['Arnab', 'EF', 5001, 301,1],
            ['Arnab', 'GH', 5001, 301,2],
            ['Arnab', 'AD', 5001, 301,3]
        ];
        $count = count($claims);

        # Loop through each claim, adding them to the database
        foreach ($claims as $claimData) {
            $claim = new Claim();

            $member = Member::where('first_name', 'like', $claimData[0])->first();

            $claim->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $claim->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $claim->member_id = $member->id;
            $claim->diagnosis_code = $claimData[1];
            $claim->total_amount = $claimData[2];
            $claim->amount_paid = $claimData[3];
            $claim->status = $claimData[4];

            $claim->save();

            $count--;
        }
    }
}
