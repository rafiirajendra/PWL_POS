<form action="{{ url('/level/ajax') }}" method="POST" id="form-tambah"> 
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Level Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="level_kode" name="level_kode" value="{{ old('level_kode') }}" required>
                            @error('level_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label>Nama level</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="level_nama" name="level_nama" value="{{ old('level_nama') }}" required>
                            @error('level_nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $("#form-tambah").validate({
            rules: {
                level_kode: { 
                    required: true, 
                    minlength: 3,
                }, level_nama: { 
                    required: true, minlength: 3, maxlength: 100 
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action, type: form.method, data: $(form).serialize(), success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide'); 
                            Swal.fire({
                                icon: 'success', 
                                title: 'Berhasil', 
                                text: response.message
                            });
                            $('#table_level').DataTable().ajax.reload(null, false);
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan', text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }, highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            }, unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    }); 
</script>