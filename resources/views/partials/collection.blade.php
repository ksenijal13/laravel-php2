<div class="collection-link-div"  id="{{$cat->cat_name}}-coll">
    <a href=""><img src="{{asset('/assets/img/'.$cat->image.'')}}" alt="{{asset(''.$cat->cat_name.'')}}"/>
        <div class="collection-shop-now">
            <h4>
                @if($cat->cat_id == 1)
                    "No boring socks"
                @else
                    "Brightly colored socks"
                @endif
            </h4>
            <span class="shop-btn">Shop now</span>
        </div>
    </a>
</div>
