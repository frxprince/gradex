hello world <br>

@foreach ($data as $item)
    <p>
        {{$item}}
@endforeach
<hr>
{{$data}}
<hr>
@foreach ($data as $item)
    <p>
Subject :{{$item->course->name}}  Problem Title: {{$item->problem->title}}
<br>
@foreach ($item->course->classrooms as $student)
    <p>{{$student->user_id}} 
@endforeach
@endforeach
<hr>
{{$data}}
