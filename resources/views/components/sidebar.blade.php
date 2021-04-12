<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4"><!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('logo/logo1.png') }}" width="40px" alt="">
        <span class="brand-text font-weight-light">Keboen Coffee</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-4 pb-3 mb-3 d-flex">
            <div class="image my-auto">
                @if (Auth::user()->profile_photo_path == NULL)
                <img src="{{ asset('AdminLTE/avatar/avatar-1.png') }}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{ asset('profile_photo/'.Auth::user()->profile_photo_path) }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
            <a href="#" class="text-white d-block">{{ Auth::user()->name }}</a>
            <sub style="color: #F4F6F9">{{ Auth::user()->role }}</sub>
            </div>
        </div>
    
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">Main Navigation</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active':'' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ Route::is('products.index') ? 'active':'' }}">
                    <i class="nav-icon fas fa-utensils"></i>
                    <p>
                        Produk
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}" class="nav-link {{ Route::is('suppliers.index') ? 'active':'' }}">
                    <i class="nav-icon fa fa-address-book"></i>
                    <p>
                        Supplier
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transactions.index') }}" class="nav-link {{ Route::is('transactions.index') ? 'active':'' }}">
                    <i class="fas fa-exchange-alt nav-icon"></i>
                    <p>
                        Transaksi
                    </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('dailyReport.index') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('dailyReport.index') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <p>
                          Laporan
                          <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('dailyReport.index') }}" class="nav-link {{ Route::is('dailyReport.index') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan Harian</p>
                          </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="nav-icon fas fa-power-off"></i>
                    <p>
                        Logout
                    </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
        <!-- /.sidebar -->
    </aside>
</div>