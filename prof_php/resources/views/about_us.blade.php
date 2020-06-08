@extends('layouts.nav_bar')
@section('title' , 'Prof PHP')
@section('head_links')
<style>
    .mid
    {
        
        text-align:center;
    }
    #img
    {
        margin-top:100px;
        width:200px;
        height:200px;
        border-radius: 100px;
    }
</style>

@endsection
@section('body')
    <div class="mid">
        <img id="img" src="{{url('/photos/b.jpg')}}">
        <h1>This Website Created By Bassem Reda</h1>
        <h1>Gmail :: bassemreda55@gmail.com</h1>
        <h1>Phone :: +2 01202873616</h1>
    </div>
    
@endsection