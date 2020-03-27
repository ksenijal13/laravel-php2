@if((!$link->admin_meni || ($link->link_id == 8 || $link->link_id == 9)) && ($link->active))
        <li>
            @if($link->link_text == "Home")
                <a href="{{url('/')}}" id="{{$link->link_text}}" class="{{ (request()->is('/')) ? 'active-l' : '' }}"> {{$link->link_text}}</a>
            @elseif($link->link_id == 14 || $link->link_id == 15 || $link->link_id == 9 || $link->link_id == 3)
                <a href="{{url(''.$link->href)}}" id="{{$link->link_text}}" class="{{ (request()->is(''.$link->href)) ? 'active-l' : '' }}"> {{$link->link_text}}</a>
            @elseif($link->link_id == 8)
                <a href="{{url('/about')}}" id="{{$link->link_text}}" class="{{ (request()->is('about')) ? 'active-l' : '' }}"> {{$link->link_text}}</a>
            @else
                <a href="{{url('/shop')}}" id="{{$link->link_text}}" class="{{ (request()->is('shop')) ? 'active-l' : '' }}"> {{$link->link_text}}</a>
            @endif
        </li>
@endif
