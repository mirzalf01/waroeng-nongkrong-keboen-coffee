@extends('layouts.stisla')

@section('title', 'Transaksi')

@section('css')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('Stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('Stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<section class="section">
    <div class="row"></div>
    <div class="section-header">
      <h1>Transaksi</h1>
    </div>
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
      <div class="col-lg-8 col-md-12 col-sm-12 col-12">
        {{-- Makanan --}}
        <div class="card">
          <div class="card-header justify-content-between">
            <h4 class="card-title text-dark">Makanan</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#food">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body collapse show" id="food">
            <div class="row">
              @foreach ($foods as $food)
                  <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                      <div class="card shadow-none" style="width: 100%; height: 300px">
                        <div class="card-header p-0 bg-danger" style="height: 60%;">
                          <img style="object-fit: cover; height:100%;" class="card-img-top" src="{{ asset('gambar_produk/'.$food->img_path) }}" alt="Card image cap">
                        </div>
                        <div class="card-body p-1" style="height: 40%">
                          <h6 class="card-title h-50 mb-0">{{ $food->name }}</h6>
                          <div class="detail h-50">
                            <p class="card-text mb-0">Rp. {{ number_format($food->price, 0, ".", ".") }}</p>
                            <button type="button" data-food="{{ $food }}" class="btn btn-sm btn-primary mt-0" data-toggle="modal" data-target="#tambahcart">
                              <span class="fas fa-plus" aria-hidden="true"></span> Keranjang
                            </button>
                          </div>
                        </div>
                      </div>
                  </div>
              @endforeach
          </div>
          </div>
          <!-- /.card-body -->
        </div>
        {{-- Snack --}}
        <div class="card">
          <div class="card-header justify-content-between">
            <h4 class="card-title text-dark">Cemilan</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#snack">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body collapse show" id="snack">
            <div class="row">
              @foreach ($snacks as $snack)
                  <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                      <div class="card shadow-none" style="width: 100%; height: 300px">
                        <div class="card-header p-0 bg-danger" style="height: 60%;">
                          <img style="object-fit: cover; height:100%;" class="card-img-top" src="{{ asset('gambar_produk/'.$snack->img_path) }}" alt="Card image cap">
                        </div>
                        <div class="card-body p-1" style="height: 40%">
                          <h6 class="card-title h-50 mb-0">{{ $snack->name }}</h6>
                          <div class="detail h-50">
                            <p class="card-text mb-0">Rp. {{ number_format($snack->price, 0, ".", ".") }}</p>
                            <button type="button" data-food="{{ $snack }}" class="btn btn-sm btn-primary mt-0" data-toggle="modal" data-target="#tambahcart">
                              <span class="fas fa-plus" aria-hidden="true"></span> Keranjang
                            </button>
                          </div>
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
          <div class="card-header justify-content-between">
            <h4 class="card-title text-dark">Minuman</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#drink">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body collapse show" id="drink">
            <div class="row">
              @foreach ($drinks as $drink)
                  <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                      <div class="card shadow-none" style="width: 100%; height: 300px">
                        <div class="card-header p-0 bg-danger" style="height: 60%;">
                          <img style="object-fit: cover; height:100%;" class="card-img-top" src="{{ asset('gambar_produk/'.$drink->img_path) }}" alt="Card image cap">
                        </div>
                        <div class="card-body p-1" style="height: 40%">
                          <h6 class="card-title h-50 mb-0">{{ $drink->name }}</h6>
                          <div class="detail h-50">
                            <p class="card-text mb-0">Rp. {{ number_format($drink->price, 0, ".", ".") }}</p>
                            <button type="button" data-food="{{ $drink }}" class="btn btn-sm btn-primary mt-0" data-toggle="modal" data-target="#tambahcart">
                              <span class="fas fa-plus" aria-hidden="true"></span> Keranjang
                            </button>
                          </div>
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
      <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
        <div class="card">
          <div class="card-header justify-content-between">
            <h4 class="card-title text-dark">Keranjang</h4>
            <div class="card-tools">
              <a href="{{ route('carts.index') }}" class="btn btn-tool fas fa-edit" ></a>
              <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#cart">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body collapse show" id="cart">
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
          <div class="card-header justify-content-between">
            <h4 class="card-title text-dark">Pembayaran</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#payment">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body collapse show" id="payment">
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

  </div>
</section>
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
  <!-- JS Libraies -->
  <script src="{{ asset('Stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('Stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

  
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
        swal('Sukses', '{{ session('successinsert') }}', 'success');
    @elseif(session('successedit'))
        swal('Sukses', '{{ session('successedit') }}', 'success');
    @elseif(session('successdelete'))
        swal('Sukses', '{{ session('successdelete') }}', 'success');
    @endif
  </script>
@endsection