<!DOCTYPE html>
<html lang="en">

<head>
    @stack('title')
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Smart DoorLock Encrypted RFID</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('vendor/template/img/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('vendor/template/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('vendor/template/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/template/css/atlantis.min.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('dashboard/partials/header')
        @include('dashboard/partials/sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    @yield('container')
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('vendor/template/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendor/template/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/template/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('vendor/template/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/template/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('vendor/template/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('vendor/template/js/atlantis.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
