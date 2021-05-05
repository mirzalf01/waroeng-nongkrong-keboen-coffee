@extends('layouts.stisla')

@section('title', 'Supplier')

@section('css')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('Stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('Stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<section class="section">
    <div class="row"></div>
    <div class="section-header">
      <h1>Supplier</h1>
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
            <button class="btn btn-primary rounded" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Supplier</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Keterangan</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                <tbody>
                  @php
                        $counter = 1;
                    @endphp
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->no_telp }}</td>
                        <td>{{ $supplier->keterangan }}</td>
                        <td>
                            <button type="button" data-supplier="{{ $supplier }}" class="btn btn-info btn-sm modBut" data-toggle="modal" data-target="#editproduct">
                                <a><span class="fas fa-edit" aria-hidden="true"></span> Edit</a>
                            </button>
                            <form class="d-inline" action="{{ route('suppliers.destroy', $supplier) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apa anda yakin?')"><span class="far fa-trash-alt" aria-hidden="true"></span> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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
{{-- tambah supplier --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Supplier</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate="" method="post" action="{{ route('suppliers.store') }}">
              @csrf
              @method('POST')
              <div class="form-group">
                <label>Nama *</label>
                <input type="text" name="name" class="form-control" required="" value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label>No. Telepon *</label>
                <input type="text" name="no_telp" class="form-control" required="" value="{{old('no_telp')}}">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" value="{{old('keterangan')}}"></textarea>
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

{{-- edit supplier --}}
<div class="modal fade" tabindex="-1" role="dialog" id="editproduct">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Supplier</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate="" method="post" action="{{ route('suppliers.update', 0) }}">
              @csrf
              @method('PUT')
              <input type="hidden" name="id" id="supplierId">
              <div class="form-group">
                <label>Nama *</label>
                <input type="text" id="supplierName" name="name" class="form-control" required="" value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label>No. Telepon *</label>
                <input type="text" id="supplierNoTelp" name="no_telp" class="form-control" required="" value="{{old('no_telp')}}">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" id="supplierKeterangan" name="keterangan" value="{{old('keterangan')}}"></textarea>
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
        { "sortable": false, "targets": [4] }
      ]
    });
    $('#editproduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var supplier = button.data('supplier');
        $('#supplierId').val(supplier['id']);
        $('#supplierName').val(supplier['name']);
        $('#supplierNoTelp').val(supplier['no_telp']);
        $('#supplierKeterangan').val(supplier['keterangan']);
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