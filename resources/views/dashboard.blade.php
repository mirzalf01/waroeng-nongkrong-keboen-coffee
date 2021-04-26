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
            <h4 class="text-dark">Best Seller Bulan Ini</h4>
          </div>
          <div class="card-body">
            <canvas id="myChart2"></canvas>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" value="{{ $items }}" id="items">
    <input type="hidden" value="{{ $counters }}" id="counters">
</section>
@endsection

@section('js')
  <!-- JS Libraies -->
  <script src="{{ asset('Stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
  <script>
    $(document).ready(function(){
      var items = $('#items').val().split(",");
      var counters = $('#counters').val().split(",");
      console.log(["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]);
      console.log(items);
      console.log(counters);
      var ctx = document.getElementById("myChart2").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: items,
          datasets: [{
            label: 'Terjual',
            data: counters,
            borderWidth: 2,
            backgroundColor: '#6777ef',
            borderColor: '#6777ef',
            borderWidth: 2.5,
            pointBackgroundColor: '#ffffff',
            pointRadius: 4
          }]
        },
        options: {
          legend: {
            display: true
          },
          scales: {
            yAxes: [{
              gridLines: {
                drawBorder: false,
                color: '#f2f2f2',
              },
              ticks: {
                beginAtZero: true,
                stepSize: 100
              }
            }],
            xAxes: [{
              ticks: {
                display: true
              },
              gridLines: {
                display: false
              }
            }]
          },
        }
      });
    });
    
  </script>
@endsection