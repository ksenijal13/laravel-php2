@extends('layouts.admin-template')
@section('title')
    Admin Page
@endsection
@section('main')
    <div id="main-admin">
        <div id="all-socks-form">
            @include("partials.all-socks-form")
            <div id="update_form_div">
                <form enctype="multipart/form-data" name="update_photo_form" id="update_photo_form"
                      method="POST" action="{{url('/admin/socks/edit')}}" onsubmit="return updateValidation();">
                    @csrf
                    <table id="all_photos_table" class="upd-table">

                    </table>
                </form>
                <a href="#" id="close_update_form"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
        </div>
        <div id="pagination-block">
            <ul class="flex-element">
              @include('partials.pagination-admin')
            </ul>

        </div>
        <div id="insert_form_div">
            @include('partials.insert-form-socks')
        </div>
        <div id="message">
            @if(session()->has('message'))
                <ul>
                    <li>{{session('message')}}</li>
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
