<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        App\Models\Student::with('classes')->orderBy('id', 'asc')->chunk(50, function($students) use ($faker) {
            foreach($students as $student) {
                foreach($student->classes as $class) {
                    $numberOfGradesPerClass = rand(1, 3);
                    foreach(range(1, $numberOfGradesPerClass) as $index) {
                        DB::table('grades')->insert([
                            'class_id'      =>  $class->id,
                            'teacher_id'    =>  $class->teachers->first()->id,
                            'student_id'    =>  $student->id,
                            'value'         =>  $faker->randomFloat(2, 4, 10),
                            'created_at'    =>  date('Y-m-d H:i:s'),
                            'updated_at'    =>  date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }
        });        
    }
}
