<div class="row">
    <div class="col-md-10">

        <form action="<?= base_url('Tagihan/e_tg/' . $col['no_tg']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="created_at" class="col-md-3 col-form-label">Tanggal Dibuat</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="date" name="created_at" id="created_at" class="form-control" autofocus value="<?= $col['created_at'] ?>">
                        <?= form_error('created_at', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_tagihan" class="col-md-3 col-form-label">Nama Tagihan</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="nama_tagihan" id="nama_tagihan" class="form-control" value="<?= $col['nama_tagihan'] ?>" />
                        <?= form_error('nama_tagihan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="jml_tagihan" class="col-md-3 col-form-label">Jumlah Tagihan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="jml_tagihan" id="jml_tagihan" class="form-control" value="<?= $col['jml_tagihan'] ?>" />
                        <?= form_error('jml_tagihan', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis" class="col-md-3 col-form-label">Jenis Tagihan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="<?= $col['jenis'] ?>" hidden> <?= $col['jenis'] ?></option>
                            <option value="Pengurus">Pengurus</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <?= form_error('jenis', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="expired_at" class="col-md-3 col-form-label">Expired</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="date" name="expired_at" id="expired_at" class="form-control" value="<?= $col['expired_at'] ?>">
                        <?= form_error('expired_at', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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