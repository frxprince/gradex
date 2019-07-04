@extends('submission.mainlayout')

@section('rightpanel')
@if (auth()->user()->admin)
<h2>Modify classroom schedule </h2>

        {!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
        {!! Form::hidden("mode", "addschedule") !!}
    <div>
        {!! Form::label("start_time", "Begin at:") !!}
        {!! Form::datetime('start_time', $now,['class'=>"form-control"]) !!}

        {!! Form::label("end_time", "Finish at:") !!}
        {!! Form::datetime('end_time', $now,['class'=>"form-control"]) !!}

        {!! Form::label("score", "Score:") !!}
        {!! Form::number("score", '100.0', ['class'=>"form-control"]) !!}

        {!! Form::hidden("course_id", $course_id) !!}
        {!! Form::label("problem", "Problem:") !!}
    </div>
    <br>
    <div class="form-group">
            @foreach ($problems as $problem)
            {!! Form::checkbox('problem_list[]', $problem->id, false, ['class'=>'form-group','tag'=> $problem->title ]) !!} : {{$problem->title}}<br>

            @endforeach
    </div>
        {!! Form::submit("Submit", ['class'=>'btn btn-lg btn-danger btn-block']) !!}
        {!! Form::close() !!}




@endif
@endsection

<script>
var problems = '{{ env('problems') }}';

function addproblem(){
$('#form_problem_title').val(document.querySelector('input[name=problem_list]:checked').getAttribute('tag'));
$('#form_problem_id').val(document.querySelector('input[name=problem_list]:checked').value);
 //   alert();
//problems[document.querySelector('input[name=problem_list]:checked').value
}

</script>
