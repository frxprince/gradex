@extends('submission.mainlayout')

@section('rightpanel')
@if (auth()->user()->admin)
<h2>XXX User Modify XXX </h2>
<br>

@endif
@endsection
