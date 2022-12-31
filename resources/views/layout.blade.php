<!DOCTYPE html>
<html lang="de">
<head>
    <title>Carbon Companion</title>
    <script src="{{asset('view/js/jquery-3.6.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('view/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('view/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('view/css/app.css')}}">
</head>
<body>
@include('navigation')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
