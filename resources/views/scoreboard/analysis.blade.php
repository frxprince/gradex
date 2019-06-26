@extends('submission.mainlayout')
@section('rightpanel')
<h2>Analysis mode</h2>
@foreach ($payload['message'] as $key=> $message)
@if ($message=='Y')
<button type="button" class="btn btn-success" onclick="show_analysis({{$key}});">{{$message}}</button>
@else
<button type="button" class="btn btn-danger">{{$message}}</button>
@endif

@endforeach
<br>

<table  class="table table-bordered">
        <thead>
            <tr>
            <th>Input</th><th>Output</th><th>Answer</th>
            </tr>
        </thead> 
        <tr><th><div id="input"></th><th><div id="output"></th><th><div id="answer"></th>
        </tr>   
        </table>    
@endsection
<script>
function show_analysis(case_id){
 $('input')=case_id
}
</script>