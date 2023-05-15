<div class="row">
    <div class="col-md-10">

        <form action="<?= base_url('Keuangan/e_cr/' . $col['id_cr']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="nm_cr" class="col-md-3 col-form-label">Peraturan</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <textarea name="nm_cr" id="nm_cr" class="form-control">
                        <?= $col['cash_rule'] ?>
                        </textarea>
                        <?= form_error('nm_cr', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-7 offset-md-5">
                    <input type="submit" name="order_save" value="Simpan" class="btn btn-primary btn-md" />
                </div>
            </div>
        </form>
    </div>
</div>