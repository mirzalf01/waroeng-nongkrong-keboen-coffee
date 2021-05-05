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
      <h1>Manajemen Karyawan</h1>
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
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <button type="button" data-supplier="{{ $user }}" class="btn btn-info btn-sm modBut" data-toggle="modal" data-target="#editproduct">
                                <a><span class="fas fa-edit" aria-hidden="true"></span> Edit</a>
                            </button>
                            <form class="d-inline" action="{{ route('users.destroy', $user) }}" method="POST">
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
{{-- edit karyawan --}}
<div class="modal fade" tabindex="-1" role="dialog" id="editproduct">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate="" method="post" action="{{ route('users.update') }}">
              @csrf
              @method('PUT')
              <input type="hidden" name="id" id="userId">
              <div class="form-group">
                <label>Nama *</label>
                <input type="text" id="userName" name="name" class="form-control" required="" value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label>Email *</label>
                <input type="email" id="userEmail" name="email" class="form-control" required="" value="{{old('email')}}">
              </div>
              <div class="form-group">
                <label>Jabatan *</label>
                <select name="role" id="userRole" class="form-control" value="{{old('role')}}">
                  <option value="Admin">Admin</option>
                  <option value="Karyawan">Karyawan</option>
                </select>
              </div>
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" id="userPassword" name="password" class="form-control">
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
        var user = button.data('supplier');
        $('#userId').val(user['id']);
        $('#userName').val(user['name']);
        $('#userEmail').val(user['email']);
        $('#userRole').val(user['role']);
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