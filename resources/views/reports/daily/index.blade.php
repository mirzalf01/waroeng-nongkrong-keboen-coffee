@extends('layouts.stisla')

@section('title', 'Laporan Harian')

@section('css')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
@endsection

@section('main-content')
<section class="section">
    <div class="row"></div>
    <div class="section-header">
      <h1>Laporan Harian</h1>
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
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <p>Total Pemasukan</p>
                    <h3>Rp. {{ number_format($reports->sum('price'), 0, ".", ".") }}</h3>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Invoice</th>
                        <th>Kasir</th>
                        <th>List Produk</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Waktu</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($reports as $report)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $report->invoice }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->list_product }}</td>
                        <td>Rp. {{ number_format($report->discount, 0, ".", ".") }}</td>
                        <td>Rp. {{ number_format($report->price, 0, ".", ".") }}</td>
                        <td>{{ substr($report->created_at, 11,5) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

  </div>
</section>
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
    /* $(function () {
        $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            "buttons": ["excel", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }); */
    $(function () {
        $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            "buttons": [
                { extend: 'excel', className: 'btn-primary'},
                { extend: 'print', className: 'btn-primary'},
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection