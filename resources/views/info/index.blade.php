@extends('submission.mainlayout')
@section('rightpanel')

<ul class="list-group">
   
    <ul class="list-group">
        <li class="list-group-item active">Your classroom</li>
    
    @foreach ($payload as $item)
       <li class="list-group-item"> {{$item['title']}}</li>
    @endforeach
    </ul>
   <p></p>
    <h3 class="text-center">Your information</h3>
<br>
{!! Form::open(['action'=>['InfoController@update',Auth::user()->id],'method'=>'PATCH']) !!}
<div class="form-group">

{!! Form::label('name','Name'); !!}
 {!! Form::text('name', Auth::user()->name, ['class'=>'form-control']) !!}

{!! Form::label('stdid','Student ID') !!}
{!! Form::number('stdid', Auth::user()->stdid, ['class'=>'form-control']) !!}


{!! Form::label('email','Email') !!}

{!! Form::email('email', Auth::user()->email, ['class'=>'form-control']) !!}


{!! Form::label('alias','Alias') !!}
{!! Form::text('alias', Auth::user()->alias, ['class'=>'form-control']) !!}
<div class="text-center">
{!! Form::submit("Save", ['class'=>'btn btn-danger']) !!}
</div>
{!! Form::close() !!}

<hr>

<br>

@endsection
