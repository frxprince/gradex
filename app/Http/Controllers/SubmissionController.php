<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Classroom;
use App\User;
use App\Course;
use App\Schedule;
use App\Problem;
use App\Submission;
use App\Waitinglist;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }


    public function getTasklist(){
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
       $tasks=Schedule::where('course_id',$course['id'])->where('end_time','>=',$now)->where('start_time','<=',$now)->get();

      $tasklist[]=[
         'title'=>$course['title'],
          'tasks'=>$tasks
      ];
   }
return $tasklist;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

return view('submission.index')->with('payload',['data'=>$this->getTasklist(),'problem'=>null]);
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


// add date check $request->input('schedule_id');
$now=Carbon::now()->toDateTimeString();
        $passdue=Schedule::where('id','=',$request->input('schedule_id'))->where('end_time','<=',$now)->count();
        if($passdue>0){
            return redirect('/submission/'.$request->input('problem_id').'/'.$request->input('schedule_id'))->withErrors(array('message'=>'The submission of this task is no longer allowed! +_+'));
        }

        if($request->hasFile('sourcefile')){

            $submission=new Submission;
            $submission->problem_id=$request->input('problem_id');
            $submission->schedule_id=$request->input('schedule_id');
            $submission->Lang=$request->input('Lang');
            $submission->user_id=auth()->user()->id;
            $submission->IP=\Request::ip();
            $submission->score=0.0;
            $submission->message="waiting";
            $submission->compiler_message="waiting";
            $submission->fname=$request->file('sourcefile')->getClientOriginalName();
            $submission->code= mb_convert_encoding (File::get($request->file('sourcefile')->getRealPath()),'US-ASCII','UTF-8');
            $submission->save();

            $waitinglist=new Waitinglist;
            $waitinglist->submission_id= $submission->id;

            $user=User::find(auth()->user()->id);
            $user->lang=$request->input('Lang');
            $user->save();
            $waitinglist->save();


return  redirect('/submission/'.$submission->id.'/edit')->with('success','Scccessfully uploaded!');
        }else{

            return redirect('/submission/'.$request->input('problem_id').'/'.$request->input('schedule_id'))->withErrors(array('message'=>'File not found!!'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function showproblem($problem_id,$schedule_id){
        $problem=Problem::find($problem_id);
   return view('submission.index')->with('payload',['data'=>$this->getTasklist(),'problem'=>$problem,'schedule_id'=>$schedule_id]);
     }
    public function show($id)
    {

   $problem=Problem::find($id);
   return view('submission.index')->with('payload',['data'=>$this->getTasklist(),'problem'=>$problem]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { $queue=Waitinglist::count();


   return view('submission.showresult')->with('payload',['data'=>$this->getTasklist(),'result'=>'','queuelenght'=>$queue]);
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
       return "hello";
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
