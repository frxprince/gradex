@extends('submission.mainlayout')
@section('rightpanel')
@if (auth()->user()->admin)


<div class="row mt-2">
<a href="/adminPage/addnewclassroom" class="btn btn-danger " type="button">Make new classroom</a><p>&nbsp;</p>
<a href="/adminPage/addstudent" class="btn btn-danger " type="button">Add new student to existing classroom</a>
</div>

<div class="row mt-2">

    <a href="/adminPage/addnewproblem" class="btn btn-danger" type="button">Add new problem</a><p>&nbsp;</p>
    <a href="/adminPage/addnewtestcase" class="btn btn-danger" type="button">Add new testcase to existing problem</a>
</div>

<div class="row mt-2">
    <a href="" class="btn btn-danger" type="button">Asign problem to existing classroom</a>
</div>
@else
    @include('admin.noadmin')
@endif
@endsection
