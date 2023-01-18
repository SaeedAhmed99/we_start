<!DOCTYPE html>
<html lang="en">
    @include('admin.layout.head')
    <body class="sb-nav-fixed">
        @include('admin.layout.header')
        <div id="layoutSidenav">
            @include('admin.layout.sidbar')

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('body')
                    </div>
                </main>
                @include('admin.layout.footer')
            </div>

        </div>
        @include('admin.layout.foot')
        @yield('js')
    </body>
</html>

