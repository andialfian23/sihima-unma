<div class="row">
    <div class="col-md-12">

        <form action="<?= base_url('Absen/e_absen/' . $col['no_kegiatan'] . '/' . $col['id_mahasiswa_pt']) ?>" method="post">
            <div class="form-group row">
                <div class="col-md-3">Nama Kegiatan</div>
                <div class="col-md-9">
                    <b><?= $col['nama_kegiatan'] ?></b>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">Tanggal Kegiatan</div>
                <div class="col-md-6">
                    <b><?= date_id($col['tgl_kegiatan']) ?></b>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-3">NPM</div>
                <div class="col-md-9">
                    <b> <?= $col['id_mahasiswa_pt'] ?></b>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">Nama Pengurus</div>
                <div class="col-md-9">
                    <b> <?= $nama ?></b>
                </div>
            </div>
            <div class="form-group row">
                <label for="sebagai" class="col-md-3 col-form-label">Sebagai</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select name="sebagai" id="sebagai" class="form-control">
                            <option value="<?= $col['sebagai'] ?>" hidden><?= $col['sebagai'] ?></option>
                            <option value="Panitia">Panitia</option>
                            <option value="Penanggung Jawab">Penanggung Jawab</option>
                            <option value="Ketua Pelaksana">Ketua Pelaksana</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Sie. Acara">Sie. Acara</option>
                            <option value="Sie. Humas">Sie. Humas</option>
                            <option value="Sie. Logistik">Sie. Logistik</option>
                            <option value="Sie. Konsumsi">Sie. Konsumsi</option>
                            <option value="Sie. Dokumentasi">Sie. Dokumentasi</option>
                            <option value="Sie. P3K">Sie. P3K</option>
                            <option value="Peserta">Peserta</option>
                            <option value="Tamu">Tamu Undangan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-md-3 col-form-label">Status</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <select name="status" id="status" class="form-control">
                            <option value="<?= $col['status'] ?>" hidden><?= $col['status'] ?></option>
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Tanpa Keterangan">Tanpa Keterangan</option>
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