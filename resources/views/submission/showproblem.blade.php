<?php

use Illuminate\Support\Facades\Auth;
$problem=$payload['problem'];
?>
@if ($problem ==null)
    @include('submission.welcome')
@else


<div class="card">
    <div class="card-header" id="heading{{$problem->id}}">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$problem->id}}" aria-expanded="true" aria-controls="collapse{{$problem->id}}">
        <h2>{{$problem->title}}</h2> <br>
        {{$problem->message}}
        <br>


        Level: {{$problem->level}}
        <br>
        </button>
      </h5>
    </div>

<br>
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
<div class="form-group">

</div>
Source code:{!! Form::file('sourcefile' ) !!}
{!! Form::submit("Submit", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}

    @endif
