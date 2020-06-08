@extends('layouts.nav_bar')
@section('title' , 'Prof PHP')
@section('head_links')
    <style>
        #option_1
        {
            margin-top:10%;
        }
        .options
        {
            margin-left: 25%;
            margin-right: 25%;
            font-size: 150%;
            font-weight: bold;
            text-align: center;
            width: 50%;
            height: 10%;
            padding-top: 2%;
            border-style: groove;
            border-color: rgb(87, 46, 46);
            border-radius: 25%;
            color:rgb(14, 14, 73);
        }
    </style>
    <script>
        function go_to(link)
        {
            window.location.assign(link);
        }
        function hover(id)
        {
            let div = document.getElementById(id);
            div.style.backgroundColor = "rgb(87, 46, 46)";
            div.style.color = "white";
        }
        function out(id)
        {
            let div = document.getElementById( id);
            div.style.backgroundColor = "white";
            div.style.color = "rgb(17, 12, 68)";
        }
    </script>
@endsection
@section('body')  
        <div class="options" id="option_1" onmouseover="hover('option_1')" onmouseout="out('option_1')" onclick=go_to("{{url('/task')}}")>
            Current Task
        </div>
        <div class="options" id="option_2" onmouseover="hover('option_2')" onmouseout="out('option_2')" onclick=go_to("{{url('/upload_task')}}")>
            Upload Current Task
        </div>
        <div class="options" id="option_3" onmouseover="hover('option_3')" onmouseout="out('option_3')" onclick=go_to("{{url('/tasks_result')}}")>
            Tasks Result
        </div>
       
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('/js/home.js')}}"></script>
@endsection
