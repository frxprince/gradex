@extends('scoreboard.mainlayout')
@section('rightpanel')
<div class="jumbotron">
    <h1 class="display-4">CSMJU Programming Grader</h1>
    <p class="lead">Version 2.1</p>
    <hr class="my-4">
    <p>This software is developed by Miss Kanyarat	Kerdphon and Miss Boonyanuch Sukala as a senoir project,
        under supervision of Asst. Prof. Kongkarn Dullayachai, Dr. Part Pramokchon and Dr. Paween Khoenkaw<br/>
    The codebase is maintained by Dr.Paween Khoenkaw, please report bugs and problems directly to email:paween_k@gmaejo.mju.ac.th
    </p>
</div>

<div class="jumbotron">
    <h1 class="display-4">Statistics</h1>
    <p class="lead"> Report at <?php echo date("d-m-y h:i:sa")?></p>
    <hr class="my-4">
<div class="row">

   Grader availability:&nbsp;&nbsp;
@if ($payload['lastseen'] < 30)
   <p class="text-success">Avaiable / Idle</p>
@endif

@if (($payload['lastseen'] >= 30)  && ($payload['lastseen'] < 60) )
<p class="text-warning">Busy</p>
@endif

@if (($payload['lastseen'] >= 60)  && ($payload['lastseen'] < 120) )
<p class="text-danger">Stall</p>
@endif

@if ($payload['lastseen'] > 120)
<p class="text-danger">Down</p>
@endif
</div>

<div class="row">
    Waiting list:&nbsp;&nbsp;
    @if ($payload['queue_count'] < 5)
<p class="text-success">{{$payload['queue_count'] }}</p>
@else
<p class="text-danger">{{$payload['queue_count'] }}</p>
@endif
</div>
<div class="row">
        The&nbsp;&nbsp;  <p class="text-success">{{$payload['analysis']}}</p>  &nbsp;&nbsp;cases from &nbsp;&nbsp;<p class="text-success">{{$payload['submission']}}</p>&nbsp;&nbsp;  submissions has been evaluated since the system is up and running.
</div>



Latest Submission
<table class="table">
    <thead>

            <th>Name</th><th>Course</th><th>Result</th><th>Lang</th><th>Score</th><th>Time</th>

    </thead>
    @foreach ($payload['latest'] as $item)
        <tr>
        <td>{{$item->user->alias}}</td>  <td>{{$item->schedule->course->name}}</td>  <td>{{$item->message}}</td><td>{{$item->Lang}}</td><td>{{$item->score}}</td>
        <td>{{$item->created_at}}</td>
    </tr>
    @endforeach
</table>

</div>

<div class="jumbotron">
    <h1 class="display-4">Compiler Information</h1>
    <p class="lead">Grader compiler collections</p>
    <hr class="my-4">
    <p>{!!$payload['compiler']!!}</p>
</div>

@endsection
