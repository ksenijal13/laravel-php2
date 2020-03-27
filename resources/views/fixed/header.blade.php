<body>
<div id="wrapper">
    <div id="header">
        <div id="user-error">
            @if(session("error"))
                <p>{{session("error")}}</p>
                <a href="#" id="close-error">Ok.</a>
            @endif
        </div>
        <div id="success">
            @include("partials.success")
        </div>
        <div id="top-message" class="flex-element">

            <div id="p-div">
                <p>Free shipping on orders over €35</p>
            </div>
            <div id="login" class="flex-element">
                @if(session()->has("user"))
                    <p>{{session('user')->username}} </p>
                    <a id="sign-out" href="{{url("/logout")}}"><li class="fa fa-sign-out" id="sign-out" aria-hidden="true"></li></a>
                @else
                    <a href="#" id="user-fa">
                        <span class="fa fa-user" aria-hidden="true"></span>
                    </a>
                @endif
            </div>
            <div id="registration-form" class="flex-element">
                @include('partials.login')
                @include('partials.sign_up')
                <div id="errors_div">
                    @include("partials.message")
                    @include("partials.errors")
                </div>
                <a href="#" id="btn-hide-reg-form"><li class="fa fa-window-close"></li></a>

            </div>
        </div>
        <div id="header-content" class="flex-element">
            <div class="logo">
                <a href="{{url('/')}}"><h1>miXenial Socks</h1></a>
            </div>

            <div id="search-socks" class="flex-element">
                <div id="shopping-cart" class="flex-element">
                    @if(session()->has("user"))
                        @if(session('user')->role_id == 2)
                            <a href="#" id="your-cart-link">
                                <span class="fa fa-shopping-cart"></span>
                                <p>Cart</p>
                            </a>
                        @endif
                    @endif
                </div>
            </div>

        </div>
        <div id="menu-d" class="flex-element">
            @include('fixed.nav')
        </div>
    </div>

