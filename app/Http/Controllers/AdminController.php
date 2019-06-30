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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
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

    public function addstudent()
    {
        $courses=Course::get();
        return view('admin.addstudent')->with('payload',$courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['mode'=>'required']);
      
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
