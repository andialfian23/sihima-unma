<div class="row">
    <div class="col-md-10">

        <form action="<?= base_url('Jabatan/i_mj') ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <?php if (akses('Admin')->num_rows() > 0) { ?>

                <div class="form-group row">
                    <label class="col-md-3 label-control" for="kode_prodi">Himpunan</label>
                    <div class="col-md-9">
                        <select id="hima" name="hima" class="form-control" required>
                            <option hidden>Pilih Himpunan</option>
                            <?php
                            $hima = $this->db->get('t_hima')->result();
                            foreach ($hima as $h) {
                                echo '<option value="' . $h->id_hima . '"> ' . $h->nama_hima . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

            <?php } ?>
            <div class="form-group row">
                <label for="periode" class="col-md-3 col-form-label">Periode</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="periode1" id="periode" class="form-control" placeholder="<?= date("Y") ?>" autofocus>
                        <?= form_error('periode1', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="text" name="periode2" id="periode" class="form-control" placeholder="<?= date("Y") + 1 ?>">
                    <?= form_error('periode2', '<div class="col-12"><small class="text-danger">', '</small></div>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="npm" class="col-md-3 col-form-label">NPM. Ketua</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="npm" id="npm" class="form-control">
                    </div>
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
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_akhir" class="col-md-3 col-form-label">Tanggal Akhir</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
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