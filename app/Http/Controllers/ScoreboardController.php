<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\User;
use App\Course;
use App\Schedule;
use App\Problem;
use App\Submission;
use App\Waitinglist;
use Carbon\Carbon;
use App\Analysis;
use App\Testcase;
use Session;
use Illuminate\Support\Facades\Auth;

class ScoreboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        if( array_key_exists('courses',session())){
            return redirect('/home');
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {$scores=[];
         foreach($this->getTasklist('all') as $course)
        { $subscore=[];$totalscore=0;
         foreach($course['tasks'] as $task)
          {
            $score=Submission::where('schedule_id','=',$task['id'])->where('user_id','=',auth()->user()->id)->orderBy('created_at','desc')->first();
            $subscore[]=[ 'course'=>$task,'problem'=>Problem::find($task['problem_id']),

            'score'=> $score
                        ];
                        $totalscore=$totalscore+(float)$score['score'];
          }
            //  $score=Submission::where('schedule_id',$course->tasks->id)->orderBy('created_at','desc');

        $scores[]=['course'=>$subscore,'score'=>$totalscore,'title'=>$course['title']];


        }
        return view('scoreboard.index')->with('payload',$scores);
    }



public function classroom(){
    if( session('courses')==null){
        return redirect('/home');
    }
    $spreadsheet=[];

    foreach(session('courses') as $course){  //list all course
        $tasks=[];$names=[];$scores=[];
               $tasks=Schedule::where('course_id','=',$course['id'])->get();
        $students=Classroom::where('course_id','=',$course['id'])->get();
        foreach ($students as $key => $student) {
           $name[]=$student->user->username;
           $score=[];
           $sum=0;
           $problems=[];
            foreach ($tasks as $key => $task) {
                $result=Submission::where('user_id','=',$student->user->id)->where('problem_id','=',$task->problem->id)->where('schedule_id','=',$task->id)->orderBy('created_at','desc')->first();
                if($result !=null)
                {
                $score[]=$result->score;
                $sum=$sum+$result->score;
                }else{
                    $score[]=0;
                }
                $problems[]=$task->problem->title;
            }
            $score[]=$sum;
            $scores[]=['user_id'=>$student->user->id,'names'=> $student->user->username,'alias'=> $student->user->alias, 'id'=> $student->user->stdid, 'scores'=>$score,'sum'=>$sum];
        }
        $spreadsheet[]=['courses'=>$course['title'],'scores'=>$scores,'problems'=>$problems];
    }
    return view('scoreboard.classroom')->with('payload',$spreadsheet);
    //return $spreadsheet;
}
/*

public function classroom(){
    if( session('courses')==null){
        return redirect('/home');
    }
    $spreadsheet=[];
    foreach(session('courses') as $course){  //list all course
        $columns=[];
        $tasks=Schedule::where('course_id',$course['id'])->get();   //list all task in course
        $problems=[];
        $allscore=[];
        $sumscore=[];
          foreach($tasks->all() as $task)
          {
            $problems[]=$task->problem->title;
                $Students=Classroom::where('course_id','=',$task->course_id)->get();   // list student in the course
                $names=[];
                foreach($Students as $student_id=>$student){
                 $names[]=$student->user->alias;
                      $score=Submission::where('schedule_id','=',$task->id)->where('user_id','=',$student->user->id)->orderBy('created_at','desc')->first();  //get score for each task of each student
                      if($score !=null)
                      {  if(array_key_exists($student_id,$sumscore)){
                          $sumscore[$student_id]=$sumscore[$student_id]+$score->score;
                        }else{
                            $sumscore[$student_id]=$score->score;
                        }

                        $scores[]=$score->score;
                      }else{
                        if(array_key_exists($student_id,$sumscore)){
                            $sumscore[$student_id]=$sumscore[$student_id]+0;
                          }else{
                              $sumscore[$student_id]=0;
                          }
                        $scores[]=0;
                      }
                }
$allscore[]=$scores;
$scores=[];
          }

       $spreadsheet[]=['course'=>$course['title'],'name'=>$names,'problem'=>$problems,'score'=>$allscore,'sum'=>$sumscore];
    }
      return view('scoreboard.classroom')->with('payload',$spreadsheet);
    }

*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $submission=Submission::find($id);
        if($submission==null){
            return  view('scoreboard.analysis')->with('payload',[]);
        }
        $testcases=Testcase::where('problem_id','=',$submission->problem_id)->get();
        $answers=Analysis::where('submission_id','=',$id)->get();
        $inputsol=[]; $outputsol=[];$answer=[];
        $messages=str_split($submission->message,1);

        foreach($testcases as $testcase){
            $inputsol[]=$testcase->number=$testcase->input;
            $outputsol[]=$testcase->number=$testcase->output;
        }
        foreach($answers as $ans){
            $answer[]=Analysis::find($ans->testcase_id)->number =   $ans->output;
        }

        return  view('scoreboard.analysis')->with('payload',['input'=>$inputsol,'solution'=>$outputsol,'answer'=>$answer,'message'=>$messages,'submission'=>$submission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function getTasklist($duration){
        $tasks=User::find(Auth::user()->id)->classrooms;
        $x='';
        $courses=array();
        foreach ($tasks as $task) {
           array_push($courses,array('id'=>$task->course->id,'title'=>$task->course->name ));
        }
        session(['courses'=>$courses]);
        $now=Carbon::now()->toDateTimeString();
        $tasklist=[];
   foreach (session('courses') as $course) {
       if($duration=='all')
       {$now=Carbon::now()->toDateTimeString();
           $tasks=Schedule::where('course_id','=',$course['id'])->where('end_time','<=',$now)->get();

       }else{
       $tasks=Schedule::where('course_id','=',$course['id'])->where('end_time','>=',$now)->where('start_time','<=',$now)->get();
       }
      $tasklist[]=[
         'title'=>$course['title'],
          'tasks'=>$tasks
      ];
   }
return $tasklist;

    }
}
