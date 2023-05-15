<div class="row">
    <div class="col-md-10">

        <form action="<?= base_url('Jabatan/e_mj/' . $col['id_mj']) ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="form-group row">
                <label for="periode" class="col-md-3 col-form-label">Periode</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="periode1" id="periode" class="form-control" autofocus value="<?= $col['periode1'] ?>">
                        <?= form_error('periode1', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="text" name="periode2" id="periode" class="form-control" value="<?= $col['periode2'] ?>">
                    <?= form_error('periode2', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="sk" class="col-md-3 col-form-label">SK</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="file" name="sk" id="sk" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_awal" class="col-md-3 col-form-label">Tanggal Awal</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" value="<?= $col['tgl_awal'] ?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_akhir" class="col-md-3 col-form-label">Tanggal Akhir</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?= $col['tgl_akhir'] ?>">
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