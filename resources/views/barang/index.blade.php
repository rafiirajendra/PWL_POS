@extends('layouts.template')

@section('content')
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ $page->title }}</h3>
      <div class="card-tools">
        <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
      </div>
    </div>
    <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <label class="form-control">Filter:</label>
            <div class="col-3">
              <select class="form-control" name="barang_kode" id="barang_kode" required>
                <option value="">- semua -</option>
                @foreach($barang as $item)
                  <option value="{{$item->barang_kode}}">{{$item->barang_nama}}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">barang Kode</small>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
        <thead>
            <tr>
                <th>ID</th>
                <th>barang Kode</th>
                <th>barang Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@push('css')
@endpush

@push('js')
  <script>
    $(document).ready(function() {
      var databarang = $('#table_barang').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ url('barang/list') }}",
          dataType: "json",
          type: "POST",
          "data": function (d){
            d.barang_id = $('#barang_kode').val();
          }
          
        },
        columns: [
          {
            data: "barang_id",
            className: "",
            orderable: true, // Kolom ini bisa diurutkan
            searchable: true // Kolom ini bisa dicari
          },
          {
            data: "barang_kode",
            className: "",
            orderable: true,
            searchable: true
          },
          {
            data: "barang_nama", // Mengambil data level hasil dari ORM berelasi
            className: "",
            orderable: false,
            searchable: false
          },
          {
            data: "aksi",
            className: "",
            orderable: false,
            searchable: false
          }
        ]
      });

      $('#barang_id').on('change', function(){
        dataUser.ajax.reload();
      });
    });
  </script>
@endpush