<!DOCTYPE html>
<html lang="en">
@include('client.component.heade')
<body>
    @include('client.component.header')
    @include('client.component.navbar')
    @include('client.component.carousel')
    @include('client.component.feature')
    @include('client.component.categories')
    @yield('content')
    @include('client.component.footer')
    @include('client.component.scripts')
</body>
</html>
