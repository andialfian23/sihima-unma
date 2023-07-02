<div class="row">
    <?php
    $cek_anggota = $this->mydb->cek_user($mhs['id_mahasiswa_pt'])->num_rows();
    $cek_pengurus = $this->pengurus_model->cek_pengurus2($mhs['id_mahasiswa_pt'], $_SESSION['id_mj'])->num_rows();
    if ($qrcode != '') {
        if ($mhs['id_mahasiswa_pt'] == $_SESSION['id_mahasiswa_pt']) {
            $path = img_qrcode($qrcode);
    ?>
            <div class="col-md-3 text-center">
                <img src="<?= $path ?>" alt="" class="img img-fluid" style="margin-top:-15px;" />
            </div>
    <?php
        }
    }
    ?>
    <div class="col-md-9">
        <table class="table table-sm table-bordered" width="100%">
            <tbody>
                <tr>
                    <td>NPM</td>
                    <td>
                        <?= $mhs['id_mahasiswa_pt'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>
                        <?= $mhs['nm_pd'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Fakultas - Prodi</td>
                    <td>
                        <?= $mhs['homebase'] ?>
                    </td>
                </tr>
                <?php
                if ($_SESSION['role_id'] < 4) {
                ?>
                    <tr>
                        <td>Telp</td>
                        <td>
                            <?= $mhs['no_hp'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <?= $mhs['email'] ?>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (akses('Anggota')->num_rows() > 0) { ?>
    <div class="row">
        <?php
        if ($cek_anggota < 1) { ?>
            <div class="col-md-6">
                <form action="<?= base_url('Anggota/p_i_anggota/' . $mhs['id_mahasiswa_pt']) ?>" method="post">
                    <button class="btn btn-success btn-block" type="submit">
                        <i class="fa fa-key"></i> Berikan Akses
                    </button>
                </form>
            </div>
        <?php

        }
        if ($cek_pengurus < 1) { ?>
            <div class="col-md-6">
                <form action="<?= base_url('Anggota/i_pengurus/' . $mhs['id_mahasiswa_pt']) ?>" method="post">
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fa fa-plus"></i> Tambah ke Anggota Pengurus
                    </button>
                </form>
            </div>
        <?php
        }

        // if ($mhs['id_mahasiswa_pt'] == $_SESSION['id_mahasiswa_pt']) {
        ?>
        <!-- <div class="col-md-6">
                    <form action="<?= base_url('Dashboard/qrcode/' . $mhs['id_mahasiswa_pt']) ?>" method="post">
                        <button class="btn btn-info btn-block" type="submit">
                            <i class="fa fa-print"></i> QRcode
                        </button>
                    </form>
                </div> -->
        <?php
        // }
        ?>
    </div>
<?php
}
if ($histori_jabatan->num_rows() > 0) {
?>

    <div class="row">
        <div class="col-md-12">
            <h5 class="text-center my-1">Histori Jabatan</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Himpunan</th>
                            <th>Periode</th>
                            <th>Jabatan</th>
                            <?php
                            if (akses('Anggota')->num_rows() > 0) {
                                if ($mhs['id_mahasiswa_pt'] != $_SESSION['id_mahasiswa_pt']) {
                            ?>
                                    <th>Aksi</th>
                            <?php
                                }
                            } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($histori_jabatan->result_array() as $jbtn) : ?>
                            <tr>
                                <td>
                                    <?= $jbtn['singkatan'] ?>
                                </td>
                                <td>
                                    <?= $jbtn['periode1'] ?>/
                                    <?= $jbtn['periode2'] ?>
                                </td>
                                <td>
                                    <?php
                                    $sekarang = ($jbtn['status_mj'] == '1') ? '<b class="text-success">(Sekarang)</b>' : '';
                                    echo  $jbtn['jabatan'] . ' ' . $sekarang;
                                    ?>
                                </td>
                                <?php
                                if (akses('Anggota')->num_rows() > 0) {
                                    if ($mhs['id_mahasiswa_pt'] != $_SESSION['id_mahasiswa_pt']) {
                                        echo '<td>';
                                        if ($jbtn['id_mj'] == $_SESSION['id_mj']) {

                                ?>
                                            <a class="btn btn-sm btn-info mb-1" href="<?= base_url('Anggota/e_pengurus/' . $mhs['id_mahasiswa_pt']) ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger mb-1" href="<?= base_url(" Anggota/del_pengurus/" . $mhs['id_mahasiswa_pt']); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                <?php

                                        }
                                        echo ' </td>';
                                    }
                                } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
} ?>