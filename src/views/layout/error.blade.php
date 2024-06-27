<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    @include('layout.style')
    @yield('styles')
</head>

<body>
    @yield('content')
    <!-- plugins:js -->
    @include('layout.script')
    @yield('scripts')
</body>

</html>
