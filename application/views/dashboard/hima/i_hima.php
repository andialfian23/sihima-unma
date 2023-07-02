<div class="row">
    <div class="col-md-8">

        <form action="<?= base_url('Himpunan/i_hima') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="kode_fak" class="col-md-4 col-form-label">Kode Fakultas</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="kode_fak" id="kode_fak" class="form-control" autofocus>
                        <?= form_error('kode_fak', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="kode_prodi" class="col-md-4 col-form-label">Kode Prodi</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="kode_prodi" id="kode_prodi" class="form-control">
                        <?= form_error('kode_prodi', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="singkatan" class="col-md-4 col-form-label">Singkatan Himpunan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="singkatan" id="singkatan" class="form-control">
                        <?= form_error('singkatan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_hima" class="col-md-4 col-form-label">Nama Himpunan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="nama_hima" id="nama_hima" class="form-control">
                        <?= form_error('nama_hima', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="logo" class="col-md-4 col-form-label">Logo Himpunan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>
                    <img id="preview" height="150px" class="img-responsive mt-1" style="display:none;" alt="Double klik untuk menghapus logo">
                </div>
            </div>
            <div class="form-group row">
                <label for="tempat_sekre" class="col-md-4 col-form-label">Tempat Sekretariat</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="tempat_sekre" id="tempat_sekre" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-7 offset-md-5">
                    <input type="submit" value="Simpan" class="btn btn-primary btn-md" />
                    <input type="reset" value="Ulangi" class="btn btn-danger btn-md" />
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    };
    $(document).ready(function() {
        // Image Preview
        $('#logo').on('change', function() {
            $('#preview').show();
            readURL(this);
        });
        // remove Image Preview
        $('#preview').on('dblclick', function() {
            $('#preview').hide().removeAttr('src');
        });
    });
</script>