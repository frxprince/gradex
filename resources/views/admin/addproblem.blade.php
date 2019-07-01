@extends('submission.mainlayout')

@section('rightpanel')

<script src="{{URL::asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>




@if (auth()->user()->admin)

Add new problem<br>

{!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
{!! Form::hidden("mode", "addnewproblem") !!}
{!! Form::label("title", "Title:") !!}
{!! Form::text("title", "Helloworld",['class'=>'form-control']) !!}
<div>
        {!! Form::label("tolerant", "Grading Tolerant {0.5 mean scoring based on -+0.5 distance  , $ mean scoring based on exact match:") !!}
        {!! Form::text("tolerant", "$",['class'=>'form-control']) !!}
</div>
<div>
        {!! Form::label("level", "Difficulty level {0 = easy , 5 = difficult}:") !!}
        <div class="form-group">
{!! Form::radio('level', '0') !!}0/
{!! Form::radio('level', '1',true) !!}1/
{!! Form::radio('level', '2') !!}2/
{!! Form::radio('level', '3') !!}3/
{!! Form::radio('level', '4') !!}4/
{!! Form::radio('level', '5') !!}5
        </div>
</div>
<div>
{!! Form::label("detail", "Detail:") !!}
{!! Form::textarea('detail', '',['id'=>'editor1','class'=>'form-control']) !!}
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



