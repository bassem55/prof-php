@extends('layouts.nav_bar')
@section('head_links')
    <link rel="stylesheet" href="{{asset('css/tasks.css')}}">
@endsection
@section('body')

<div class="task_area">
    <?php echo $task; ?>
    <br><br><br>
    <a class="upload" href="{{url('/upload_task')}}"> Upload Task</a>
    <br><br>
</div>

@endsection