<div class="row">
    <div class="col-md-8">
        <form action="<?= base_url('Himpunan/e_hima/' . $col['id_hima']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <?php if (akses('Admin')->num_rows() > 0) { ?>
                <div class="form-group row">
                    <label for="kode_prodi" class="col-md-4 col-form-label">Kode Prodi / Fakultas</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="kode_prodi" id="kode_prodi" class="form-control" value="<?= $col['kode_prodi'] ?>" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="kode_fak" id="kode_fak" class="form-control" value="<?= $col['kode_fak'] ?>" required>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="form-group row">
                <label for="singkatan" class="col-md-4 col-form-label">Singkatan Himpunan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="singkatan" id="singkatan" class="form-control" value="<?= $col['singkatan'] ?>" required autofocus>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_hima" class="col-md-4 col-form-label">Nama Himpunan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="nama_hima" id="nama_hima" class="form-control" value="<?= $col['nama_hima'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="logo" class="col-md-4 col-form-label">Logo Himpunan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>
                    <img id="preview" height="150px" src="<?= img_logo($col['logo']) ?>" class="img-responsive mt-1">
                </div>
            </div>
            <div class="form-group row">
                <label for="tempat_sekre" class="col-md-4 col-form-label">Tempat Sekretariat</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="tempat_sekre" id="tempat_sekre" class="form-control" value="<?= $col['tempat_sekre'] ?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-7 offset-md-5">
                    <input type="submit" value="Simpan" class="btn btn-primary btn-md" />
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

    });
</script>