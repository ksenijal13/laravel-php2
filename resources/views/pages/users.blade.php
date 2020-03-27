@extends('layouts.admin-template')
@section('title')
    miXenial Admin -    Users
@endsection
@section('main')
    <div id="main-admin">
        <h3 class="admin-insert-h3" id="h3-contact-admin">
            Users
        </h3>
        @include('partials.users-form')
        <div id="pagination-block">{{$users->links()}}</div>
        <h3 class="admin-insert-h3" id="h3-contact-admin">
            Admins
        </h3>
        @include('partials.admins-form');
        <div id="pagination-block">{{$admins->links()}}</div>
        <h3 class="admin-insert-h3">
            Add new Admin now.
        </h3>
        @include('partials.users-insert-form')
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

        </div>
    </div>
@endsection

