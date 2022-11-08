<!DOCTYPE html>
<html lang="en">
    <head>
        @include('front.layout.head')
        @yield('css')
    </head>
    <body>
        @include('front.layout.header')

        @yield('content')


        @include('front.layout.footer')
        @include('front.layout.foot')

        @yield('js')
    </body>
</html>

