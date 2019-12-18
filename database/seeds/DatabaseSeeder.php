<?php

use App\Course;
use App\Handbook;
use App\Student;
use App\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        // $this->call(UsersTableSeeder::class);
//        factory(Course::class, 5)->create();
//        factory(Student::class, 50)->create();
//        factory(Handbook::class, 20)->create();
//        factory(Subject::class, 300)->create();

        $subject_ids = array();
        $subjects = Subject::all('id');
        foreach($subjects as $subject){
            array_push($subject_ids, $subject->id);
        }

        foreach (Handbook::all() as $handbook){
            $i = 0;
            while ($i<20){
                DB::table('has_subjects')->insertOrIgnore([
                    'handbook_id' => $handbook->id,
                    'required' => $faker->boolean,
                    'subject_id' => $faker->randomElement($subject_ids),
                ]);
                $i++;
            }
        }

        foreach (Student::all() as $student){
            $i = 0;
            while ($i<20){
                DB::table('registered_subjects')->insertOrIgnore([
                    'student_id' => $student->id,
                    'subject_id' => $faker->randomElement($subject_ids),
                    'result' => $faker->randomFloat(2, 0, 4)
                ]);
                $i++;
            }
        }
    }
}
