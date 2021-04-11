@extends('layouts.adminlte')

@section('title', 'Transaksi')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Transaksi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->



<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        {{-- alert error --}}
        <div class="row">
            <div class="col-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            </div>
        </div>
        {{-- Menu --}}
        <div class="row">
            {{-- Foods and Drinks --}}
            <div class="col-lg-7 col-md-8 col-sm-12 col-12">
              {{-- Makanan --}}
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Makanan</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    @foreach ($foods as $food)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="card" style="width: 100%; height: 300px">
                                <img style="object-fit: cover; height:60%;" class="card-img-top" src="{{ asset('gambar_produk/'.$food->img_path) }}" alt="Card image cap">
                                <div class="card-body p-1">
                                  <h5 class="card-title">{{ $food->name }}</h5>
                                  <p class="card-text">Rp. {{ number_format($food->price, 0, ".", ".") }}</p>
                                  <button type="button" data-food="{{ $food }}" class="btn btn-sm btn-primary mt-0" data-toggle="modal" data-target="#tambahcart">
                                    <span class="fas fa-plus" aria-hidden="true"></span> Keranjang
                                  </button>
                                </div>
                              </div>
                        </div>
                    @endforeach
                </div>
                </div>
                <!-- /.card-body -->
              </div>
              {{-- Minuman --}}
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Minuman</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    @foreach ($drinks as $drink)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="card" style="width: 100%; height: 300px">
                                <img style="object-fit: cover; height:60%;" class="card-img-top" src="{{ asset('gambar_produk/'.$drink->img_path) }}" alt="Card image cap">
                                <div class="card-body p-1">
                                  <h5 class="card-title">{{ $drink->name }}</h5>
                                  <p class="card-text">Rp. {{ number_format($drink->price, 0, ".", ".") }}</p>
                                  <button type="button" data-food="{{ $drink }}" class="btn btn-sm btn-primary mt-0" data-toggle="modal" data-target="#tambahcart">
                                    <span class="fas fa-plus" aria-hidden="true"></span> Keranjang
                                  </button>
                                </div>
                              </div>
                        </div>
                    @endforeach
                </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            {{-- Cart --}}
            <div class="col-lg-5 col-md-4 col-sm-12 col-12 ">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Keranjang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <a href="{{ route('carts.index') }}" class="btn btn-tool fas fa-edit" ></a>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Qty</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($carts as $cart)
                        <tr>
                          <th scope="row">{{ $cart->product->name }}</th>
                          <td>{{ $cart->qty }}</td>
                          <td>Rp. {{ number_format($cart->total, 0, ".", ".") }}</td>
                        </tr>
                          @php
                              $emptyCart = false;
                          @endphp
                        @empty
                          @php
                              $emptyCart = true;
                          @endphp
                        <tr>
                          <td colspan="3" class="text-center">Keranjang Kosong!</td>
                        </tr>
                        @endforelse
                        <tr>
                          <td colspan="3" class="text-center">Detail</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">Total</th>
                          <th>Rp. {{ number_format($discount+$carts->sum('total'), 0, ".", ".") }}</th>
                        </tr>
                        <tr>
                          <th colspan="2">Discount</th>
                          <th>Rp. {{ number_format($discount, 0, ".", ".") }}</th>
                        </tr>
                        <tr>
                          <th colspan="2">Grand Total</th>
                          <th>Rp. {{ number_format($carts->sum('total'), 0, ".", ".") }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <div class="card {{ ($emptyCart) ? 'd-none':'' }}">
                <div class="card-header">
                  <h3 class="card-title">Pembayaran</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <form class="needs-validation w-100" novalidate="" method="post" action="{{ route('transactions.store') }}">
                      @csrf
                      @method('POST')
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                      <input type="hidden" name="discount" value="{{ $discount }}">
                      <input type="hidden" name="price" id="jumlahTotal" value="{{ $carts->sum('total') }}">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Kasir</label>
                            <input disabled type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Tanggal</label>
                            <input disabled  class="form-control" value="{{ date('d/m/y') }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Uang</label>
                            <input type="number" id="inputUang" class="form-control">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Kembalian</label>
                            <input type="text" id="inputKembalian" class="form-control" disabled>
                          </div>
                        </div>
                      </div>
                      <button id="paymentProcess" class="btn btn-success mt-3"><i class="fa fa-paper-plane" aria-hidden="true"></i> Proses Pembayaran</button>
                    </form>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
    
@endsection

@section('modals')
{{-- Tambah Cart --}}
<div class="fade modal" tabindex="-1" role="dialog" id="tambahcart">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Masukan ke Keranjang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="" alt="" id="productImage" class="w-100" style="object-fit: contain">
            <form class="needs-validation" novalidate="" method="post" action="{{ route('carts.store') }}">
              @csrf
              @method('POST')
              <input type="hidden" name="id" id="cartId">
              <div class="form-group">
                <label>Nama</label>
                <input disabled type="text" id="cartName" name="name" class="form-control" required="">
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input disabled type="number" id="cartPrice" class="form-control" required="">
                <input type="hidden" id="cartPrice1" name="price" class="form-control" required="">
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" id="cartJumlah" name="jumlah" class="form-control" required="">
              </div>
              <button class="btn btn-primary mt-3">Submit</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    $('#tambahcart').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var cart = button.data('food');
        $('#cartId').val(cart['id']);
        $('#cartName').val(cart['name']);
        $('#cartPrice').val(cart['price']);
        $('#cartPrice1').val(cart['price']);
        $('#productImage').attr('src', 'gambar_produk/'+cart['img_path']);
    });
    $('#inputUang').keyup(function () {
      let kembalian =  $('#inputUang').val() - $('#jumlahTotal').val();
      if (kembalian >= 0) {
        let kembalianIDR = kembalian.toString().split(".");
        kembalianIDR[0] = kembalianIDR[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
        $('#inputKembalian').val("Rp. "+kembalianIDR.join(","));
      }
      else{
        $('#inputKembalian').val("");
      }
    });
    @if (session('successinsert'))
        Swal.fire(
            'Sukses',
            '{{ session('successinsert') }}',
            'success'
        );
    @elseif(session('successedit'))
        Swal.fire(
            'Sukses',
            '{{ session('successedit') }}',
            'success'
        );
    @elseif(session('successdelete'))
        Swal.fire(
            'Sukses',
            '{{ session('successdelete') }}',
            'success'
        );
    @endif
</script>
@endsection