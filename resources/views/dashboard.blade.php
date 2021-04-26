@extends('layouts.stisla')

@section('title', 'Dashboard')

@section('main-content')
<section class="section">
    <div class="row"></div>
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-box-open"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Produk</h4>
            </div>
            <div class="card-body">
                @if ($products == null)
                    {{ 0 }}
                @else
                    {{ $products->count() }}
                @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Transaksi</h4>
            </div>
            <div class="card-body">
                @if ($transactions == null)
                    {{ 0 }}
                @else
                    {{ $transactions->count() }}
                @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-money-bill"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Pemasukan</h4>
            </div>
            <div class="card-body">
                @if ($transactions == null)
                    {{ 0 }}
                @else
                    Rp. {{ number_format($transactions->sum('price'), 0, ".", ".") }}
                @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Karyawan</h4>
            </div>
            <div class="card-body">
                @if ($users == null)
                    {{ 0 }}
                @else
                    {{ $users->count() }}
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Statistics</h4>
            <div class="card-header-action">
              <div class="btn-group">
                <a href="#" class="btn btn-primary">Week</a>
                <a href="#" class="btn">Month</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <canvas id="myChart" height="182"></canvas>
            <div class="statistic-details mt-sm-4">
              <div class="statistic-details-item">
                <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
                <div class="detail-value">$243</div>
                <div class="detail-name">Today's Sales</div>
              </div>
              <div class="statistic-details-item">
                <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
                <div class="detail-value">$2,902</div>
                <div class="detail-name">This Week's Sales</div>
              </div>
              <div class="statistic-details-item">
                <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</span>
                <div class="detail-value">$12,821</div>
                <div class="detail-name">This Month's Sales</div>
              </div>
              <div class="statistic-details-item">
                <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
                <div class="detail-value">$92,142</div>
                <div class="detail-name">This Year's Sales</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Recent Activities</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled list-unstyled-border">
              <li class="media">
                <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-1.png" alt="avatar">
                <div class="media-body">
                  <div class="float-right text-primary">Now</div>
                  <div class="media-title">Farhan A Mujib</div>
                  <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                </div>
              </li>
              <li class="media">
                <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-2.png" alt="avatar">
                <div class="media-body">
                  <div class="float-right">12m</div>
                  <div class="media-title">Ujang Maman</div>
                  <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                </div>
              </li>
              <li class="media">
                <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-3.png" alt="avatar">
                <div class="media-body">
                  <div class="float-right">17m</div>
                  <div class="media-title">Rizal Fakhri</div>
                  <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                </div>
              </li>
              <li class="media">
                <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-4.png" alt="avatar">
                <div class="media-body">
                  <div class="float-right">21m</div>
                  <div class="media-title">Alfa Zulkarnain</div>
                  <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                </div>
              </li>
            </ul>
            <div class="text-center pt-1 pb-1">
              <a href="#" class="btn btn-primary btn-lg btn-round">
                View All
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@section('js')
  <!-- JS Libraies -->
  <script src="{{ asset('Stisla/node_modules/simpleweather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endsection