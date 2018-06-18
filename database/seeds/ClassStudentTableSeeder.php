<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClassStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $classes = App\Models\StudentClass::all();
        DB::table('students')->orderBy('id', 'asc')->chunk(10, function($students) use ($faker, $classes){
            foreach($students as $student) {
                $classesInStudentsYear = $classes->where('year', $student->year);
                $classesPerStudent = rand(2, 7);
                $randomClasses = $classesInStudentsYear->random($classesPerStudent);
                foreach($randomClasses as $class) {
                    DB::table('class_student')->insert([
                        'class_id'      =>  $class->id,
                        'student_id'    =>  $student->id,
                    ]);
                }
                
            }
        });
    }
}
