@extends('submission.mainlayout')
@section('rightpanel')
@if (auth()->user()->admin)
@foreach ($payload as $item)
<?php   $courses[]=[$item->id => $item->name]; ?>
@endforeach


{!! Form::label("course", "Course Name:") !!}
        {!! Form::select('course',$courses,'default', array('onchange' => 'sclick(this)')) !!}
{!! Form::close() !!}
<div class="row">
    <div class="col-md-5">
col1
    </div>
    <div class="col-md-5">
col2
    </div>
</div>


@else
    @include('admin.noadmin')
@endif
@endsection
<script>
function sclick(pid){
alert(pid.value);

}
</script>
