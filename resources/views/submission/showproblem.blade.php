<?php

$problem=$payload['problem'];
?>
@if ($problem ==null)
    @include('submission.welcome')
@else
    

<div class="card">
    <div class="card-header" id="heading{{$problem->id}}">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$problem->id}}" aria-expanded="true" aria-controls="collapse{{$problem->id}}">
        <h2>{{$problem->title}}</h2> <br>
        {{$problem->message}}
        <br>
        Level: {{$problem->level}}
        </button>
      </h5>
    </div>

    @endif