


<div id="accordion">
<?php $data=$payload['data'];?>
@foreach ($data as $course)
<br>

    <div class="card">
      <div class="card-header" id="heading{{$course['title']}}">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$course['title']}}" aria-expanded="true" aria-controls="collapse{{$course['title']}}">
            Course: {{$course['title']}}
          </button>
        </h5>
      </div>
  
      <div id="collapse{{$course['title']}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
@if (count($course['tasks'])>0)
<ul class="list-group">
    @foreach ($course['tasks'] as $task)
        <li class="list-group-item">
        <a href="/submission/{{$task->problem->id}}">{{$task->problem->title}}  ({{$task->end_time}}) </a>

        </li>

    @endforeach
    </ul>
@else
    No task
@endif
        </div>
      </div>
    </div>


@endforeach    
  </div>




