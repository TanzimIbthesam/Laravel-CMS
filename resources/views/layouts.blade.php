<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World</title>
    
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body class="colorcontent text-white">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel Blog</h5>
     <nav class="my-2 my-md-0 mr-md-3">
        <a href="{{ route('home') }}">Home</a></li>
        <a href="{{ route('contact') }}">Contact</a></li>
         <a href="{{ route('posts.index') }}">Blog Post</a></li>
         <a href="{{ route('posts.create') }}">Add Blog Post</a></li>
         
        
        {{-- <li><a href="{{ route('blog-post', ['id' => 1]) }}">Home Blog</a></li> --}}
     </nav>
    </div>
    <div class="container">
    @if(session()->has('status'))
    <div class="alert alert-warning" role="alert">
  {{ session()->get('status') }}
  </div>
    <p style="alert alert-warning">
      
    </p>
    </div>
    
    @endif
    @yield('content')
    <script src="{{ mix('js/app.js') }}">
    </script>
</body>
</html>