@extends('submission.mainlayout')
@section('rightpanel')
 <h2>Classroom score</h2>   
 @foreach ($payload as $course)
 {{$course['course']}}
  <br>
 <table class="table">
<thead>
    <tr>
            <th>Name</th>
    @foreach ($course['problem'] as $problem)
        <th>{{$problem}}</th>
    @endforeach
    </tr>    
</thead> 
@foreach ($course['name'] as $std_id=>$name)
<tr>
        <th>{{$name}}</th>
        @foreach ($course['problem'] as $key=>$score)
        <th>{{$course['score'][$std_id]}}</th>
        @endforeach
</tr>
   
@endforeach
</table>    
 @endforeach
@endsection