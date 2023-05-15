<div class="row">
    <div class="col-md-10">

        <form action="<?= base_url('Pembayaran/' . $col['no_ta']) ?>" method="post" accept-charset="utf-8">

            <div class="form-group row">
                <label for="nama_tagihan" class="col-md-3 col-form-label">Nama Tagihan</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="nama_tagihan" id="nama_tagihan" class="form-control" value="<?= $col['nama_tagihan'] ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="jml_tagihan" class="col-md-3 col-form-label">Jumlah Tagihan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="jml_tagihan" id="jml_tagihan" class="form-control" value="Rp <?= number_format($col['jml_tagihan']) ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="jml_tagihan" class="col-md-3 col-form-label">Sisa Tagihan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="jml_tagihan" id="jml_tagihan" class="form-control" value="Rp <?= number_format($col['jml_tagihan'] - $col['dibayar']) ?>" disabled />
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="npm" class="col-md-3 col-form-label">NPM</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="npm" id="npm" class="form-control" value="<?= $t['id_mahasiswa_pt'] ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-3 col-form-label">Nama</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="nama" id="nama" class="form-control" value="<?= $t['nm_pd'] ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_bayar" class="col-md-3 col-form-label">Tanggal Bayar</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control" autofocus value="<?= date("Y-m-d") ?>">
                        <?= form_error('tgl_bayar', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nominal" class="col-md-3 col-form-label">Nominal Bayar</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="nominal" id="nominal" class="form-control" value="<?= $col['jml_tagihan'] - $col['dibayar'] ?>">
                        <?= form_error('nominal', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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