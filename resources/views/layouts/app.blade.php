<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>            
        @livewire('parts.header')
            {{ $slot }}
        @livewire('parts.footer')
        <script src="{{asset('/js/jquery-3.1.0.js')}}"></script>
        <script src="{{ mix('/js/app.js') }}" defer></script>
        <script src="{{ asset('/js/swiper.js') }}"></script>
        <script src="{{asset('/js/toastr.min.js')}}"></script>
        <script>window.addEventListener('alert', event => { toastr[event.detail[0].type](event.detail[0].message, event.detail[0].title ?? ''), toastr.options = { "closeButton": true, "progressBar": true, } });</script>
        @stack('scripts')
    </body>
</html>
