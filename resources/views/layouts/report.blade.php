<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="author" content="{{ env('APP_SS') }}">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    </head>
    <body onload="init()">
        {{-- @include('documents.templates.partials.footer') --}}
        
        <div class="content">
            <img style="padding-bottom: 4px;" src="{{ asset('images/Logo Servicio de Salud Tarapacá - Pluma.png') }}"
                width="120" alt="Logo {{ env('APP_SS') }}"><br>
            @yield('content', $slot ?? '')

            <div class="pie_pagina seis center">
                <span class="uppercase">{{ env('APP_SS') }}</span><br>
                {{ env('APP_SS_ADDRESS') }} -
                Fono: {{ env('APP_SS_TELEPHONE') }} -
                {{ env('APP_SS_WEBSITE') }}
            </div>
        </div>

        @yield('custom_js')
    </body>
</html>
