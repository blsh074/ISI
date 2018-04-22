<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!--test1  -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
    @yield('styles.header')
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/lists') }}">
                        {{ config('app.name', 'A Book Store') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @if(auth()->id() == 1)
                            <li><a href="{{ url('/admin/products') }}">Product</a></li>
                            <li><a href="{{ url('/order') }}">Order</a></li>
                            @else
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="glypgicon glypgicon-globe"></span>Notifications 
                                    <span class="badge">
                                    @php
                                        $tracks = App\Notification::where('user_id',Auth::user()->id)->whereNull('read_at')->get();
                                        $tracks = $tracks->reverse();
                                        $count = 0;
                                        
                                        foreach($tracks as $track){
                                            $count++;
                                        }
                                    @endphp
                                    {{$count}}
                                    </span>
                                    <meta http-equiv="refresh" content="60" />
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        @php
                                        $tracks = App\Notification::where('user_id',Auth::user()->id)->whereNull('read_at')->get();
                                        $tracks = $tracks->reverse();
                                        @endphp
                                        
                                        
                                        @foreach($tracks as $track)
                                        <!--
                                        <a href='inform' class="test" data-notification-id="{{ $track->id }}">
                                            P.O.{{$track->notifiable_id}} has {{$track->data}}
                                        </a>
                                        -->
                                        @if($track->notifiable_type == 'promotion')
                                        <a href='/informp/{{$track->id}}' class="test" data-notification-id="{{ $track->id }}">
                                            <button type="submit">You have a promotion code "{{$track->data}}"</button>
                                        
                                        </a>
                                        @else
                                        <a href='/inform/{{$track->id}}' class="test" data-notification-id="{{ $track->id }}">
                                            <button type="submit">P.O.{{$track->notifiable_id}} has {{$track->data}}</button>
                                        
                                        </a>
                                        @endif
                                        @endforeach
                                        
                                    </li>
                                </ul>
                            </li>
                            
                            <li><a href="{{ url('/track') }}">Tracking</a></li>
                            <li><a href="{{ url('/cart') }}">Shopping Carts</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                    <a href="/changePassword">
                                       Change Password
                                    </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!--<script>
         $('.test').click(function(e) {
            e.preventDefault()
            
            //console.log($(this).attr('data-notification-id'))
            
            
            axios.delete($(this).attr('href'))
                .then(()=>{
                    window.location = $(this).attr('href')
                })
        })
    </script>
    -->
    @yield('scripts.footer')
</body>
</html>
