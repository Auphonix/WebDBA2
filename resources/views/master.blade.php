<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head><title>@yield('pageTitle')</title></head>
@include('shared.header')
<body>
    @include('shared.navbar')
    <div class="container content">
        @yield('content')
    </div>
    @include('shared.footer')
</body>
</html>
