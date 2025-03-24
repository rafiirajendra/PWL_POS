@extends('layouts.template')

@section('content')
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ $page->title }}</h3>
      <div class="card-tools">
        <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') }}">Tambah</a>
        <button onclick="modalAction('{{ url('kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
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
              <select class="form-control" name="kategori_kode" id="kategori_kode" required>
                <option value="">== NAMA KATEGORI ==</option>
                @foreach($kategori as $item)
                  <option value="{{$item->kategori_kode}}">{{$item->kategori_nama}}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">Nama Kategori</small>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Kategori</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
      </table>
    </div>
  </div>
  <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div> 
@endsection

@push('css')
@endpush

@push('js')
  <script>
    function modalAction(url = '') {
      $('#myModal').load(url, function() {
        $('#myModal').modal('show');
      });
    }

    $(document).ready(function() {
      var dataKategori = $('#table_kategori').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ url('kategori/list') }}",
          dataType: "json",
          type: "POST",
          "data": function (d){
            d.kategori_kode = $('#kategori_kode').val();
          }
          
        },
        columns: [
          {
            data: "kategori_id",
            className: "",
            orderable: true, // Kolom ini bisa diurutkan
            searchable: true // Kolom ini bisa dicari
          },
          {
            data: "kategori_kode",
            className: "",
            orderable: true,
            searchable: true
          },
          {
            data: "kategori_nama", // Mengambil data level hasil dari ORM berelasi
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

      $('#kategori_kode').on('change', function(){
        dataKategori.ajax.reload();
      });
    });
  </script>
@endpush