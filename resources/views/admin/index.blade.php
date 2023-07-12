@extends('submission.mainlayout')
@section('rightpanel')
@if (auth()->user()->admin)


<div class="row mt-2">
<a href="/adminPage/addnewclassroom" class="btn btn-danger " type="button">Make new classroom</a><p>&nbsp;</p>
<a href="/adminPage/addstudent" class="btn btn-danger " type="button">Add new student to existing classroom</a><p>&nbsp;</p>
<a href="/adminPage/usermanager" class="btn btn-danger " type="button">User manager</a>
</div>

<div class="row mt-2">

    <a href="/adminPage/addnewproblem" class="btn btn-danger" type="button">Add new problem</a><p>&nbsp;</p>
    <a href="/adminPage/manageproblem" class="btn btn-danger" type="button">Manage Problem</a><p>&nbsp;</p>
    <a href="/adminPage/addnewtestcase" class="btn btn-danger" type="button">Add new testcase to existing problem</a>
</div>

<div class="row mt-2">
    <a href="/adminPage/addnewschedule" class="btn btn-danger" type="button">Schedule manager</a>
</div>
@else
    @include('admin.noadmin')
@endif
@endsection
