<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @include('layouts.scripts.head')
    @livewireStyles

</head>

<body class="antialiased">

    <div class="page">
        <!-- Navbar -->
        @include('layouts.template.header')
        <div class="page-wrapper">
            <!-- Page body -->
            {{ $slot }}
            @include('layouts.template.footer')
        </div>
    </div>

    @livewireScripts

    @include('layouts.scripts.js')

</body>

</html>