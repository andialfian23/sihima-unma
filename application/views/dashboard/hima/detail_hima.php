<!-- CONTROL DATA HIMPUNAN -->
<?php
$himpunan = akses('Himpunan')->num_rows();
$pengurus = akses('Pengurus')->num_rows();
$admin = akses('Admin')->num_rows();
$jabatan = akses('Jabatan')->num_rows();
if ($admin > 0) { ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="kode_prodi">Himpunan</label>
                <div class="col-md-9">
                    <select id="hima" name="hima" class="form-control">
                        <option value="<?= $col['id_hima'] ?>" hidden><?= $col['nama_hima'] ?></option>
                        <?php
                        $hima = $this->db->get('t_hima')->result();
                        foreach ($hima as $h) {
                            echo '<option value="' . $h->kode_prodi . '"> ' . $h->nama_hima . '</option>';
                        }
                        ?>
                    </select>
                    <script>
                        $(document).ready(function() {
                            $('#hima').change(function() {
                                var hima = $(this).val();
                                setTimeout(function() {
                                    window.location.replace("<?= base_url('Dashboard/himpunan/')  ?>" + hima);
                                }, 1000);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- INFORMASI HIMPUNAN -->
<div class="row">
    <div class="col-md-3 text-center">
        <?php if ($col['logo'] != '') { ?>
            <img src="<?= base_url('images/logo/' . $col['logo']) ?>" alt="" class="img-fluid mb-2" width="170px">
        <?php }
        if ($himpunan > 0) : ?>
            <a href="<?= base_url('Himpunan/e_hima/' . $col['id_hima']) ?>" class="btn btn-info btn-block mb-1">
                <i class="fa fa-edit"></i> Ubah Informasi Himpunan
            </a>
        <?php endif; ?>
    </div>
    <div class="col-md-9">
        <div class="table-responsive">

            <table class="table table-sm table-bordered" width="100%">
                <tbody>
                    <tr>
                        <td>Singkatan</td>
                        <th><?= $col['singkatan'] ?></th>
                    </tr>
                    <tr>
                        <td>Nama Himpunan</td>
                        <th><?= $col['nama_hima'] ?></th>
                    </tr>
                    <?php if ($col['id_mj'] != false) : ?>
                        <tr>
                            <td>Periode Sekarang</td>
                            <th><?= $col['periode'] ?></th>
                        </tr>
                        <tr>
                            <td>Ketua Himpunan</td>
                            <th><?= $col['ketua_himpunan'] ?></th>
                        </tr>
                        <tr>
                            <td>Jumlah Anggota Pengurus</td>
                            <th><?= $col['jml_pengurus']; ?></th>
                        </tr>
                        <tr>
                            <td>Masa Jabatan</td>
                            <th><?= $col['masa_jabatan'] ?></th>
                        </tr>
                        <?php if ($pengurus > 0) : ?>
                            <tr>
                                <td>SK</td>
                                <th>
                                    <?php if (!empty($col['sk'])) { ?>
                                        <a target="_blank" href="<?= pdf_url($col['sk']) ?>"><?= $col['sk'] ?></a>
                                    <?php } ?>
                                </th>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 ">
        <table class="table table-sm table-bordered" width="100%">
            <tr>
                <th>Sekretariat Himpunan Mahasiswa</th>
                <th>Contact Person</th>
            </tr>
            <tr>
                <td><?= $col['tempat_sekre'] ?></td>
                <td>
                    <?php
                    if ($col['contact_person'] != 'Belum Ditambahkan') :
                        foreach ($col['contact_person'] as $cp) {
                            if ($himpunan > 0) {
                    ?>
                                <a href="<?= base_url('Himpunan/del_cp/' . $cp['id_cp']) ?>" class="text-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data kontak <?= $cp['nama'] ?>')">(Hapus)</a>
                    <?php
                            }
                            echo $cp['no_telp'] . ' (' . $cp['nama'] . ') <br>';
                        }
                    endif;
                    if ($himpunan > 0) {
                        echo '<a href="' . base_url('Himpunan/add_cp') . '">Tambahkan Contact Person</a>';
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- INFORMASI MASA JABATAN -->
<?php if ($_SESSION['role_id'] < 7) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php if ($jabatan > 0) : ?>
                <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Jabatan/i_mj') ?>">Tambah Masa Jabatan</a>
            <?php endif;
            if ($col['id_mj'] != false) : ?>
                <table width="100%" class="table responsive table-striped table-bordered table-hover nowrap" id="dataTables-sihima">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Masa Jabatan</th>
                            <th>Jumlah Pengurus</th>
                            <th>Status</th>
                            <?php
                            if ($jabatan > 0) {
                            ?>
                                <th>Aksi</th>
                            <?php
                            }
                            ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tampil as $t) {
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    $link = ($_SESSION['role_id'] == '2') ? base_url("Kprodi/pengurus/" . $t['id_mj']) : base_url("Pengurus/anggota/" . $t['id_mj']);
                                    ?>
                                    <a href="<?= $link; ?>">
                                        <?= $t['periode1'] ?>/<?= $t['periode2'] ?>
                                    </a>
                                </td>
                                <td><?= $t['tgl_awal'] . ' - ' . $t['tgl_akhir'] ?></td>
                                <td><?= $t['jml_pengurus'] ?></td>
                                <td>
                                    <?php
                                    if ($t['status_mj'] == '1') {
                                        echo '<b class="text-success">Aktif</b>';
                                    } else {
                                        if (akses('Kprodi')->num_rows() > 0) {
                                            echo '<a href="' . base_url('Kprodi/is_active/' . $t['id_mj'] . '/1') . '" class="text-danger">Tidak Aktif</a>';
                                        } else {
                                            echo '<b class="text-danger">Non-Aktif</b>';
                                        }
                                    }
                                    ?>
                                </td>
                                <?php if ($jabatan > 0) { ?>
                                    <td>
                                        <?php if ($t['status_mj'] == '0') { ?>
                                            <a href="<?= base_url('Jabatan/del_mj/' . $t['id_mj']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus seluruh data pada masa jabatan <?= $t['periode1'] ?>/<?= $t['periode2'] ?> ?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?= base_url('Jabatan/e_mj/' . $t['id_mj']) ?>" class="btn btn-sm btn-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#dataTables-sihima').DataTable({
                            order: [0, 'DESC'],
                            language: {
                                url: "<?= base_url('assets/ID.json') ?>",
                            }
                        });
                    });
                </script>
            <?php
            else :
                echo "<p class='text-danger my-2'>Tidak Ada data Masa Jabatan pada <b>" . $col['nama_hima'] . "</b> !!!</p>";
            endif;
            ?>
        </div>
    </div>
<?php } ?>

<?php
if ($himpunan > 0) :
    if ($col['status_hima'] == '1') {
        $warna_btn = 'btn-danger';
        $text = 'Non-Aktifkan Himpunan';
        $status = '0';
    } else {
        $warna_btn = 'btn-success';
        $text = 'Aktifkan Himpunan';
        $status = '1';
    }
?>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= base_url('Himpunan/status_hima/' . $status . '/' . $col['id_hima']) ?>" class="btn <?= $warna_btn; ?> btn-block mt-1">
                <?= $text; ?>
            </a>
        </div>
    </div>
<?php endif; ?>