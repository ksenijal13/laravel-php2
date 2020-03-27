<div class="sock" data-id="">
    <div class="sock-wrapper" data-mainimage="{{$sock->id}}">
        <img src="{{asset('/assets/img/'.$sock->big_image)}}" alt=""/>
    </div>
    <div class="small-pictures flex-element">
        @foreach($sock->smallImages as $small)
            <div class="image-circle">
                <a href="#" data-id="{{$small->id}}" id="sock{{$small->id}}" class="small-image-link"><img src="{{asset('/assets/img/'.$small->small_image)}}" alt=""/></a>
            </div>
        @endforeach
    </div>
    <h3>{{$sock->sock_name}}</h3>
    <p>
    @if($sock->discount > 0)
            {{$price = round($sock->price - ($sock->discount / 100 * $sock->price)) }}
        <i id="old-price">{{round($sock->price)}}</i>

       @else
        {{round($sock->price)}}&#36;
     @endif
    </p>
   @if(session()->has('user'))
       @if(session('user')->role_id == 2)
            <span class="span-cart"><i class="fa fa-shopping-cart"></i><a href="#" data-mother="{{$sock->id_sock}}" class="add-to-cart">Add to Cart</a></span>
       @endif
    @endif
</div>

