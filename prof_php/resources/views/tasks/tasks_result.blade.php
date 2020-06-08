@extends('layouts.nav_bar')
@section('title' , 'Tasks Solution')
@section('head_links')
    <link rel="stylesheet" href="{{asset('/css/tasks_result.css')}}">
    <script src="{{asset('/js/tasks_result.js')}}"></script>
    <script>
        function over(num)
        {
            let doc = document.getElementById('task_' + num);

            doc.style.backgroundColor = "white";
            doc.style.color = "rgb(18, 3, 58)";
            doc.style.borderStyle = "groove";
            doc.style.borderColor = "rgb(18, 3, 58)";
        }
        function out(num)
        {
            let doc = document.getElementById('task_' + num);

            doc.style.backgroundColor = "rgb(18, 3, 58)";
            doc.style.color = "white";
            doc.style.borderStyle = "none";
        }

    </script>
@endsection
@section('body')

<div class="tasks_area">
    <div class="tasks">
        <div class="btn_task" id="task_1" onmouseover="over('1')" onmouseout="out('1')" onclick ="show_data('1')"> Task 1 </div>
        <div class="btn_task" id="task_2" onmouseover="over('2')" onmouseout="out('2')" onclick ="show_data('2')"> Task 2 </div>
        <div class="btn_task" id="task_3" onmouseover="over('3')" onmouseout="out('3')" onclick ="show_data('3')"> Task 3 </div>
        <div class="btn_task" id="task_4" onmouseover="over('4')" onmouseout="out('4')" onclick ="show_data('4')"> Task 4 </div>
        <div class="btn_task" id="task_5" onmouseover="over('5')" onmouseout="out('5')" onclick ="show_data('5')"> Task 5 </div>
    </div>
    <div id="degree">
        Your Degree : 99%
    </div>
</div>
@endsection
@section('script')
    <script src="{{asset('/js/tasks_result.js')}}"></script>
@endsection