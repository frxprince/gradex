@extends('submission.mainlayout')
@section('rightpanel')
<h2>Analysis mode</h2>
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
<button type="button" class="btn btn-success" onclick="show_analysis(&quot;{{$payload['input'][$key][0]}}&quot;,&quot;{{$payload['solution'][$key][0]}}&quot;,&quot;{{$payload['answer'][$key][0]}}&quot;);">{{$message}}</button>

@else
<button type="button" class="btn btn-danger" onclick="show_analysis(&quot;{{$payload['input'][$key][0]}}&quot;,&quot;{{$payload['solution'][$key][0]}}&quot;,&quot;{{$payload['answer'][$key][0]}}&quot;);">{{$message}}</button>

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
@endsection
<script>
function show_analysis(input,output,answer){
 $("#input").text(input);
 $("#output").text(output);
 $("#answer").text(answer);
}
</script>