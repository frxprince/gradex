@extends('submission.mainlayout')
@section('rightpanel')


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

{!! Form::submit("Submit", ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}


@endsection
