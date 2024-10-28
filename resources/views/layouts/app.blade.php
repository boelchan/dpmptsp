<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ ENV('APP_NAME') }}</title>

    <!-- Styles -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap');

        :root {
            --tblr-font-sans-serif: 'Quicksand', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        required::after {
            content: " *";
            color: red;
        }
    </style>

    @yield('page-style')

</head>

<body class="">
    <div class="page">
        <div class="sticky-top bg-white">
            <header class="navbar navbar-expand-md shadow navbar-light sticky-top d-print-none rounded-bottom">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href="/" style="width: 68px">
                            <img src="{{ setting('logo') }}" alt="#" class="navbar-brand-image">
                        </a>
                    </h1>
                    <div class="navbar-nav flex-row order-md-last">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                                <span class="avatar avatar-sm " style="background-image: url('{{ asset('static/avatar/user-1.png') }}'); border-radius: 50%"></span>
                                <div class="d-none d-xl-block ps-2">
                                    @if (Auth::check())
                                        <div>{{ auth()->user()->name }}</div>
                                        <div class="mt-1 small text-muted text-uppercase">{{ auth()->user()->getRoleNames()[0] }} {{ auth()->user()->instansi?->nama }}</div>
                                    @endif
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                @if (Auth::check())
                                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                                        Pengaturan Akun
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <x-form id="logout-form" action="{{ route('logout') }}" style="display: none;"> </x-form>
                                @else
                                    <a href="/" class="dropdown-item">Home </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('login') }}" class="dropdown-item"> Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="dropdown-item"> Daftar </a>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                            <ul class="navbar-nav">

                                @foreach ($menuData as $m)
                                    @if (Auth::check() && Auth::user()->hasRole($m->role))
                                        <li class="nav-item @isset($m->sub) dropdown @endisset">
                                            <a href="@if (isset($m->sub)) #navbar-base @else {{ route($m->route) }} @endif"
                                                class="nav-link @isset($m->sub) dropdown-toggle @endisset 
                                                @if (isset($m->sub)) @if (Str::startsWith(Route::currentRouteName(),
                                                        collect($m->sub)->pluck('route')->all()))
                                                        active fw-bold @endif
@else
{{ Str::startsWith(Route::currentRouteName(), $m->route) ? 'active fw-bold' : '' }}
                                                @endif
                                                "
                                                @isset($m->sub)
                                                    data-bs-toggle="dropdown"
                                                    data-bs-auto-close="outside" role="button" aria-expanded="false"
                                                @endisset>
                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                    <i class="ti ti-{{ $m->icon }} fs-2"></i>
                                                </span>
                                                <span class="nav-link-title">
                                                    {{ $m->title }}
                                                </span>
                                            </a>
                                            @isset($m->sub)
                                                <div class="dropdown-menu">
                                                    @foreach ($m->sub as $sub)
                                                        @if (Auth::check() && Auth::user()->hasRole($sub->role))
                                                            <a href="{{ route($sub->route) }}" class="dropdown-item {{ Str::startsWith(Route::currentRouteName(), $sub->route) ? 'active fw-bold' : '' }}">
                                                                {{ $sub->title }}
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endisset
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none text-white">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle mb-1">
                                @isset($breadcrumbs)
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        @foreach ($breadcrumbs as $breadcrumb)
                                            @if (!$loop->last)
                                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a></li>
                                            @else
                                                <li class="breadcrumb-item active">{{ $breadcrumb['title'] }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                @endisset
                            </div>
                            <h2 class="page-title text-dark text-snakecase">
                                @yield('title')
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-12 col-md-auto ms-auto d-print-none">
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                @yield('content')
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">Supported By <a href="mailto:boelchan@live.com" class="link-secondary">BooLEANDEV</a> </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    &copy; {{ date('Y') }} {{ ENV('APP_NAME') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Tabler Libs -->

    <!-- Tabler Core -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/sweetalert/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('vendor/knockout/knockout-3.5.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- datatable --}}
    <script src="{{ asset('vendor/datatables/datatables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function(e) {
                Swal.fire(
                    'Gagal',
                    e.responseJSON.message,
                    'error'
                )
            }

        });

        flatpickr(".date", {
            allowInput: true,
            "locale": "id"
        });
        flatpickr(".time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script>

    @yield('page-script')

</body>

</html>
