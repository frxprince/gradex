@extends('submission.mainlayout')
@section('rightpanel')
@if (auth()->user()->admin)
Add new testcase<br>
@foreach ($payload as $item)
<?php 
$problems[]=[$item['id']=>$item['title']];

?>    
@endforeach
{!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
{!! Form::hidden("mode", "addnewtestcase") !!}
{!! Form::label("coursename", "Course Name:") !!}
{!! Form::select("problem", $problems) !!}
<p id="button_area"></p><br>

<table>
    <thead>
        <th>Input</th>
        <th>Output</th>
    </thead>
    <tr>
        <td>
        {!! Form::textarea('input','') !!}
        </td>
        <td>
            {!! Form::textarea('output','') !!}
        </td>
    </tr>
</table>



{!! Form::submit("Submit", ['class'=>'btn btn-lg btn-success btn-block']) !!}
{!! Form::close() !!}

<script>
jQuery(document).ready(function(){
    //https://appdividend.com/2018/02/07/laravel-ajax-tutorial-example/
//https://investmentnovel.com/laravel-dependent-dropdown-tutorial-with-example/



 // request existing testcase

 $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
              jQuery.ajax({
                  url: "{{ url('/adminAjax/getTestcaseCount')}}",
                  method: 'get',
                  data: {
                     problem_id: '1'
                  },
                  success: function(result){
                     alert(result.success);                  
                    
                  }});              

//alert("loaded");
});
</script>
@else
    @include('admin.noadmin')
@endif
@endsection