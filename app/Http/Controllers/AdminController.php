<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
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
class AdminController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');


    }
    public function index()
    {
        return view('admin.index');
    }

    public function saveuserinfo(Request $request){


        return $request;
    }


    public function userrmclass($id){
        $classroom=Classroom::find($id);
        $user_id=$classroom->user_id;
        $classroom->delete();
        return redirect('/adminPage/usermodify/'.$user_id)->withErrors(array('message'=>'The user information has been updated!!'));
    }


    public function usermodify($id){
        $user=User::find($id);
        $classroom=Classroom::where('user_id','=',$id)->get();
        $course=Course::orderBy('name')->get();
        return view('admin.usermodify')->with('payload',['user'=>$user,'classroom'=>$classroom,'courses'=>$course]);
    }

    public function usermanager(){
        $users=User::orderBy('username')->paginate(50);
        return view('admin.manageuser')->with('payload',$users);
    }


    public function schedule_add( $id){
        $problems=Problem::get();
        $now=Carbon::now()->toDateTimeString();
        return view('admin.addtasktoschedule')->with(['problems'=>$problems,'course_id'=>$id,'now'=>$now]);
    }

    public function schedule_manage( $id){
        $schedule=Schedule::where('id','=',$id)->first();
        $problems=Problem::get();
        $problem=Problem::where('id','=',$schedule['problem_id'])->first();
        return view('admin.manageschedule')->with(['schedule'=>$schedule,'problems'=>$problems,'problem'=>$problem]);//view('admin.manageschedule');
    }



public function schedule_get_from_classroom(Request $request){
    $schedule=Schedule::where('course_id','=',$request->input('course_id'))->get();
    if($schedule->count()==0){
        return response()->json('null');
    }
    foreach ($schedule as $key => $item) {
        $problem=Problem::where('id','=',$item->problem_id)->first();
        $tasks[]=['schedule'=>$item,'problem'=>$problem->title];
    }

return response()->json($tasks);

}

    public function addschedule()
    {
        $courses=Course::get();
        return view('admin.addschedule')->with('payload',$courses);
    }



    public function testcase_set_add(Request $request)
    {
        if($request->input('testcase_no')!='-1'){
//update
            $testcase=Testcase::where('problem_id','=',$request->input('problem_id'))->where('number','=',$request->input('testcase_no'))->first();
            $testcase->input=$request->input('input');
            $testcase->output=$request->input('output');
            $testcase->save();
         //   $testcase->save();
        }else{
//add new
            $testcase=Testcase::where('problem_id','=',$request->input('problem_id'))->count();
            $newtestcase=new Testcase;
            $newtestcase->problem_id=$request->input('problem_id');
            $newtestcase->input=$request->input('input');
            $newtestcase->output=$request->input('output');
            $newtestcase->number=$testcase+1;
            $newtestcase->save();
        }
          //  return response()->json(Testcase::where('problem_id','=',$request->input('problem_id'))->get());

          return response()->json(Testcase::where('problem_id','=',$request->input('problem_id'))->get());
    }


    public function testcase_get_count(Request $request)
    {
       return response()->json(Testcase::where('problem_id','=',$request->input('problem_id'))->get());
       //return response()->json(['success'=>'Data is successfully added']);
    }


    public function create()
    {
        //
    }

    public function addstudent()
    {
        $courses=Course::get();
        return view('admin.addstudent')->with('payload',$courses);
    }

    public function addtestcase()
    {
        $problems=Problem::get();
        return view('admin.addnewtestcase')->with('payload',$problems);
    }




    public function store(Request $request)
    {
        $this->validate($request,['mode'=>'required']);


        if($request->input('mode')=='addtoclassroom'){
            $classroom=Classroom::where('user_id','=',$request->input('user_id'))->where('course_id','=',$request->input('course'))->count();
            if($classroom>0)return redirect('/adminPage/usermodify/'.$request->input('user_id'))->withErrors(array('message'=>'User aready a member of this classroom!'));
            
            $classroom=new Classroom;
            $classroom->user_id=$request->input("user_id");
            $classroom->course_id=$request->input('course');
            $classroom->save();
            return redirect('/adminPage/usermodify/'.$request->input('user_id'))->withErrors(array('message'=>'The user information has been updated!!'));
        }

        if($request->input('mode')=='modifyuser'){
        $user=User::find($request->input('user_id'));
        $user->name=$request->input('name');
        $user->alias=$request->input('alias');
        $user->email=$request->input('email');
        $user->ta=$request->input('TA');
        $user->admin=$request->input('admin');
        $user->save();
        return redirect('/adminPage/usermodify/'.$request->input('user_id'))->withErrors(array('message'=>'The user information has been updated!!'));
        }

        if($request->input('mode')=='addschedule'){
            foreach ($request->input('problem_list') as $key => $item) {
                $schedule=new Schedule;
                $schedule->start_time=$request->input('start_time');
                $schedule->end_time=$request->input('end_time');
                $schedule->score=$request->input('score');
                $schedule->course_id=$request->input('course_id');
                $schedule->problem_id=$item;
                $schedule->save();
            }

return redirect('/adminPage/addnewschedule')->withErrors(array('message'=>'The '.count($request->input('problem_list')).' tasks has been added!!'));
        }


        if($request->input('mode')=='manageschedule'){
            $schedule=Schedule::find($request->input('schedule_id'));
            $schedule->start_time=$request->input('start_time');
            $schedule->end_time=$request->input('end_time');
            $schedule->score=$request->input('score');
            $schedule->problem_id=$request->input('problem_id');
            $schedule->save();
            return redirect('/adminPage/addnewschedule')->withErrors(array('message'=>'The schedule has been updated!!'));
        }

      if($request->input('mode')=='addnewproblem')
      {
          $p=new Problem;
          $p->title=$request->input('title');
          $p->message=$request->input('detail');
          $p->level=$request->input('level');
          $p->tolerant=$request->input('tolerant');
          $p->save();
          return view('admin.index')->withErrors(array('message'=>'The new problem has been added!!'));
      }
        if($request->input('mode')=='addnewstudent')
        { Excel::import(new UsersImport, request()->file('students'));
            $users = Excel::toArray(new UsersImport, request()->file('students'));
            foreach($users[0] as $student){
                echo $student[0].' ';
                echo $student[2].'<br>';
                $user=User::where('username','=',$student[0])->first();
                $classroom=new Classroom;
                $classroom->course_id=$request->input('course');
                $classroom->user_id=$user->id;
                $classroom->save();
            }
            return view('admin.index')->withErrors(array('message'=>'The new students as been added to classroom!!'));

        }



        if($request->input('mode')=='addnewclassroom')
        {

        $course=new Course;
        $course->name=$request->input('coursename');
        $course->save();
        return view('admin.index')->withErrors(array('message'=>'The new classroom '.$request->input('coursename').' is successfully added!'));
        }
        return "This is an error";
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
