<div class="row">
    <div class="col-md-8">

        <form action="<?= base_url('Biaya_kegiatan/insert_' . $jenis . '/' . $col['no_kegiatan']) ?>" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="nama_item" class="col-md-4 col-form-label">
                    Nama Item <?= ucfirst($jenis) ?>
                    <?= ($jenis != 'pengeluaran') ? ' / Sumber Pemasukan' : ''; ?>
                </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input name="nama_item" id="nama_item" class="form-control" value="<?= set_value('nama_item') ?>" placeholder="Kertas HVS" autofocus />
                        <?= form_error('nama_item', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-md-4 col-form-label">Harga /unit</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="harga" id="harga" class="form-control" value="<?= set_value('harga') ?>" placeholder="1000" />
                        <?= form_error('harga', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="volume" class="col-md-4 col-form-label">Volume</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="volume" id="volume" class="form-control" value="<?= set_value('volume') ?>" placeholder="100" />
                        <?= form_error('volume', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <input name="unit" id="unit" class="form-control" value="<?= set_value('unit') ?>" placeholder="lembar" />
                </div>
            </div>
            <div class="form-group row">
                <label for="jumlah" class="col-md-4 col-form-label">Jumlah <?= $jenis ?></label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="jumlah" id="jumlah" class="form-control" value="<?= set_value('jumlah') ?>" placeholder="100000" />
                        <?= form_error('jumlah', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
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