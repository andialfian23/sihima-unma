<div class="row">
    <div class="col-md-6">

        <form action="<?= base_url('Jabatan/i_jabatan') ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="posisi" class="col-md-4 col-form-label">Nama Jabatan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="jabatan" id="jabatan" class="form-control" autofocus>
                        <?= form_error('jabatan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="level" class="col-md-4 col-form-label">Level Jabatan</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <select name="level" id="level" class="form-control">
                            <?php
                            foreach ($role as $r) :
                            ?>
                                <option value="<?= $r['level'] ?>"><?= $r['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
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