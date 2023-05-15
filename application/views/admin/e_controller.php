<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url('Admin/e_ctr/' . $col['id_ctr']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="controller" class="col-md-4 col-form-label">Nama Controller</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="controller" id="controller" class="form-control" autofocus value="<?= $col['nama_controller'] ?>">
                        <?= form_error('controller', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="fitur" class="col-md-4 col-form-label">Fitur Controller</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <textarea name="fitur" id="fitur" class="form-control" cols="30" rows="10">
                        <?= $col['fitur'] ?>
                        </textarea>
                        <?= form_error('fitur', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-7 offset-md-5">
                    <input type="submit" name="order_save" value="Simpan" class="btn btn-primary btn-md" />
                    <input type="reset" name="order_reset" value="Ulangi" class="btn btn-danger btn-md" />
                </div>
            </div>
        </form>
    </div>
</div>