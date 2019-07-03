@extends('submission.mainlayout')
@section('rightpanel')
@if (auth()->user()->admin)
<h3>Add new testcase</h3><br>
@foreach ($payload as $item)
<?php
$problems[]=[$item['id']=>$item['title']];
$ids[]=['onchange'=>'sclick('.$item['id'].')'];
?>
@endforeach
{!! Form::open(['action'=>'AdminController@store','method'=>'POST']) !!}
{!! Form::hidden("mode", "addnewtestcase") !!}
{!! Form::label("coursename", "Course Name:") !!}
{!! Form::select("problem", $problems,'default',array('onchange' => 'sclick(this)')) !!}
<p id="button_area"></p><br>
<table>
    <thead>
        <th>Input</th>
        <th>Output</th>
    </thead>
    <tr>
        <td>
        {!! Form::textarea('input','',['id'=>'input']) !!}
        </td>
        <td>
            {!! Form::textarea('output','',['id'=>'output']) !!}
        </td>
    </tr>
</table>
 <p id='cmd_button'> </p>
        <a href="/admin" class='btn btn-outline-success btn-xs'> Done </a>
{!! Form::close() !!}
<script>
    var alltestcase;
    var c_problem=0;

function update_testcase(tid){

    $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });

              jQuery.ajax({
                  url: "{{ url('/adminAjax/updateTestcase')}}",
                  method: 'get',
                  data: {
                     problem_id: c_problem,
                     testcase_no: tid,
                     input: $('#input').val(),
                     output: $('#output').val(),
                     mode: 'addtestcase'
                  },
                  success: function(result){
                     alltestcase=result;
                    drawbutton();
                   //alert(JSON.stringify(result));
                   alert('done!');
                  }});
    }



function drawbutton(){
    var i=0
var tmp='';
var myNode = document.getElementById("button_area");
myNode.innerHTML = '';
    for(i=0;i<alltestcase.length;i++){
       // alert(alltestcase[i].input);\
       tmp=tmp+'<button type="button" class="btn btn-success" onclick="show_testcase('+ i +');">'+ i +'</button>';
var cell4 = document.getElementById('button_area');
var element3 = document.createElement("input");
element3.type = "button";
element3.name = "testcase";
element3.value=i;
element3.className="btn btn-outline-info btn-xs p-1";
element3.onclick=function() { show_testcase(this.value); };
cell4.appendChild(element3);
    }
var cell4 = document.getElementById('button_area');
var element3 = document.createElement("input");
element3.type = "button";
element3.name = "testcase";
element3.value='+';
element3.className="btn btn-outline-danger btn-xs ";
element3.onclick=function() { add_testcase(); };
cell4.appendChild(element3);
   // $('#button_area').text(tmp);
}

function add_testcase(){

    $('#input').val("input");
    $('#output').val("output");
    var myNode = document.getElementById("cmd_button");
myNode.innerHTML = '';
var cell4 = document.getElementById('cmd_button');
var element3 = document.createElement("input");
element3.type = "button";
element3.name = "testcase";
element3.value='Save data';
element3.className="btn btn-outline-danger btn-xs ";
element3.onclick=function() { update_testcase(-1); };
cell4.appendChild(element3);
}


function show_testcase(ind){

    $('#input').val(alltestcase[ind].input);
    $('#output').val(alltestcase[ind].output);
    var myNode = document.getElementById("cmd_button");
myNode.innerHTML = '';

var cell4 = document.getElementById('cmd_button');
var element3 = document.createElement("input");
element3.type = "button";
element3.name = "testcase";
element3.value='Update data';
element3.className="btn btn-outline-danger btn-xs ";
element3.onclick=function() { update_testcase(Number(ind)+1); };
cell4.appendChild(element3);
}


    function sclick(pid){
//alert(pid.value);
c_problem=pid.value;

$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
              jQuery.ajax({
                  url: "{{ url('/adminAjax/getTestcaseCount')}}",
                  method: 'get',
                  data: {
                     problem_id: pid.value
                  },
                  success: function(result){
                     alltestcase=result;
                    drawbutton();
                  }});
    }
jQuery(document).ready(function(){
    //https://appdividend.com/2018/02/07/laravel-ajax-tutorial-example/
//https://investmentnovel.com/laravel-dependent-dropdown-tutorial-with-example/



 // request existing testcase



//alert("loaded");
});
</script>
@else
    @include('admin.noadmin')
@endif
@endsection
