<form action="<?= base_url("Absen/proses_absensi") ?>" method="post">
    <h3><?= $col['nama_kegiatan'] ?></h3>
    <h5><?= $col['tgl_kegiatan'] ?></h5>

    <?php if ($this->absen_model->list_pengurus($col['no_kegiatan'], $_SESSION['id_mj'], 'count') > 0) { ?>

        <table class="table table-bordered table-sm mt-2 responsive">
            <tbody>
                <?php foreach ($tampil as $t) :
                ?>
                    <tr>
                        <td>
                            <input type="text" name="mhs[]" value="<?= $t['id_mahasiswa_pt'] ?>" style="display:none;">
                            <?= $t['nm_pd']; ?>
                        </td>
                        <td>
                            <select name="sebagai[]" id="sebagai" class="form-control">
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
                        </td>
                        <td>
                            <select name="status[]" id="status" class="form-control">
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan='3' class="text-center">
                        <input type="text" name="kegiatan" id="kegiatan" value="<?= $col['no_kegiatan'] ?>" style="display:none" />
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php } else {
        echo "<h3 class='text-center'>Pada Kegiatan ini, Seluruh Anggota Pengurus Sudah Ter-Absen</h3>";
    }
    ?>
</form>