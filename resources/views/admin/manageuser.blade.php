@extends('submission.mainlayout')

@section('rightpanel')
@if (auth()->user()->admin)
<h2>XXX User Manager XXX </h2>
<br>
{{$payload->links()}}
<table class='table'>
    <thead>
        <tr>
            <th>Username</th><th>Name</th><th>Email</th><th>Alias</th><th>Control</th>
        </tr>
    </thead>
    @foreach ($payload as $user)

<tr>
<td>{{$user->username}}</td><td>{{$user->name}}</td><td>{{$user->email}}</td><td>{{$user->alias}}</td>
<td>
<a class='btn btn-success' href="/adminPage/usermodify/{{$user->id}}">Manage </a>
</td>
</tr>
    @endforeach
</table>
{{$payload->links()}}
@endif
@endsection
