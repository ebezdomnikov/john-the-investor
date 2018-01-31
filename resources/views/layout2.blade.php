<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @hasSection('title')
        <title>John The Investor - @yield('title')</title>
    @else
        <title>John The Investor</title>
    @endif

    <!-- Bootstrap core CSS -->
    <link href="{{ asset("bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

<?php
        function isActiveRoute($name) {
            return \Route::currentRouteName() === $name;
        }
?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">John The Investor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{isActiveRoute('overviewCompany')?'active':''}}">
                    <a class="nav-link" href="{{ route('overviewCompany') }}">Companies
                        @if(request()->is(route('overviewCompany')))
                        <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{isActiveRoute('overviewMarket')?'active':''}}">
                    <a class="nav-link" href="{{ route('overviewMarket') }}">Markets</a>
                </li>
                <li class="nav-item {{isActiveRoute('overviewHighTrade')?'active':''}}">
                    <a class="nav-link" href="{{ route('overviewHighTrade') }}">Higher Trades</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="container-header col-12">
        <div class="col-6">
        @hasSection('title')
            <h1 class="my-4">
                @yield('title')
                @hasSection('title_small')
                    <small>@yield('title_small')</small>
                @endif
            </h1>
        @endif
        </div>
        <div class="container-control col-6">
            @yield('control')
        </div>
    </div>
    @yield('content')
</div>
<!-- /.container -->

<!-- Bootstrap core JavaScript -->
<script src="{{ asset("jquery/jquery.js") }}"></script>
<script src="{{ asset("bootstrap/js/bootstrap.bundle.js") }}"></script>

</body>

</html>
