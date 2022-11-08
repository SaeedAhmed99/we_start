<!DOCTYPE html>
<html lang="en">
    <head>
        @yield('css')
        @include('admin.layout.head')
    </head>
    <body class="sb-nav-fixed">
        @include('admin.layout.header')
        <div id="layoutSidenav">
            @include('admin.layout.main-sidebar')
            <div id="layoutSidenav_content">
                @yield('content')
                @include('admin.layout.footer')
            </div>
        </div>
        @yield('js')
        @include('admin.layout.foot')
    </body>
</html>
