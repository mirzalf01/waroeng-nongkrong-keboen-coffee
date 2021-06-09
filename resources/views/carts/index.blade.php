@extends('layouts.stisla')

@section('title', 'Keranjang')

@section('css')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('Stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('Stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<section class="section">
    <div class="row"></div>
    <div class="section-header">
      <h1>Keranjang</h1>
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

    {{-- Datatable --}}
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary rounded"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Item</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Discount</th>
                    <th>Total Harga</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                <tbody>
                    @php
                    $counter = 1;
                @endphp
                @foreach ($carts as $cart)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $cart->product->name }}</td>
                    <td>Rp. {{ number_format($cart->product->price, 0, ".", ".") }}</td>
                    <td>{{ number_format($cart->qty, 0, ".", ".") }}</td>
                    <td>Rp. {{ number_format($cart->discount, 0, ".", ".") }}</td>
                    <td>Rp. {{ number_format($cart->total, 0, ".", ".") }}</td>
                    <td>
                        <button type="button" data-cart="{{ $cart }}" class="btn btn-info btn-sm modBut" data-toggle="modal" data-target="#editproduct">
                            <span class="fas fa-edit" aria-hidden="true"></span> Edit
                        </button>
                        <form class="d-inline" action="{{ route('carts.destroy', $cart) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apa anda yakin?')"><span class="far fa-trash-alt" aria-hidden="true"></span> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Total Harga</td>
                        <td colspan="2">Rp. {{ number_format($carts->sum('total'), 0, ".", ".") }}</td>
                    </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@section('modals')
{{-- edit cart --}}
<div class="modal fade" tabindex="-1" role="dialog" id="editproduct">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate="" method="post" action="{{ route('carts.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <input type="hidden" name="id" id="productId">
              <div class="form-group">
                <label>Nama</label>
                <input disabled type="text" id="productName" name="name" class="form-control" required="" value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input disabled type="number" id="productPrice" name="price" class="form-control" required="" value="{{old('price')}}">
              </div>
              <div class="form-group">
                <label>Jumlah *<span class="text-secondary">(Minimal 1)</span></label>
                <input type="number" id="productQty" name="qty" class="form-control" required="" value="{{old('qty')}}">
              </div>
              <div class="form-group">
                <label>Discount <span class="text-secondary">(Tulis 0 jika tidak ada)</span></label>
                <input type="number" id="productDiscount" name="discount" class="form-control" value="{{old('discount')}}">
              </div>
              <div class="form-group">
                <label>Total Harga</label>
                <input disabled type="number" id="productTotal" name="total" class="form-control" required="" value="{{old('total')}}">
              </div>
              <div class="form-group">
                <span>* Tidak boleh kosong</span>
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
    $("#table-1").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [1,6] }
      ]
    });
    $('#editproduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var product = button.data('cart');
        $('#productId').val(product['id']);
        $('#productName').val(product.product.name);
        $('#productPrice').val(product.product.price);
        $('#productQty').val(product['qty']);
        $('#productDiscount').val(product['discount']);
        $('#productTotal').val(product['total']);
    });
    $('#productQty').change(function () {
        let total = ($('#productPrice').val() * $('#productQty').val()) - ($('#productDiscount').val() * $('#productQty').val()); 
        $('#productTotal').val(total);
    });
    $('#productDiscount').change(function () {
        let total = ($('#productPrice').val() * $('#productQty').val()) - ($('#productDiscount').val() * $('#productQty').val()); 
        $('#productTotal').val(total);
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