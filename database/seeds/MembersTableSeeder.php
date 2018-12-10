<?php

use Illuminate\Database\Seeder;
use App\Member;
use App\Claim;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = [
            ['Arnab', 'Bhar', '456-677-890', '5 Pembrook Lane','A0890076','2020','1979'],
            ['Arit', 'Bhar', '456-677-890', '6 Pembrook Lane','A0890078','2021','2018']
        ];

        $count = count($members);

        foreach ($members as $key => $memberData) {


            $member = new Member();

            $member->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $member->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $member->first_name = $memberData[0];
            $member->last_name= $memberData[1];
            $member->ssn = $memberData[2];
            $member->address = $memberData[3];
            $member->insurance_id = $memberData[4];
            $member->insurance_expiration_date = $memberData[5];
            $member->dob = $memberData[6];

            $member->save();
            $count--;
        }
    }
}
