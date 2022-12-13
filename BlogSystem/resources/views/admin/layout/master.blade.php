<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.layout.head')
        @yield('css')
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
        @include('admin.layout.foot')
        @yield('js')
    </body>
</html>
