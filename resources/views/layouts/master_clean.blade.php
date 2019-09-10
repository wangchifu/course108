<!doctype html>
<html>
<head>
    <title>
        @yield('title'){{ env('APP_NAME') }}
    </title>
    @include('layouts.head')
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
