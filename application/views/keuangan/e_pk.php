<div class="row">
    <div class="col-md-8">

        <form action="<?= base_url('Keuangan/e_pk/' . $col['no_pk']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="tgl_pk" class="col-md-3 col-form-label">Tanggal Pengeluaran</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="date" name="tgl_pk" id="tgl_pk" class="form-control" autofocus value="<?= $col['tgl_pk'] ?>">
                        <?= form_error('tgl_pk', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_pk" class="col-md-3 col-form-label">Nama Pengeluaran</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="nama_pk" id="nama_pk" class="form-control" value="<?= $col['nama_pengeluaran'] ?>" />
                        <?= form_error('nama_pk', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="jml_pk" class="col-md-3 col-form-label">Jumlah Pengeluaran</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="jml_pk" id="jml_pk" class="form-control" value="<?= $col['jml_pk'] ?>" required />
                        <?= form_error('jml_pk', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>

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