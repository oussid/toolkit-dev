<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        {{-- FONTAWESOME SCRIPT --}}
        <script src="https://kit.fontawesome.com/ea7913d8a3.js" crossorigin="anonymous"></script>
        {{-- TOASTR STYLE --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />        {{-- fontawesome --}}
        {{-- DROPDOWN SCRIPT --}}
        <script src="{{asset('js/dropdown.js')}}"></script>
        {{-- DROPDOWN MODAL --}}
        <script src="{{asset('js/modal.js')}}"></script>
        {{-- CHART JS SCRIPT --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js" ></script>
        {{-- LIVEWIRE STYLES --}}
        @livewireStyles
        <title>Setrun Toolkit</title>
    </head>
    <body>
        {{-- scripts for toastr --}}
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <div class="container">
            <x-navbar/>
            <div class="main">
                @yield('content')
            </div>
        </div>
        {{-- LIVEWIRE SCRIPTS --}}
        @livewireScripts
    </body>
</html>
