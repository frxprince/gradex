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
        <table class="table table-bordered">
            <tr>
                <thead>
                    <th>ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Tasks</th>
                </thead>
            </tr>
        </table>
<p id="leftcol"></p>
    </div>
    <div class="col-md-5">
<p id="rightcol"></p>
    </div>
</div>


@else
    @include('admin.noadmin')
@endif
@endsection
<script>
    var allschedule;

function drawschedule(){
    allschedule.forEach(element => {
// change to add element
     $('#leftcol').text('<tr>');
            $('#leftcol').text( $('#leftcol').val()+ '<th>'+element.id+'</th>');
     $('#leftcol').text($('#leftcol').val()+'</tr>');
      alert(JSON.stringify(element));
    });

}

function sclick(pid){
    $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });

              jQuery.ajax({
                  url: "{{ url('/adminAjax/schedule_get_from_classroom')}}",
                  method: 'get',
                  data: {
                     course_id: pid.value
                  },
                  success: function(result){
               //      alltestcase=result;
               //     drawbutton();
               allschedule=result;
              //     alert(JSON.stringify(result));
               //    alert('done!');
               drawschedule();
                  }});

}
</script>
