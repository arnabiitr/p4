<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', config('app.name'))</title>
    <meta charset='utf-8'>

    {{-- CSS global to every page can be loaded here --}}
    <link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" rel="stylesheet" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href='/css/members.css?v=12345' rel='stylesheet'>

    {{-- CSS specific to a given page/child view can be included via a stack --}}
    @stack('head')
</head>
<body>

@if(session('alert'))
    <div class='alert'>
        {{ session('alert') }}
    </div>
@endif

<header>
    <a href='/'><img style="border: none;" src='/images/sprite.png'  height="40" id='logo' alt='p4 Logo'></a>
    <strong>Claim Management System</strong>
    @include('modules.nav')
</header>

<section id='main'>
    <h6>&nbsp;</h6>
    @yield('content')
</section>

<footer>
    <a href='https://github.com/arnabiitr/p4'><i class='fab fa-github'></i> View on Github</a> |
    &copy; {{ date('Y') }}
</footer>


<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>


@stack('body')

</body>
</html>



