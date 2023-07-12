@extends('submission.mainlayout')
@section('rightpanel')
Add new student<br>
@if (auth()->user()->admin)
@foreach ($payload as $item)
<?php   $courses[]=[$item->id => $item->name]; ?>
@endforeach
{!! Form::open(['action'=>'AdminController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
{!! Form::hidden("mode", "addnewstudent") !!}
{!! Form::label("course", "Course Name:") !!}
        {!! Form::select('course',$courses) !!}

{!! Form::label("students", "Excel file:") !!}
{!! Form::file('students' ) !!}
{!! Form::submit("Submit", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}
@else
    @include('admin.noadmin')
@endif
<hr>
The Excel file must contains only one worksheet and compiled with this format
student id,username, name , email , alias, password
@endsection


