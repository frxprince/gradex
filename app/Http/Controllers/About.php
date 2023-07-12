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


class About extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {//  $user_count=User::count();
    $analysis_count=Analysis::count();
    $latestsubmission=Submission::orderBy('id','desc')->limit(5)->get();
    $queue_count=Waitinglist::count();
    $submission_count=Submission::count();

    $myfile = fopen('/home/ohm/grader_2/grader/lastseen.txt', "r") or die("Unable to open file!");
    $timestamp=fread($myfile,filesize('/home/ohm/grader_2/grader/lastseen.txt'));
    fclose($myfile);
    $lastseen= abs((float)$timestamp-time());
    $compilerinfo= nl2br(shell_exec("python3 --version")).'<br/>'.nl2br(shell_exec("pip3 list"));
    $compilerinfo= $compilerinfo.'<hr>'.nl2br(shell_exec("gcc --version"));
    $compilerinfo= $compilerinfo.'<hr>'.nl2br(shell_exec("g++ --version"));
    $compilerinfo= $compilerinfo.'<hr>'.nl2br(shell_exec("javac --version"));
    $compilerinfo= $compilerinfo.'<hr>'.nl2br(shell_exec("java --version"));
    //return $latestsubmission[1]->user->name;
return view('about.about')->with('payload',['latest'=>$latestsubmission,'analysis'=>$analysis_count,'queue_count'=>$queue_count,'submission'=>$submission_count,'lastseen'=>$lastseen,'compiler'=>$compilerinfo]);
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
