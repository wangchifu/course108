<!doctype html>
<html>
<head>
    <title>
        @yield('title'){{ env('APP_NAME') }}
    </title>
    @include('layouts.head')
</head>
<body>
@include('layouts.nav')
<br>
<br>
<br>
<div class="container">
    @yield('content')
</div>
<hr>
@include('layouts.footer')
</body>
</html>
