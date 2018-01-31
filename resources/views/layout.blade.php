
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @hasSection('title')
        <title>John The Investor - @yield('title')</title>
    @else
        <title>John The Investor</title>
    @endif


<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
<?php

function isDashboard() {
    $routes = ['overviewCompany', 'overviewMarket', 'overviewHighTrade'];
    $name = Route::currentRouteName();
    return in_array($name, $routes);
}

function isCompanyManage()
{
    $name = Route::currentRouteName();
    return starts_with($name, 'companies.');
}

function isMarketManage()
{
    $name = Route::currentRouteName();
    return starts_with($name, 'markets.');

}

function isPricesPage()
{
    $name = Route::currentRouteName();
    return starts_with($name, 'prices.');

}

?>
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">John The Investor</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ isDashboard()?'active':'' }}"><a href="/">Dashboards</a></li>
                <li class="{{ isCompanyManage()?'active':'' }}"><a href="{{ route('companies.index') }}">Company</a></li>
                <li class="{{ isMarketManage()?'active':'' }}"><a href="{{ route('markets.index') }}">Market</a></li>
                <li class="{{ isPricesPage()?'active':'' }}"><a href="{{ route('prices.index') }}">Prices</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="row">
    <div class="container-header col-lg-12">
        <div class="col-lg-6">
            @hasSection('title')
                <h1 class="my-4">
                    @yield('title')
                    @hasSection('title_small')
                        <small>@yield('title_small')</small>
                    @endif
                </h1>
            @endif
        </div>
        <div class="container-control col-lg-6">
            @yield('control')
        </div>
    </div>
    </div>
    @yield('content')
</div>
<!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
    function confirmedSubmit(name) {
        if ( ! confirm('Are you sure?')) {
            return false;
        }

        document.getElementById(name).submit();
    }
</script>

</body>
</html>
