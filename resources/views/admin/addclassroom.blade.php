@extends('submission.mainlayout')
@section('rightpanel')
@if (auth()->user()->admin)
Add new classroom<br>
{!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
{!! Form::hidden("mode", "addnewclassroom") !!}
{!! Form::label("coursename", "Course Name:") !!}
{!! Form::text("coursename", "CSXX_XX") !!}
{!! Form::submit("Submit", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}
@else
    @include('admin.noadmin')
@endif
@endsection
