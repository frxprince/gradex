@extends('scoreboard.mainlayout')
@section('rightpanel')
 <h4>Classroom score</h4>
 <br>
 @foreach ($payload as $course)
 <div class="container">
 <center><h4>{{$course['course']}}</h4></center>
  <br>
 <table class="table">
<thead>
    <tr>
            <th>Name</th>
    @foreach ($course['problem'] as $problem)
        <th>{{$problem}}</th>
    @endforeach
    <th class="text-primary">Sum</th>
    </tr>
</thead>
@foreach ($course['name'] as $std_id=>$name)
<tr>
        <th>{{$name}}</th>
        @foreach ($course['problem'] as $key=>$score)
        <th>{{$course['score'][$key][$std_id]}}</th>
        @endforeach
    @if (count($course['problem'])>0)
    <th class="text-primary">{{$course['sum'][$std_id]}}</th>
    @else
    <th class="text-primary">0</th>
    @endif
</tr>
@endforeach
</table>     
</div>
 @endforeach
@endsection
