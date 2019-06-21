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
{{$item->user_id}}={{$item->user->name}} = {{$item->course->name}}
@endforeach
<hr>
{{$data}}
