<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <title>@yield('title')</title>

    <link rel="canonical" href="">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- iconos -->
    <link href="{{ asset('assets/dist/bootstrap-icons.css') }}" rel="stylesheet">
    <!-- spinner -->
    <link href="{{ asset('assets/dist/css/spinner.css') }}" rel="stylesheet">

    <!-- jquery -->
    <script src="{{ asset('assets/dist/js/jquery-3.6.0.js') }}"></script>

    <!-- bootstrap.min.js -->
    <script src="{{ asset('assets/dist/js/bootstrap.min.js') }}"></script>

    <!-- bootstrap.bundle.min.js -->
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>

</head>
<body>
<div id="contenedor_carga"><div id="carga"></div></div>
<header>
    @include('layouts.navbar')
</header>
<div class="jumbotron" >
    <img src="../image/8.png"  style="width: 100%; max-height:40vh; min-height:30vh" >
</div>
<main>


        <div class="container marketing ">
            <hr class="divider">
            <div class="row">
                @yield('content')
            </div>
            <br>
        </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
</main>








</body>


<script type="text/javascript">

    $(document).ready( function () {
        $('#contenedor_carga').hide();
    })
</script>

<!-- redireccionar login -->
@if((session('usuario')=='')&&(session('tienda_id')==''))

    <script>
        var pathname = window.location.pathname;
        if(pathname!='/formlogin'){
            window.location.replace("/formlogin");
        }
    </script>
@endif

<script type="text/javascript">
    function spinner() {
        $('#contenedor_carga').show();
    }
</script>






</html>

