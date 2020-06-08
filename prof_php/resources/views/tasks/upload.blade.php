@extends('layouts.nav_bar')
@section('title' , 'Upload Task')
@section('head_links')
    <link rel="stylesheet" href="{{asset('css/upload_task.css')}}">
@endsection
@section('body')
<div class="info"> 
    <?php echo $info; ?>
</div>
<form class="form" action="{{ url('/upload_task')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" class="upload" name="task"> <br><br><br>
    <input type="submit" class="btn" value="Upload task">
</form>
@endsection