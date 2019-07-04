@extends('submission.mainlayout')

@section('rightpanel')
@if (auth()->user()->admin)
<h2>Modify classroom schedule </h2>
<div class="row">
    <div class="col-md-5">
        {!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
        {!! Form::hidden("mode", "manageschedule") !!}
    <div>
        {!! Form::label("start_time", "Begin at:") !!}
        {!! Form::datetime('start_time', $schedule->start_time,['class'=>"form-control"]) !!}

        {!! Form::label("end_time", "Finish at:") !!}
        {!! Form::datetime('end_time', $schedule->end_time,['class'=>"form-control"]) !!}

        {!! Form::label("score", "Score:") !!}
        {!! Form::number("score", $schedule->score, ['class'=>"form-control"]) !!}
        {!! Form::hidden("problem_id", $schedule->problem_id,['id'=>'form_problem_id']) !!}
        {!! Form::hidden("schedule_id", $schedule->id) !!}
        {!! Form::label("problem", "Problem:") !!}
        {!! Form::text("problem", $problem->title, ['class'=>"form-control ",'id'=>'form_problem_title'   ]) !!}
    </div>
    <br>
        {!! Form::submit("Submit", ['class'=>'btn btn-lg btn-danger btn-block']) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-md-2">
        <br><br>
        <button class='btn btn-lg btn-outline-success btn-block' id='button1' onclick='addproblem();'> Add<br><-- </button>
    </div>
    <div class="col-md-5">
        <div class="form-group">
        @foreach ($problems as $problem)
        {!! Form::radio('problem_list', $problem->id, false, ['class'=>'form-group','tag'=> $problem->title ]) !!}{{$problem->title}}<br>
        @endforeach
    </div>
    </div>
</div>

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
