@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Kategori</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/kategori/import') }}')" class="btn btn-info">Import Kategori</button>
            <a href="{{ url('/kategori/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Kategori</a>
            <a href="{{ url('/kategori/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Kategori</a> 
            <button onclick="modalAction('{{ url('/kategori/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
        </div>
    </div>
    <div class="card-body">
        <!-- Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter_date" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <select name="filter_kategori" class="form-control form-control-sm filter_kategori">
                                <option value="">- Semua -</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->kategori_kode }}">{{ $item->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kode Kategori</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-sm table-striped table-hover" id="table-kategori">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    var tableKategori;
    $(document).ready(function () {
        tableKategori = $('#table-kategori').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('kategori/list') }}",
                dataType: "json",
                type: "POST",
                data: function (d) {
                    d.kategori_kode = $('#kategori_kode').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    width: "5%",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kategori_kode",
                    width: "20%",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori_nama",
                    width: "55%",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "text-center",
                    width: "20%",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#table-kategori_filter input').unbind().bind().on('keyup', function (e) {
            if (e.keyCode == 13) {
                tableKategori.search(this.value).draw();
            }
        });

        $('#kategori_kode').change(function () {
            tableKategori.draw();
        });
    });
</script>
@endpush