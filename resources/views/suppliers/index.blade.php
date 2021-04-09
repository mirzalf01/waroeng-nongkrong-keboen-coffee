@extends('layouts.adminlte')

@section('title', 'Supplier')

@section('css')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
@endsection

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Supplier</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Supplier</li>
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
        <!-- data tables -->
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Supplier</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>No. Telpon</th>
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
                <label>No. Telpon *</label>
                <input type="text" name="no_telp" class="form-control" required="" value="{{old('no_telp')}}">
              </div>
              <div class="form-group">
                <label>Keterangan *</label>
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
                <label>No. Telpon *</label>
                <input type="text" id="supplierNoTelp" name="no_telp" class="form-control" required="" value="{{old('no_telp')}}">
              </div>
              <div class="form-group">
                <label>Keterangan *</label>
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
<!-- DataTables  & Plugins -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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