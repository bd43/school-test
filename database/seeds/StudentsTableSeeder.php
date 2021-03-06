<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1, 200) as $index) {
	        DB::table('students')->insert([
                'first_name'    =>  $faker->firstName,
                'last_name'     =>  $faker->lastName,
                'year'          =>  $faker->numberBetween(1,3),
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ]);
        }
    }
}
