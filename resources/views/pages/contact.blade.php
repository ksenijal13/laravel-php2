@extends('layouts.template')
@section('title')
    miXenial Socks - Contact
@endsection
@section('main')
    <div id="main" class="flex-element">
        <div id="message">
            @if(session()->has('message'))
                <ul>
                    <li>{{session('message')}}</li>
                </ul>
                <p class='admin_ok closeContact'><a id='closeMessage' href=''>x</a></p>
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
        <div id="contact-admin">
            <h3 class="admin-insert-h3">
                Get In Touch With Us
            </h3>
            <form method="post" action="{{url('send-email/send')}}">
                {{csrf_field()}}
                <table id="contact-table">
                    <tr>
                        <td>
                            <label>Name</label>
                            @if(session()->has('user'))
                                <input type="text" name="contact-name" value="{{session('user')->first_name}}"/>
                            @else
                            <input type="text" name="contact-name"/>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                            @if(session()->has('user'))
                                <input type="email" name="contact-email" value="{{session('user')->email}}"/>
                            @else
                            <input type="email" name="contact-email"/>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Message</label>
                            <textarea name="contact-message"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="contact-submit" value="Send"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection


