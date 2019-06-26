@foreach ($payload as $item)
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><h2>{{$item['title']}}</h2></h5>
        <p class="card-text">


    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Problems</th>
                <th>Assignment</th>
                <th>Latest submission</th>
                <th>Language</th>
                <th>Results</th>
                <th>Scores</th>
            <tr>
        </thead>
@foreach ($item['course'] as $item2)
<tr>
<th><a href="/submission/{{$item2['problem']['id']}}/{{$item2['course']['id']}}">{{$item2['problem']['title']}}</a></th>
    <th>  {{$item2['course']['updated_at']}}    </th>
    <th>  {{$item2['score']['updated_at']}} </th>
    <th>  {{$item2['score']['Lang']}} </th>
<th><a href="/scoreboard/{{$item2['score']['id']}}">{{$item2['score']['message']}}</a></th>
<th>{{$item2['score']['score']}}</th>
</tr>
@endforeach
<tr>
        <th></th><th></th><th></th><th></th ><th class="text-primary">Total</th><th class="text-primary">{{$item['score']}}</th>
</tr>

    </table>
        </p>
    </div>
</div>
<br>
@endforeach
