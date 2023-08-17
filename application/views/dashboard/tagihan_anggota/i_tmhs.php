<div class="row">
    <div class="col-md-10">
        <div class="form-group row">
            <label for="nama_tagihan" class="col-md-3 col-form-label">Nama Tagihan</label>
            <div class="col-md-9">
                <div class="input-group">
                    <input name="nama_tagihan" id="nama_tagihan" class="form-control" value="<?= $tagihan['nama_tagihan'] ?>" disabled />
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="jml_tagihan" class="col-md-3 col-form-label">Jumlah Tagihan</label>
            <div class="col-md-6">
                <div class="input-group">
                    <input name="jml_tagihan" id="jml_tagihan" class="form-control" value="Rp <?= number_format($tagihan['jml_tagihan']) ?>" disabled />
                </div>
            </div>
        </div>
        <form action="<?= base_url("Tagihan_anggota/i_tmhs/" . $tagihan['no_tg']) ?>" method="POST">
            <div class="form-group row">
                <label for="npm" class="col-md-3 col-form-label">NPM</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="npm" id="npm" value="<?= set_value('npm') ?>" class="form-control npm_mhs" autofocus placeholder="18.14.1.0001" />
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="cari btn btn-info">
                        <i class="fa fa-search"></i> Cari Data
                    </button>
                </div>
            </div>
        </form>
        <?php
        if ($result != 'LOL') {
        ?>
            <hr>
            <div class="form-group row">
                <label class="col-md-12 col-form-label">Hasil Pencarian : <b>NPM <?= $result['id_mahasiswa_pt'] ?></b></label>
            </div>
            <form action="<?= base_url('Tagihan_anggota/insert') ?>" method="POST" accept-charset="utf-8">

                <div class="form-group row">
                    <label for="nama" class="col-md-3 col-form-label">Nama Lengkap</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $result['nm_pd'] ?>" disabled />
                            <input type="hidden" name="id_mhs" id="id_mhs" value="<?= $result['id_mahasiswa_pt'] ?>" />
                            <input type="hidden" name="no_tg" id="npm" value="<?= $tagihan['no_tg'] ?>" />
                            <input type="hidden" name="jenis" id="jenis" value="Lainnya" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-7 offset-md-5">
                        <input type="submit" value="Simpan" class="btn btn-primary btn-md" />
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>