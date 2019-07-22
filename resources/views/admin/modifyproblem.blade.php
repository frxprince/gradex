@extends('submission.mainlayout')

@section('rightpanel')

<script src="{{URL::asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<?php $problem=$payload;

?>



@if (auth()->user()->admin)

Add new problem<br>

{!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
{!! Form::hidden("mode", "modifyproblem") !!}
{!! Form::hidden("problem_id", $problem->id) !!}
{!! Form::label("title", "Title:") !!}
{!! Form::text("title", $problem->title,['class'=>'form-control']) !!}
<div>
        {!! Form::label("tolerant", "Grading Tolerant {0.5 mean scoring based on -+0.5 distance  , $ mean scoring based on exact match:") !!}
        {!! Form::text("tolerant", $problem->tolerant,['class'=>'form-control']) !!}
</div>
<div>
        {!! Form::label("level", "Difficulty level {0 = easy , 5 = difficult}:") !!}
        <div class="form-group">
            @if ($problem->level==0)
            {!! Form::radio('level', '0',true) !!}0/        
            @else
            {!! Form::radio('level', '0',false) !!}0/   
            @endif
            @if ($problem->level==1)
            {!! Form::radio('level', '1',true) !!}1/        
            @else
            {!! Form::radio('level', '1',false) !!}1/   
            @endif
            @if ($problem->level==2)
            {!! Form::radio('level', '2',true) !!}2/        
            @else
            {!! Form::radio('level', '2',false) !!}2/   
            @endif
            @if ($problem->level==3)
            {!! Form::radio('level', '3',true) !!}3/        
            @else
            {!! Form::radio('level', '3',false) !!}3/   
            @endif
            @if ($problem->level==4)
            {!! Form::radio('level', '4',true) !!}4/        
            @else
            {!! Form::radio('level', '4',false) !!}4/   
            @endif
            @if ($problem->level==5)
            {!! Form::radio('level', '5',true) !!}5/        
            @else
            {!! Form::radio('level', '5',false) !!}5/   
            @endif

        </div>
</div>
<div>
{!! Form::label("detail", "Detail:") !!}
{!! Form::textarea('detail', $problem->message,['id'=>'editor1','class'=>'form-control']) !!}
<script>
        CKEDITOR.replace('editor1');
    </script>
</div>
{!! Form::submit("Submit", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}


@else
    @include('admin.noadmin')
@endif
@endsection



