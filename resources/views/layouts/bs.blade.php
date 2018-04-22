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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    

    
</head>
<body>
@section('sidebar')
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
             @guest 
              
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            
            
            <li class="nav-item"><a href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a href="{{ route('register') }}">Register</a></li>
            
            @else
                @if(auth()->id() == 1)
                    <li class="nav-item"><a href="{{ url('/admin/products') }}">Product</a></li>
                    <li class="nav-item"><a href="{{ url('/order') }}">Order</a></li>
                @else
                            
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glypgicon glypgicon-globe"></span>Notifications 
                        <span class="badge">
                        @php
                                        $tracks = App\Notification::where('user_id',Auth::user()->id)->get();
                                        $tracks = $tracks->reverse();
                                        $count = 0;
                                        
                                        foreach($tracks as $track){
                                            $count++;
                                        }
                                    @endphp
                                    {{$count}}
                                    </span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        @php
                                        $tracks = App\Notification::where('user_id',Auth::user()->id)->get();
                                        $tracks = $tracks->reverse();
                                        @endphp
                                        
                                        
                                        @foreach($tracks as $track)
                                        <!--
                                        <a href='inform' class="test" data-notification-id="{{ $track->id }}">
                                            P.O.{{$track->notifiable_id}} has {{$track->data}}
                                        </a>
                                        -->
                                        <a href='/inform/{{$track->id}}' class="test" data-notification-id="{{ $track->id }}">
                                            <button type="submit">P.O.{{$track->notifiable_id}} has {{$track->data}}</button>
                                        
                                        </a>
                                        @endforeach
                                        
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="nav-item"><a href="{{ url('/track') }}">Tracking</a></li>
                            <li class="nav-item"><a href="{{ url('/cart') }}">Shopping Carts</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
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
@show
 
<div class="container">
    @yield('content')
</div>
</body>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>