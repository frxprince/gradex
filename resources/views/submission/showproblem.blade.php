<?php

use Illuminate\Support\Facades\Auth;
$problem=$payload['problem'];
?>
@if ($problem ==null)
    @include('submission.welcome')
@else
<div class="container">

        <h4>{{$problem->title}}</h4> <br> <h5>  Level: {{$problem->level}}</h5>
        {!!$problem->message!!}
        <hr>
    <h2>Submit your code</h2>
<?php
?>
{!! Form::open(['action'=>'SubmissionController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
<div class="form-group">
{!! Form::label('title','Programming language:') !!}
{!! Form::radio('Lang', 'C',auth()->user()->lang=='C')!!} C /
{!! Form::radio('Lang', 'C++',auth()->user()->lang=='C++')!!} C++ /
{!! Form::radio('Lang', 'C#',auth()->user()->lang=='C#')!!} C# /
{!! Form::radio('Lang', 'JAVA',auth()->user()->lang=='JAVA')!!} Java /
{!! Form::radio('Lang', 'PYTHON2',auth()->user()->lang=='PYTHON2')!!} Python2 /
{!! Form::radio('Lang', 'PYTHON3',auth()->user()->lang=='PYTHON3')!!} Python3
{!! Form::hidden('schedule_id', $payload['schedule_id']) !!}
{!! Form::hidden('problem_id', $problem->id) !!}
</div>
<!-- https://github.com/LaravelCollective/docs  !-->

Source code:{!! Form::file('sourcefile' ) !!}
{!! Form::submit("Submit", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}
  
</div>
    @endif
