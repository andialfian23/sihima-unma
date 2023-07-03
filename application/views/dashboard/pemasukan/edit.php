<div class="row">
    <div class="col-md-8">

        <form action="<?= base_url('Keuangan/e_pm/' . $pemasukan['no_pm']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="tgl_pm" class="col-md-3 col-form-label">Tanggal Pemasukan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="date" name="tgl_pm" id="tgl_pm" class="form-control" autofocus value="<?= $pemasukan['tgl_pm'] ?>">
                        <?= form_error('tgl_pm', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="sumber" class="col-md-3 col-form-label">Sumber</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="sumber" id="sumber" class="form-control" value="<?= $pemasukan['sumber'] ?>" />
                        <?= form_error('sumber', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_pm" class="col-md-3 col-form-label">Nama Pemasukan</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="nama_pm" id="nama_pm" class="form-control" value="<?= $pemasukan['nama_pemasukan'] ?>" />
                        <?= form_error('nama_pm', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="jml_pm" class="col-md-3 col-form-label">Jumlah Pemasukan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="jml_pm" id="jml_pm" class="form-control" value="<?= $pemasukan['jml_pm'] ?>" />
                        <?= form_error('jml_pm', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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