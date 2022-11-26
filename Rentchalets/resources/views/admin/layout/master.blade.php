<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.layout.head')
    </head>

    <body>
        <body class="sb-nav-fixed">
            @include('admin.layout.navbar')

            @include('admin.layout.sidebar')

                <div id="layoutSidenav_content">

                    @yield('content')

                    @include('admin.layout.footer')
                </div>
            </div>

        </body>
        @include('admin.layout.foot')
        @yield('js')
    </body>
</html>

