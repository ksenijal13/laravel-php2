@extends('layouts.admin-template')
@section('title')
    miXenial Admin - Collections
@endsection
@section('main')
    <div id="main-admin">
        <h3 class="admin-insert-h3" id="h3-contact-admin">
            Update Collections
        </h3>
        @include('partials.collections-form')
        <div id="update_form_div">
            <form enctype="multipart/form-data" name="update_collection_form" id="update_collection_form"
                  method="POST" action="{{url('/collection/update')}}">
                @csrf
                <table id="all_photos_table" class="upd-table">

                </table>
            </form>
            <a href="#" id="close_update_form"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
        <h3 class="admin-insert-h3">
            Add new Collection now.
        </h3>
        @include('partials.collections-insert-form')
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
