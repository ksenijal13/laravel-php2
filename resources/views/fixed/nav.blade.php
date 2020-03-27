<div id="menu">
    <ul class="flex-element">
        @foreach($menu as $link)
            @component('partials.link', [
                "link" => $link
            ])
            @endcomponent
        @endforeach
    </ul>
</div>

