@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
          <button onclick="modalAction('{{ url('/user/import') }}')" class="btn btn-info">Import User</button>
          <a href="{{ url('/user/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export User</a>
          <a href="{{ url('/user/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export User</a> 
            <button onclick="modalAction('{{ url('user/create_ajax') }}')" class="btn btn-success">Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="level_id" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <select name="level_id" class="form-control form-control-sm" id="level_id" required>
                                <option value="">== LEVEL PENGGUNA ==</option>
                                @foreach ($level as $item)
                                    <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-sm table-striped table-hover" id="table_user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
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

    $(document).ready(function () {
        var dataUser = $('#table_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('user/list') }}",
                dataType: "json",
                type: "POST",
                data: function (d) {
                    d.level_id = $('#level_id').val();
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
                    data: "username",
                    width: "20%",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama",
                    width: "25%",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "level.level_nama",
                    width: "30%",
                    orderable: false,
                    searchable: false
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

        $('#table_user_filter input').unbind().bind().on('keyup', function (e) {
            if (e.keyCode == 13) {
                dataUser.search(this.value).draw();
            }
        });

        $('#level_id').change(function () {
            dataUser.draw();
        });
    });
</script>
@endpush
