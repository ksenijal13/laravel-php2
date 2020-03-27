<ul class="flex-element">
    @for($i = 0; $i < $number_of_links; $i++)
    <li>
        @if($i == 0)
            <a href=""  id = "link-admin{{$i}}" data-limit="{{$i}}" class="socks-pagination-admin active">{{$i+1}}</a>
        @else
            <a href=""  id = "link-admin{{$i}}" data-limit="{{$i}}" class="socks-pagination-admin">{{$i+1}}</a>
        @endif
    </li>
    @endfor
</ul>
