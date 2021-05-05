<div>
    <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('logo/logo1.png') }}" width="40px" alt=""> Keboen Coffee</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
          <a href="{{ route('dashboard') }}"><img src="{{ asset('logo/logo1.png') }}" width="40px" alt=""></a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Main Menu</li>
              <li class="{{ (Route::is('dashboard')) ? 'active':'' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
              <li class="{{ (Route::is('products.index')) ? 'active':'' }}"><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-boxes"></i> <span>Produk</span></a></li>
              <li class="{{ (Route::is('suppliers.index')) ? 'active':'' }}"><a class="nav-link" href="{{ route('suppliers.index') }}"><i class="fas fa-truck" aria-hidden="true"></i> <span>Supplier</span></a></li>
              <li class="{{ (Route::is('transactions.index')) ? 'active':'' }}"><a class="nav-link" href="{{ route('transactions.index') }}"><i class="fas fa-exchange-alt nav-icon"></i> <span>Transaksi</span></a></li>
              <li class="nav-item dropdown {{ (Route::is('dailyReport.index')) ? 'active' : ((Route::is('monthlyReport.index')) ? 'active' : '') }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                  <li class="{{ (Route::is('dailyReport.index')) ? 'active':'' }}"><a class="nav-link" href="{{ route('dailyReport.index') }}">Laporan Harian</a></li>
                  
                  @if (Auth::user()->role != 'Karyawan')
                  <li class="{{ (Route::is('monthlyReport.index')) ? 'active':'' }}"><a class="nav-link" href="{{ route('monthlyReport.index') }}">Laporan Bulanan</a></li>
                  @endif
                </ul>
              </li>
              @if (Auth::user()->role != 'Karyawan')
              <li class="{{ (Route::is('users.index')) ? 'active':'' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users nav-icon"></i> <span>Karyawan</span></a></li>
              @endif
            </ul>
        </aside>
    </div>
</div>