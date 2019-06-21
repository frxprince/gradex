<?php

use Illuminate\Database\Seeder;
use App\Problem;
use App\Schedule;

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
    }
}
