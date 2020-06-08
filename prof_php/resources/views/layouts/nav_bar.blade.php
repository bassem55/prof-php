<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="description" content="prof php">
        <meta name="keywords" content="php tasks">
        <meta name="author" content="Bassem Reda">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/nav_bar.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="{{ asset('js/app.js') }}"></script>
        @yield('head_links')
        <script>
            url = "{{url('/')}}"
        </script>
    </head>
    <body>
        @if (Route::has('login'))
        <div class="topnav">
            <a id="logo" href="#here">Prof PHP</a>
            <div class="right">
            @auth
            <!--<a href="{{ url('/home') }}">Home</a>-->
            <a href="{{ url('/tasks_result') }}">Tasks Result</a>
            <a href="{{ url('/upload_task') }}">Upload Tasks</a>
            <a href="{{ url('/task') }}">Tasks</a>
            <a href="{{ url('/contact_us') }}">Contact</a>
            <a href="{{ url('/about_us') }}">About</a>
            
               
            @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
            </div>
        @endif
        </div>
        @yield('body')
    </body>
    @yield('script')
</html>

