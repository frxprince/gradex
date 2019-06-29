@extends('submission.mainlayout')
@section('rightpanel')
<h2>Analysis mode</h2>
@if (count($payload)==0)
    <br>
    You have no submission!
@else
    

<p>Compiler message:
    @if ($payload['submission']->compiler_message ==null)
        No message
    @else
    {{$payload['submission']->compiler_message}}
    @endif
   
<p>Score:{{$payload['submission']->score}}
    <br>
@foreach ($payload['message'] as $key=> $message)
@if ($message=='Y')
<button type="button" class="btn btn-success" onclick="show_analysis(&quot;{{$payload['input'][$key]}}&quot;,&quot;{{$payload['solution'][$key]}}&quot;,&quot;{{$payload['answer'][$key]}}&quot;);">{{$message}}</button>

@else
<button type="button" class="btn btn-danger" onclick="show_analysis(&quot;{{$payload['input'][$key]}}&quot;,&quot;{{$payload['solution'][$key]}}&quot;,&quot;{{$payload['answer'][$key]}}&quot;);">{{$message}}</button>

@endif

@endforeach
<br>

<table  class="table table-bordered">
        <thead>
            <tr>
            <th>Input</th><th>Solution</th><th>Your output</th>
            </tr>
        </thead> 
        <tr><th><p id="input"></th><th><p id="output"></th><th><p id="answer"></th>
        </tr>   
        </table> 
        @endif   
@endsection
<script>
function show_analysis(input,output,answer){
 $("#input").text(input);
 $("#output").text(output);
 $("#answer").text(answer);
}
</script>
