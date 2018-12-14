<?php

use Illuminate\Database\Seeder;
use App\Treatment;
use App\Member;

class MemberTreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membertreatment = [
            'Arnab1' => ['Therapy', 'Surgery'],
            'Arit' => ['Surgery', 'Alternative medicine', 'Enzyme inhibitor', 'Therapy'],
            'Arnab12' => ['Invasive','Surgery']
        ];

        # Now loop through the above array, creating a new pivot for each book to tag
        foreach ($membertreatment as $membername => $treatmentnames) {
            # First get the book
            $member = Member::where('first_name', 'like', $membername)->first();

            # Now loop through each tag for this book, adding the pivot
            foreach ($treatmentnames as $treatname) {
                $treatment = Treatment::where('treatmentname', 'LIKE', $treatname)->first();

                # Connect this tag to this book
                $member->treatments()->save($treatment);
            }
        }
    }

}
