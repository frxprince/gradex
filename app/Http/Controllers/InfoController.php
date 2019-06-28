<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Classroom;
use App\Course;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $tasks=User::find(Auth::user()->id)->classrooms;
        $x='';
        $courses=array();
        foreach ($tasks as $task) {
           array_push($courses,array('id'=>$task->course->id,'title'=>$task->course->name ));
        }
        return view('info.index')->with('payload',$courses);
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
    {   $this->validate($request,['name'=>'required','email'=>'required','alias'=>'required','stdid'=>'required']);
        print_r($request->input());
        print_r($id);
        $user=User::find($id);
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->stdid=$request->input('stdid');
        $user->alias=$request->input('alias');
      $user->save();
      $tasks=User::find(Auth::user()->id)->classrooms;
      $x='';
      $courses=array();
      foreach ($tasks as $task) {
         array_push($courses,array('id'=>$task->course->id,'title'=>$task->course->name ));
      }

        return redirect('\info')->with('payload',$courses)->withErrors(array('message'=>'Your information has been updated!!'));;
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
