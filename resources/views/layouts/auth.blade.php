<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/auth.css')}}">
        {{-- fontawesome --}}
        <script src="https://kit.fontawesome.com/ea7913d8a3.js" crossorigin="anonymous"></script>
        <title>Setrun Toolkit</title>
    </head>
    <body>
        <div class="auth-container">
            @yield('content')
        </div>
    </body>
</html>
