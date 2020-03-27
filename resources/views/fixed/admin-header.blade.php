<div id="header-admin" class="flex-element">
    <div id="logo-admin">
        <a href="{{url('/')}}"><h1>miXenial Socks</h1></a>
    </div>
    <div id="admin-username">
        @if(session()->has("user"))
            <p>{{session('user')->username}} </p>
            <a id="sign-out" href="{{url("/logout")}}"><li class="fa fa-sign-out" id="sign-out" aria-hidden="true"></li></a>
        @endif
    </div>
    <div id="menu-admin">
        <ul class="flex-element">
            @foreach($menu as $link)
                @if($link->admin_meni)
                    @if($link->active)
                        <li>
                            @if($link->link_id == 9)
                                <a href="{{url('/contact')}}" class="{{ (request()->is('contact')) ? 'active-l' : '' }}">
                                    {{$link->link_text}}
                                </a>
                            @elseif($link->link_id == 8)
                                <a href="{{url('/about-me')}}" class="{{ (request()->is('about-me')) ? 'active-l' : '' }}">
                                    {{$link->link_text}}
                                </a>
                             @elseif($link->link_id == 11)
                                <a href="{{url('/'.$link->href)}}" id="activity-parent" class="{{ (request()->is(''.$link->href)) ? 'active-l' : '' }}">
                                    {{$link->link_text}}
                                    @if($newActivities)
                                    <i id="activity-num">
                                        {{$newActivities}}
                                    </i>
                                    @endif
                                </a>
                            @else
                            <a href="{{url('/'.$link->href)}}" class="{{ (request()->is(''.$link->href)) ? 'active-l' : '' }}">
                                {{$link->link_text}}
                            </a>
                            @endif
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </div>
</div>


