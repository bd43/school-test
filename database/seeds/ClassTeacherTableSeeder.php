<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClassTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        //$classes = App\Models\StudentClass::all();
        // DB::table('teachers')->orderBy('id', 'asc')->chunk(10, function($teachers) use ($faker){
        //     foreach($teachers as $teacher) {
        //         $classes = App\Models\StudentClass::has('teachers', '<=', 5)->get();
        //         $classesPerTeacher = rand(2, 5);
        //         $randomClasses = $classes->random($classesPerTeacher);
        //         foreach($randomClasses as $class) {
        //             DB::table('class_teacher')->insert([
        //                 'class_id'      =>  $class->id,
        //                 'teacher_id'    =>  $teacher->id,
        //             ]);
        //         }
        //     }
        // });

        DB::table('classes')->orderBy('id', 'asc')->chunk(10, function($classes) use ($faker){
            foreach($classes as $cls) {
                $teacherID = App\Models\Teacher::orderBy('id', 'desc')->first()->id;
                DB::table('class_teacher')->insert([
                    'class_id'      =>  $cls->id,
                    'teacher_id'    =>  rand(1, $teacherID),
                ]);
            }
        });
    }
}
