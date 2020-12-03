<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            @auth
                <h5 class="my-0 mr-md-auto font-weight-normal">Hello {{auth()->user()->name}}</h5>
            @else
                <h5 class="my-0 mr-md-auto font-weight-normal">Guest</h5>
            @endauth

            <nav class="my-2 my-md-0 mr-md-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a class="btn btn-outline-primary" href="{{ url('question') }}">Questions</a>
                        <a href="{{route('question.create')}}" class="btn btn-outline-primary">Create Question</a>
                    @endif
                    <a class="btn btn-outline-primary" href="{{ url('/') }}">Home</a>
                    <a href="{{route('start_game')}}" class="btn btn-outline-primary">Start a game</a>
                    <form action="{{ route('logout') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary" >Log out</button>
                    </form>


                @else
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a class="btn btn-outline-primary" href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
