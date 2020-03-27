<div class="flex-element" id="footer">
    <div id="f-logo" class="logo">
        <a href="index.php"><h1>&copy; miXenial Socks</h1></a>
    </div>
    <div id="f-soc">
        <ul class="flex-element">
            @foreach($socialNetworks as $s)
                <a href="{{$s->url}}"><?= $s->icon ?></a>
            @endforeach
        </ul>
        <ul class="flex-element" id="contact">

            <li>
                Phone: {{$contact->phone}}
            </li>
            <li>
                Email: {{$contact->email}}
            </li>
            <li>
                Address: {{$contact->address}}
            </li>
        </ul>
    </div>
    <div id="about-me" class="flex-element">
        <h4>Put Some Color In Your Step</h4>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('/assets/js/main.js')}}"></script>
<script type="text/javascript">
    var urlImg = '{{URL::asset('/assets/img/')}}';
    console.log("Url img: " +urlImg);
</script>
</div>
</body>
</html>
