<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4.1.1/css/bootstrap.min.css') }}">
        <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('plugins/jquery-3.3.1.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="{{ asset('plugins/bootstrap-4.1.1/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/gui.js') }}"></script>
        <script type="text/javascript">
            var offleft = 291;
            var path_js = '';
            $(document).ready(function () {
                $(document.body).gui();
            });
        </script>
    </head>
    <body style="overflow: hidden;">
        <div class="uil open_left" id="uil">
            <div class="uil_top clearfix">
                @include('backend/leftTopUI')
            </div>
            <div class="uil_body">
                @include('backend/leftBodyUI')
            </div>
            <div class="uil_bottom">
                @include('backend/leftBottomUI')
            </div>
        </div>
        <div class="uir close_right" id="uir">
            <div class="uir_top">
                @include('backend/rightTopUI')
            </div>
            <div class="uir_body">
                @yield('content')
            </div>
            <div class="uir_bottom">
                @include('backend/rightBottomUI')
            </div>
        </div>
        <div id="blockui" style="display: none;"></div>
    </body>
</html>