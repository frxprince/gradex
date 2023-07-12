@extends('layouts.app')

        @include('layouts.messages')
        @yield('content')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @yield('rightpanel')
</div>
</div>
@endsection
