<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @include('layouts.scripts.head')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @livewireStyles

</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('asset/js/demo-theme.min.js?1674944402') }}"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="card card-md">
                            <div class="card-body">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('asset/static/illustrations/undraw_secure_login_pdn4.svg') }}" height="300"
                        class="d-block mx-auto" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    @livewireScripts
    <script src="{{ asset('asset/js/tabler.min.js?1674944402') }}" defer></script>
    <script src="{{ asset('asset/js/demo.min.js?1674944402') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}')
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}')
        @endif
    </script>

    @stack('js')

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const loginUrl = document.querySelector('#login-url');
            const urlParams = new URLSearchParams(window.location.search);
            const param = urlParams.get('param');
            const loginUrlText = document.createTextNode(window.location.href.split('?')[0] + '?param=' + param);
            loginUrl.appendChild(loginUrlText);
        });
    </script>

</body>

</html>
