<?php

use Illuminate\Database\Seeder;
use App\Problem;
use App\Schedule;
use App\User;
use App\Course;
use App\Classroom;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $record=new Problem;$record->title="hello1"; $record->message="hello1"; $record->level="0"; $record->save();
        $record=new Problem;$record->title="hello2"; $record->message="hello2"; $record->level="1"; $record->save();
        $record=new Problem;$record->title="hello3"; $record->message="hello3"; $record->level="2"; $record->save();
        $record=new Problem;$record->title="hello4"; $record->message="hello4"; $record->level="3"; $record->save();
        $record=new Problem;$record->title="hello5"; $record->message="hello5"; $record->level="4"; $record->save();

        $r=new Schedule;$r->problem_id=1;$r->start_time='2019-06-21 14:38:31';$r->end_time='2020-06-21 14:38:31';$r->course_id='1';$r->save();
        $r=new Schedule;$r->problem_id=2;$r->start_time='2019-06-21 14:38:31';$r->end_time='2020-06-21 14:38:31';$r->course_id='1';$r->save();
        $r=new Schedule;$r->problem_id=3;$r->start_time='2019-06-21 14:38:31';$r->end_time='2020-06-21 14:38:31';$r->course_id='2';$r->save();

        $r=new Classroom;$r->course_id='1';$r->user_id='1';$r->save();
       $r=new Classroom;$r->course_id='1';$r->user_id='2';$r->save();
        $r=new Classroom;$r->course_id='1';$r->user_id='3';$r->save();
        $r=new Classroom;$r->course_id='2';$r->user_id='4';$r->save();
        $r=new Classroom;$r->course_id='2';$r->user_id='5';$r->save();
        $r=new Classroom;$r->course_id='3';$r->user_id='1';$r->save();
        $r=new Classroom;$r->course_id='4';$r->user_id='1';$r->save();
        $r=new Classroom;$r->course_id='4';$r->user_id='2';$r->save();
        $r=new Classroom;$r->course_id='4';$r->user_id='5';$r->save();
     
        $r=new Course;$r->name="cs100";$r->save();
        $r=new Course;$r->name="cs101";$r->save();
        $r=new Course;$r->name="cs102";$r->save();
        $r=new Course;$r->name="cs103";$r->save();
        $r=new Course;$r->name="cs104";$r->save();


        $x='std1';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();
        $x='std2';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();
        $x='std3';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();
        $x='std4';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();
        $x='std5';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();
        $x='std6';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();
        $x='std7';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();
        $x='std8';
        $r=new User;$r->name=$x;$r->email=$x;$r->password=$x;$r->save();





    }
}
