<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{!! csrf_token() !!}" />
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&amp;subset=cyrillic" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.css') }} ">
        <link rel="stylesheet" href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- Styles -->
        @yield('custom_styles')
<body>
    @include('layouts.partials.header')

    <main class="container-fluid">
	  
       @include('layouts.partials.sidebar')
    
        <div class="wall col-md-7">
            @if(Route::currentRouteName() == 'home')
                <div class="porfile_title">
                    <img src="{{ \Auth::user()->img }}" alt="">
                    <h2>{{ \Auth::user()->name }}</h2>
                </div>
            @else
                <div class="porfile_title" style="text-align: center;">
                    <i class="fa fa-file" style="font-size: 30px    "></i>
                    <h2>Feed</h2>
                </div>
            @endif
    {{--         <div class="tabs box">
                <ul>
                    <li><a href="#">TIMELINE</a></li>
                    <li><a href="#">ABOUT</a></li>
                </ul>
            </div> --}}
            @yield('content')
        </div>
    </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

@yield('custom_scripts')
</body>
</html>