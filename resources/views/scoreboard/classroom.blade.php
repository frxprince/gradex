@extends('scoreboard.mainlayout')
@section('rightpanel')
 <h4>Classroom score</h4>
 <br>
 @foreach ($payload as $course)
 <div class="container">
 <center><h4>{{$course['courses']}}</h4></center>
 <table class='table'>
     <tr>
         <thead>
             <th> Name </th>
             @foreach ($course['problems'] as $problem)
         <th>{{$problem}}</th>
             @endforeach   
             <th>Sum</th>     
         </thead>
     </tr>
     @foreach ($course['scores'] as $scores)
         <tr>
             <td>
                      {{$scores['alias']}}
             </td>
            @foreach ($scores['scores'] as $score)
                <td>
                    {{$score}}
                </td>
            @endforeach
         </tr>
     @endforeach


 </table>



  <br>

 </div>
 @endforeach
@endsection
