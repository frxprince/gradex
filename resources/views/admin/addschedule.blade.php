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
        <table class="table table-bordered" id='leftcol'>
            <tr>
                <thead>
                    <th>ID</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Tasks</th>
                </thead>
           
        </table>

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
    var allproblem;

function drawschedule(){
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
element3.onclick=function() {window.location.href='/admin'; };
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

  //   alert(JSON.stringify(element));
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
                     //alltestcase=result.;
               //     drawbutton();
               allschedule=result;
         
                //   alert(JSON.stringify(result));
               //    alert('done!');
               drawschedule();
                  }});

}
</script>


<div class="modal" tabindex="-1" role="dialog" id="manageschedule">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>