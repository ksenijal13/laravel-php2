@extends('layouts.admin-template')
@section('title')
    miXenial Admin - Social Networks
@endsection
@section('main')
    <div id="main-admin">
        <h3 class="admin-insert-h3">
            Delete or update Social Networks!
        </h3>
        @include('partials.social-networks-main-form')
        <h3 class="admin-insert-h3">
            Add new Social Network now!
        </h3>
        @include('partials.social-networks-insert-form')
        <div id="message">
            @if(session()->has('message'))
                <ul>
                    <li>{{session('message')}}</li>
                </ul>
                <p class='admin_ok'><a id='closeMessage' href=''>OK</a></p>
            @endif
                @if(session()->has('errors'))
                    <ul>
                        @foreach(session('errors')->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <p class='admin_ok'><a id='closeMessage' href=''>OK</a></p>
                @endif
        </div>
        <div id="errors">
            @if(session()->has('error'))
                <ul>
                    @foreach(session('error')->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
