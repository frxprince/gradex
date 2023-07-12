@extends('admin.mainlayout')

@section('rightpanel')
@if (auth()->user()->admin)
<h2>Problem manager </h2>
<br>
<div class="container">
  <div class="col">
      
  

<table class='table'>
    <thead>
        <tr>
            <th>Title</th><th>Level</th><th>Created at</th><th>Contributor</th><th>Control</th>
        </tr>
    </thead>
   @foreach ($payload as $problem)
       


<tr>
<td>{{$problem->title}}</td><td>{{$problem->level}}</td><td>{{$problem->created_at}}</td><td>{{$problem->user->name}}</td>
<td>
<a class='btn btn-success' href="/adminPage/problem_modify/{{$problem->id}}">Edit</a>
<a class='btn btn-danger' href="/adminPage/problem_delete/{{$problem->id}}">Delete</a>
</td>
</tr>
@endforeach  
</table>
</div>
</div>
@endif
@endsection
