<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ Asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
    
    <title>@yield('title','Share Sphere')</title>
    @stack('css') 
</head>
<body>
    @include('layout.nav')
    <div class="container content-width">

        @if (session('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
        @endif

        @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        @yield('content')

    </div>

</body>
</html>
