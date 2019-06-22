@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
@yield('leftpanel')


        </div>
    <div class="col-md-8">
        @yield('rightpanel')
    </div>
    </div>
</div>
@endsection