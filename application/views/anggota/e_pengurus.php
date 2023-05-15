<div class="row">
    <div class="col-md-10">

        <form action="<?= base_url('Anggota/e_pengurus/' . $col['id_mahasiswa_pt']) ?>" method="POST" accept-charset="utf-8">

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
                        <input name="id_mj_v" id="id_mj_v" class="form-control" value="<?= $mj['singkatan'] . ' ' . $mj['periode'] ?>" disabled />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="id_jabatan" class="col-md-3 col-form-label">Jabatan</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select name="id_jabatan" id="id_jabatan" class="form-control">
                            <option value="<?= $opt2['id_jabatan'] ?>" hidden><?= $opt2['jabatan'] ?></option>
                            <?php foreach ($tampil as $t2) { ?>
                                <option value="<?= $t2['id_jabatan'] ?>"><?= $t2['jabatan'] ?></option>
                            <?php } ?>
                        </select>
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