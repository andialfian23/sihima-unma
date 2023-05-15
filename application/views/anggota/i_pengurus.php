<div class="row">
    <div class="col-md-10">

        <form action="<?= base_url('Anggota/proses_save/' . $col['id_mahasiswa_pt']) ?>" method="POST" accept-charset="utf-8">

            <div class="form-group row">
                <label for="npm" class="col-md-3 col-form-label">NPM</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="npm" id="npm" class="form-control" value="<?= $col['id_mahasiswa_pt'] ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-3 col-form-label">Nama Lengkap</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input name="nama" id="nama" class="form-control" value="<?= $col['nm_pd'] ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="id_mj" class="col-md-3 col-form-label">Masa Jabatan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select name="id_mj" id="id_mj" class="form-control">
                            <option value="<?= $mj['id_mj'] ?>"><?= $mj['singkatan'] . ' ' . $mj['periode'] ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="id_jabatan" class="col-md-3 col-form-label">Jabatan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select name="id_jabatan" id="id_jabatan" class="form-control">
                            <?php foreach ($tampil as $t) {
                                if ($t['jabatan'] != 'Ketua Himpunan') {
                            ?>
                                    <option value="<?= $t['id_jabatan'] ?>"><?= $t['jabatan'] ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <a href="<?= base_url('Jabatan/i_jabatan') ?>">Klik disini !!!</a>&nbsp;Jika nama jabatan tidak terdapat dalam daftar.
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