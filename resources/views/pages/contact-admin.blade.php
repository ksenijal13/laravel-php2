@extends('layouts.admin-template')
@section('title')
    miXenial Admin - Contact
@endsection
@section('main')
    <div id="main-admin">
        <h3 class="admin-insert-h3" id="h3-contact-admin">
            Update miXenial Socks Contact.
        </h3>
        @include('partials.contact-form-admin')
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
