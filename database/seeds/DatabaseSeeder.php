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
     $this->call(MembersTableSeeder::class);
     $this->call(ClaimsTableSeeder::class);
     $this->call(TreatmentsSeeder::class);
     $this->call(MemberTreatmentSeeder::class);
    }
}
