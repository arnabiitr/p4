<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

     $this->call(TreatmentsSeeder::class);
        $this->call(MembersTableSeeder::class);

        $this->call(MemberTreatmentSeeder::class);
     $this->call(ClaimsTableSeeder::class);
    }
}
