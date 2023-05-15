<div class="row">
    <div class="col-md-6">

        <form action="<?= base_url('Admin/e_role/' . $col['level']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="level" class="col-md-4 col-form-label">Level</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="level" id="level" class="form-control" disabled value="<?= $col['level'] ?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label">Nama Role</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="role" id="role" class="form-control" autofocus value="<?= $col['role'] ?>">
                        <?= form_error('role', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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