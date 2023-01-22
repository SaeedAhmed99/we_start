<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{ active('admin.') }}" href="{{ route('admin.') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link collapsed {{ active('categories') }}" href="{{ url("#") }}" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ active('categories', 'show') }}" id="category" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ active('admin.category.index', 'active') }}" href="{{ route('admin.category.index') }}">All Category</a>
                        <a class="nav-link {{ active('admin.category.create', 'active') }}" href="{{ route('admin.category.create') }}">Add New</a>
                    </nav>
                </div>
                <a class="nav-link collapsed {{ active('products') }}" href="{{ url("#") }}" data-bs-toggle="collapse" data-bs-target="#product" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ active('products', 'show') }}" id="product" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ active('admin.products.index', 'active') }}" href="{{ route('admin.products.index') }}">All Products</a>
                        <a class="nav-link {{ active('admin.products.create', 'active') }}" href="{{ route('admin.products.create') }}">Add New</a>
                    </nav>
                </div>
                <a class="nav-link collapsed {{ active('coupons') }}" href="{{ url("#") }}" data-bs-toggle="collapse" data-bs-target="#coupons" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Coupons
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ active('coupons', 'show') }}" id="coupons" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ active('admin.coupons.index', 'active') }}" href="{{ route('admin.coupons.index') }}">All Coupons</a>
                        <a class="nav-link {{ active('admin.coupons.create', 'active') }}" href="{{ route('admin.coupons.create') }}">Add Coupons</a>
                    </nav>
                </div>
                <a class="nav-link {{ active('admin.settings', 'active') }}" href="{{ route('admin.settings') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Settings
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
