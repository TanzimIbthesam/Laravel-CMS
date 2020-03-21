<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Document</title>
    <style>
        body{
            background:#000080;
            color:white;
        }
        .menuclass{
            background:#000080 !important;

        }
        .menuclass a{
            color: aliceblue !important;
        }
        .para{
            font-size: 16px;

            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column text-white flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white  shadow-sm menuclass">
        <h5 class="my-0 mr-md-auto font-weight-normal">  <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('home') }}">Home</a>
            <a class="p-2 text-dark" href="{{ route('contact') }}">Contact</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add Blog Post</a>

            @guest
            @if (Route::has('register'))
                <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
            @endif
            <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
        @else
            <a class="p-2 text-dark" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                >Logout ({{ Auth::user()->email }})</a>

            <form id="logout-form" action={{ route('logout') }} method="POST"
                style="display: none;">
                @csrf
            </form>
        @endguest
        </nav>



    </div>

    <div class="container">
        @if(session()->has('status'))
            <p style="color: green">
                {{ session()->get('status') }}
            </p>
        @endif

        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
