@extends('layouts.nav_bar')
@section('title' , 'Prof PHP')
@section('head_links') 
    <link rel="stylesheet" href="{{asset('/css/welcome.css')}}">
@endsection
@section('body')
    <div class="title">Welcom To Prof PHP</div>
    <div class="first_section">
        
        <div class="txt"><br>
        Prof PHP is tasks website in php<br><br>
        Will help you to learn new things in php <br><br>
        will help you to test your knowledge in php<br><br>
        </div>

    </div>
    <div class="secand_section">
        <div class="txt">if you are new in php and want to be professional<br>
        this is  your home from now 
        </div><br><br>
        <div class="txt">in Prof PHP <br>
        you can upload your task and get result in same secand<br>
    </div>
    <div class="first_section">
        <div class="txt">Steps To start</div>
        <li class="txt steps">sure first you need signup and join to us</li>
        <br><br></br>
        <a class="sp_link" target="blank" href="{{ route('register') }}">Signup</a>
        
        <li class="txt steps">secand click on tasks button in top bar or click on current task in home page</li>
        <br><br></br>
        <a class="sp_link" target="blank" href="{{ url('/task') }}">Tasks</a>
        <li class="txt steps">then you will take your first task</li>
        <li class="txt steps">after you take your task solve it</li>
        <li class="txt steps">after you solve it you can upload it by click on upload tasks in top bar</li>
        <li class="txt steps">after you upload task you will be direct to tasks result page </li>
        <li class="txt steps">finally click on the task that you want know his degree</li>
        
        <li class="txt steps">your work from now will be in this page</li>
        <br><br><br>
        <a class="sp_link" href="{{url('/home')}}" target="blank">==> Home</a>
    </div> 
    
    
    
@endsection
