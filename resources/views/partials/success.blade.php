@if(session()->has('success'))
    <p>{{session("success")}}</p>
    <a href="#" id="close-success">Ok.</a>
@endif
