@extends('layouts.template')
@section('title')
   miXenial Socks - About Me
@endsection
@section('main')
    <div id="main" class="flex-element">
        <div id="me-image">
            <img src="{{asset('assets/img/'.$about->image)}}" alt="{{$about->alt}}"/>
        </div>
        <div id="me-biography">
            <p>
                {{$about->biography}}
                Go to:
                <a href="{{url('/data/documentation.pdf')}}"> Documentation.</a>
                <a href="{{url('')}}">GitHub.</a>
            </p>
        </div>
    </div>
@endsection

