@extends('layouts.template')
@section('title')
    miXenial Socks - Home
@endsection
@section('main')
    <div id="main" class="flex-element">
        <div id="first-cover">
            @component('partials.cover', [
                "springSummerCollection" => $springSummerCollection
            ])
            @endcomponent
        </div>
    </div>
    <div class="flex-element" id="socks">
    </div>
    <div id="collections-home" class="flex-element">
        @foreach($categories as $cat)
            @if($cat->cat_name != "Universal")
                @component("partials.collection", [
                "cat" => $cat
                ])
                @endcomponent
            @endif
        @endforeach
    </div>
    <div id="valentine-cover">
        @component("partials.valentines-cover", [
            "valentinesCollection" => $valentinesCollection
            ])
        @endcomponent
    </div>
    <div id="your-cart" class="flex-element">
    </div>
@endsection
