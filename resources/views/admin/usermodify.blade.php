@extends('submission.mainlayout')

@section('rightpanel')
@if (auth()->user()->admin)
<h2>Change user information</h2>
<br>
{!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
{!! Form::hidden("mode", "modifyuser") !!}
{!! Form::hidden("user_id",$payload['user']->id ) !!}
{!! Form::label('name', "Name") !!}
{!! Form::text('name', $payload['user']->name,['class'=>'form-control']) !!}
{!! Form::label('email', "Email") !!}
{!! Form::text('email', $payload['user']->email,['class'=>'form-control']) !!}
{!! Form::label('alias', "Alias") !!}
{!! Form::text('alias', $payload['user']->alias,['class'=>'form-control']) !!}
{!! Form::label('TA', "TA") !!}
{!! Form::hidden("TA", '0')!!}
{!! Form::checkbox("TA", "1",  $payload['user']->ta) !!}
{!! Form::label('admin', "Admin") !!}
{!! Form::hidden("admin", "0") !!}
{!! Form::checkbox("admin", "1",  $payload['user']->admin) !!}

{!! Form::submit("Save", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}
@endif

<br>
<center><h3>Member of</h3></center>
<table class='table'>
    <thead>
        <tr>
        <th>Class name</th><th>Command</th>
        </tr>
    </thead>

@foreach ($payload['classroom'] as $classroom)
    <tr>
       <td> {{$classroom->course->name}}</td>
       <td><a href='/adminPage/userrmclass/{{$classroom->id}}' class='btn btn-danger'> Remove </a></td>
    </tr>
@endforeach
</table>
Add to classroom:

@foreach ($payload['courses'] as $item)
<?php
   $courses[]=[$item->id => $item->name];
    ?>
@endforeach
<br>
{!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
{!! Form::hidden("mode", "addtoclassroom") !!}
{!! Form::hidden("user_id",$payload['user']->id ) !!}
{!! Form::label('name', "Classroom:") !!}

{!! Form::select('course',$courses) !!}


{!! Form::submit("Add", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}




@endsection
