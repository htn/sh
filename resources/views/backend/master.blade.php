<!DOCTYPE html>
<html>
    <head>
        <title>Admin - Con Duong Sang</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/ico_browser.png') }}">


        <link href="{{ asset('backend/css/reset.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/grid.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/font.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/plugins/dialogbox/css/dialogbox.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!-- [if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]
        -->

        <script src="{{ asset('backend/plugins/jquery/3.1.1/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/plugins/dialogbox/js/dialogbox.js') }}"></script>
        <script src="{{ asset('backend/plugins/gui.js') }}"></script>
    </head>
    <body style="overflow: hidden;">
        <div class="uil open_left" id="uil">
            <div class="uil_top clearfix">
                @include('backendLayout/leftTopUI')
            </div>
            <div class="uil_body">
                @include('backendLayout/leftBodyUI')
            </div>
            <div class="uil_bottom">
                @include('backendLayout/leftBottomUI')
            </div>
        </div>
        <div class="uir close_right" id="uir">
            <div class="uir_top">
                @include('backendLayout/rightTopUI')
            </div>
            <div class="uir_body">
                @yield('content')
            </div>
            <div class="uir_bottom">
                @include('backendLayout/rightBottomUI')
            </div>
        </div>
        <div id="blockui" style="display: none;"></div>
        <script type="text/javascript">
            var url_tmpl = '';
            var offleft = 291;
            var path_js = '';
            var path_ns = '';
            $(document).ready(function () {
                $(document.body).gui();
            });
        </script>
    </body>
</html>