@extends('admin.mainlayout')
@section('rightpanel')
@if (auth()->user()->admin)
@foreach ($payload as $item)
<?php   $courses[]=[$item->id => $item->name]; ?>
@endforeach


{!! Form::label("course", "Course Name:") !!}
        {!! Form::select('course',$courses,'default', array('onchange' => 'sclick(this)')) !!}
{!! Form::close() !!}
<div class="row">
    <div class="col-md-11">
        <table class="table table-bordered" id='leftcol'>
            <tr>
                <thead>
                    <th>ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Tasks</th>
                    <th>Score</th>
                </thead>

        </table>

    </div>
    <div class="col-md-1">
<p id="rightcol"></p>
    </div>
</div>

<button class='btn btn-lg btn-outline-success ' disabled id='button1' onclick='addproblem();'> Add new task</button>
@else
    @include('admin.noadmin')
@endif
@endsection
<script>
    var allschedule;
    var allproblem;
    var classid;

function addproblem(){
    window.location.replace("/adminPage/add_new_task_to_schedule/"+classid);
}


function drawschedule(){
    var myNode = document.getElementById("leftcol");
myNode.innerHTML = '';
if(allschedule=='')return;
    allschedule.forEach(element => {
// change to add element
//alert(JSON.stringify(element));

var cell4 = document.getElementById('leftcol');
var tablerow = document.createElement("TR");
var tablecol = document.createElement("TH");
/*var t = document.createTextNode(element.schedule.id);
tablecol.appendChild(t);
tablerow.appendChild(tablecol);
cell4.appendChild(tablerow);
*/
var element3 = document.createElement("input");
element3.type = "button";
element3.name = "manage";
element3.value='Manage';
element3.className="btn btn-outline-info btn-xs p-1";
element3.onclick=function() {window.location.href='/adminAjax/schedule_manage/'+element.schedule.id;};
tablecol.appendChild(element3);
tablerow.appendChild(tablecol);
cell4.appendChild(tablerow);




var tablecol = document.createElement("TH");
var t = document.createTextNode(element.schedule.start_time);
tablecol.appendChild(t);
tablerow.appendChild(tablecol);
cell4.appendChild(tablerow);

var tablecol = document.createElement("TH");
var t = document.createTextNode(element.schedule.end_time);
tablecol.appendChild(t);
tablerow.appendChild(tablecol);
cell4.appendChild(tablerow);

var tablecol = document.createElement("TH");
var t = document.createTextNode(element.problem);
tablecol.appendChild(t);
tablerow.appendChild(tablecol);
cell4.appendChild(tablerow);

var tablecol = document.createElement("TH");
var t = document.createTextNode(element.schedule.score);
tablecol.appendChild(t);
tablerow.appendChild(tablecol);
cell4.appendChild(tablerow);
  //   alert(JSON.stringify(element));
    });

}

function sclick(pid){
    $('#button1').removeAttr('disabled');
    classid=pid.value;
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
                     //alltestcase=result.;
               //     drawbutton();
               if(result!='null')
               {
               allschedule=result;
               }else{
                   allschedule="";
               }
           //       alert(JSON.stringify(result));
               //    alert('done!');
               drawschedule();

                  }});

}
</script>



