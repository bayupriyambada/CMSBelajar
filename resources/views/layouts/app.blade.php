<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titlePage') - CMS Belajar</title>
    @include('layouts.scripts.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    @livewireStyles

</head>

<body>
    <script src="{{ asset('asset/js/demo-theme.min.js?1674944402') }}"></script>
    <div class="page">
        <!-- Navbar -->
        @include('layouts.template.header')
        <div class="page-wrapper">
            <!-- Page body -->
            {{ $slot }}
            @include('layouts.template.footer')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>
    @livewireScripts

    @include('layouts.scripts.js')
</body>

</html>
