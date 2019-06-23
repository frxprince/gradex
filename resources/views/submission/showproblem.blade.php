<?php

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
        </button>
      </h5>
    </div>

<br>
    <h2>Submit your code</h2>

{!! Form::open(['action'=>'SubmissionController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
<div class="form-group">
{!! Form::label('title','Programming language:') !!}
{!! Form::radio('Lang', 'C')!!} C /
{!! Form::radio('Lang', 'CPP')!!} C++ /
 {!! Form::radio('Lang', 'Java')!!} Java /
  {!! Form::radio('Lang', 'Python3',true)!!} Python3

{!! Form::hidden('Problem_id', $problem->id) !!}

</div>
<!-- https://github.com/LaravelCollective/docs  !-->
<div class="form-group">
   
</div>
{!! Form::submit("Submit", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}

    @endif