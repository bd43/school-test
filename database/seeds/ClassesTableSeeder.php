<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Faker\Provider\Book as Book;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('teachers')->orderBy('id', 'asc')->chunk(10, function($teachers) use ($faker){
            foreach($teachers as $teacher) {
                $classesPerTeacher = rand(1,3);
                foreach(range(1, $classesPerTeacher) as $index) {
                    DB::table('classes')->insert([
                        /*'teacher_id'    =>  $teacher->id,*/
                        'name'          =>  ucfirst($faker->words(6, 10)),
                        'year'          =>  $faker->numberBetween(1,3),
                        'created_at'    =>  date('Y-m-d H:i:s'),
                        'updated_at'    =>  date('Y-m-d H:i:s'),
                    ]); 
                }
            }
        });
    }
}
