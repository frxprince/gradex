@extends('submission.mainlayout')
@section('leftpanel')
@include('submission.tasklist')
@endsection
@section('rightpanel')
Your queue lenght is {{$payload['waiting']}}<br>
The total queue in the grader is {{$payload['queuelenght']}}
<br/>
Don't panic !, grab a cup of coffee and relax.
 Your submission will be graded soon. ( this page is automatically refresh)
@endsection
<meta http-equiv="refresh" content="20">
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
<script type="text/javascript">
  var wsbroker = "grader.drpaween.com";  //mqtt websocket enabled broker
  var wsport = 1884 // port for above
  var client = new Paho.MQTT.Client(wsbroker, wsport,
      "myclientid_" + parseInt(Math.random() * 100, 10));
  client.onConnectionLost = function (responseObject) {
    console.log("connection lost: " + responseObject.errorMessage);
  };
  client.onMessageArrived = function (message) {
    console.log(message.destinationName, ' -- ', message.payloadString);
    if(message.payloadString=='updating'){
        window.location.reload(false);
    }
  };
  var options = {
    timeout: 3,
    userName:"student",
    password:"123456",
    onSuccess: function () {
      console.log("mqtt connected");
      client.subscribe('/grader/status', {qos: 1});
    },
    onFailure: function (message) {
      console.log("Connection failed: " + message.errorMessage);
    }
  };
function init() {
    client.connect(options);
}
document.onload= init();
  </script>
