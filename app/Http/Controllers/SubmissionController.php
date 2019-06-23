<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use App\User;
use App\Course;
use App\Schedule;
use App\Problem;
use App\Submission;
use Carbon\Carbon;
class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        /* schedule to users
     $now=Carbon::now()->toDateTimeString();
     $tasks=Schedule::where('end_time','>=',$now)->where('start_time','<=',$now)->get();
     $x='';
    foreach($tasks as $task){
        $x=$x.$task->course->name.'<br>';
     //   $x=$x.$task->course->classrooms.'<br>';
       foreach($task->course->classrooms as $student){
            $x=$x.$student->user->name."<br>";
        }

    }*/

     // user to schedule
     $x='';
     $now=Carbon::now()->toDateTimeString();
     $tasklist=[];
foreach (session('courses') as $course) {
    $tasks=Schedule::where('course_id',$course['id'])->where('end_time','>=',$now)->where('start_time','<=',$now)->get();

   $tasklist[]=[
      'title'=>$course['title'],
       'tasks'=>$tasks
   ];
}



return view('submission.index')->with('payload',['data'=>$tasklist,'problem'=>null]);
    }

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
    {  $this->validate($request,['Lang'=>'required','problem_id'=>'required']);
        if($request->hasFile('sourcefile')){

            $submission=new Submission;
            $submission->problem_id=$request->input('problem_id');
            $submission->Lang=$request->input('Lang');
            $submission->user_id=auth()->user()->id;
            $submission->IP=\Request::ip();
            $submission->score=0.0;
            $submission->message="waiting";
            $submission->compiler_message="waiting";
            $submission->fname=$request->file('sourcefile')->getClientOriginalName();
            $submission->code="hello";
            $submission->save();
           // $submission->problem_id=$request->input('problem_id');

            
            //$post->cover_image=$fileNameToStore;
           // $post->user_id=auth()->user()->id;
            //$post->save();


return $request->input('problem_id').$request->input('Lang');
        }else{
           
            return redirect('/submission/'.$request->input('problem_id'))->withErrors(array('message'=>'File not found!!'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { $x='';
        $now=Carbon::now()->toDateTimeString();
        $tasklist=[];
   foreach (session('courses') as $course) {
       $tasks=Schedule::where('course_id',$course['id'])->where('end_time','>=',$now)->where('start_time','<=',$now)->get();
   
      $tasklist[]=[
         'title'=>$course['title'],
          'tasks'=>$tasks
      ];
   }
   $problem=Problem::find($id);
   return view('submission.index')->with('payload',['data'=>$tasklist,'problem'=>$problem]);
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
}
