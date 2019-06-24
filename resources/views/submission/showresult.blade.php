@extends('submission.mainlayout')
@section('leftpanel')
@include('submission.tasklist')
@endsection
@section('rightpanel')
The queue lenght is {{$payload['queuelenght']}}
<br>
This will show grading result
@endsection
