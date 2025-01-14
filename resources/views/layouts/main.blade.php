<!doctype html>
<html lang="en" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.name') }} | PT. ARITA PRIMA INDONESIA</title>

    <meta name="description" content="Payroll | PT. ARITA PRIMA INDONESIA">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <meta property="og:title" content="Payroll">
    <meta property="og:site_name" content="Codebase">
    <meta property="og:description" content="Payroll | PT. ARITA PRIMA INDONESIA">
    <meta property="og:type" content="Application">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="{{ asset('media/logo/logo_arita.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('media/logo/logo_arita.png') }}">
    <link rel=" apple-touch-icon" sizes="180x180" href="{{ asset('media/logo/logo_arita.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.min.css') }}">

    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/toastr/build/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/pace-progress/themes/blue/pace-theme-flat-top.css') }}">

    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">

    @yield('css')
</head>

<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-fullrow">
        @include('partials.header')
        @include('partials.sidebar')
        <main id="main-container">
            <x-preloader />
            @yield('content')
        </main>
        @include('partials.footer')
    </div>

    {{-- General JS Scripts --}}
    <script src="{{ asset('js/codebase.core.min.js') }}"></script>
    <script src="{{ asset('js/codebase.app.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/pages/op_auth_signin.min.js') }}"></script>

    {{-- JS Libraries --}}
    <script src="{{ asset('libs/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-rowgroup/js/dataTables.rowGroup.min.js') }}"></script>

    {{-- Support JS --}}
    <script src="{{ asset('js/support/loader.js') }}"></script>
    <script src="{{ asset('js/support/support.js') }}"></script>
    <script src="{{ asset('js/support/script.js') }}"></script>

    <script>
        paceOptions = {
            elements: true
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });

        function formatRibuan(value) {
            return value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')
        }
    </script>

    @yield('js')
</body>

</html>