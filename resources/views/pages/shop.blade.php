@extends('layouts.template')
@section('title')
    miXenial Socks - Shop
@endsection
@section('main')
    <div id="main-shop" class="flex-element">
        <!-- sidebar -->
        <div id="sidebar" class="flex-element">
           @include('fixed.sidebar')
        </div>
        <div id="socks-and-sort">
            <div id="sort-search" class="flex-element">
                <div class="sort-element" id="search-element">
                    <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <input type="search" id="shop-search-socks" name="shop-search-socks"/>
                </div>
                <div id="count-products">
                    <p id="count-paragraph">
                        {{$numberOfSocks->number}} products
                    </p>
                </div>
                <div id="sort-by-products">
                    <select id="select-price">
                        @foreach($sort_array as $key => $value)
                            @if($key == "0")
                                <option disabled class="option-price" value="{{$key}}">
                                    {{$value}}
                                </option>
                            @else
                                <option class="option-price" value="{{$key}}">
                                    {{$value}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <a href="#" class="erasercl" id="sort-eraser"><span class="fa fa-eraser" aria-hidden="true"></span></a>
                </div>
            </div>
            <div id="socks" class="flex-element">
                @foreach($socks as $sock)
                    @if($sock->show_first)
                        @component('partials.sock', [
                            "sock" => $sock
                        ]);
                        @endcomponent
                    @endif
                @endforeach
            </div>
            <div id="pagination-block">
                <?php $numberOfLinks = $numberOfSocks->number / 12 ?>
                 <ul class="flex-element">
                    @for($i = 0; $i < $numberOfLinks; $i++)
                        <li>
                            <a href="#"  id = "link{{$i}}" data-limit="{{$i}}" class="socks_pagination">{{$i+1}}</a>
                        </li>
                    @endfor </ul>
            </div>

        </div>
    </div>
    <div id="cart-check-socks" class="flex-element">
    </div>
    <div id="your-cart" class="flex-element">

    </div>
@endsection
