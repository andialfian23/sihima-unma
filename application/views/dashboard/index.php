<div class="row">
    <?php
    if (akses('Pengurus')->num_rows() > 0) {
        $cek_cr = $this->db->get_where('t_cash_rule', ['id_hima' => $_SESSION['hima_id']]);
        if ($cek_cr->num_rows() > 0) {
    ?>
            <div class="col-md-7 margin-2">
                <h4><b>Peraturan Uang Kas</b></h4>
                <ul>
                    <?php foreach ($cek_cr->result_array() as $t) : ?>
                        <li><?= $t['cash_rule'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php
        } else {
        ?>
            <div class="col-md-7 margin-2">
                <H3>SELAMAT DATANG di</H3>
                <h4>Sistem Informasi Manajemen Himpunan Mahasiswa</h4>
                <h2>Universitas Majalengka</h2>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="col-md-7 margin-2">
            <H3>SELAMAT DATANG di</H3>
            <h4>Sistem Informasi Manajemen Himpunan Mahasiswa</h4>
            <h2>Universitas Majalengka</h2>
        </div>
    <?php
    }
    ?>
</div>
<?php
//KEGIATAN TERBARU
$tgl = date('Y-m-d H:i:s');
if ($kegiatan->num_rows() > 0) {
?>
    </div>
    </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Kegiatan Terbaru</h2>
        </div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="row">
                    <?php
                    foreach ($kegiatan->result_array() as $kg) :
                        $mulai = $kg['mulai'];
                        $selesai = $kg['selesai'];
                        if (($mulai != null) && ($selesai != null)) {
                            $pelaksanaan = waktu_pelaksanaan($mulai, $selesai);
                            $waktu = '<p>
                            <b>Hari/Tanggal </b>: ' . $pelaksanaan['tanggal'] . '</p>
                            <p>
                                <b>Waktu </b>:
                            ' . $pelaksanaan['waktu'] . '</p>';
                        } else {
                            $waktu = longdate_indo($kg['tgl_kegiatan']);
                        }

                        if ($kg['tgl_kegiatan'] == substr($tgl, 0, 10)) {
                            $waktu = '<p><b>Hari ini</b> </p>
                            <p>
                                <b>Waktu </b>:
                            ' . $pelaksanaan['waktu'] . '</p>';
                            $color = '#00dd77';
                        } else {
                            $color = '#000';
                        }

                        $lingkup =  $kg['lingkup'];
                        $kode_prodi =  $kg['kode_prodi'];
                        $kode_fak =  $kg['kode_fak'];
                        if (($lingkup == 'Umum') || (($lingkup == 'Fakultas') && ($kode_fak == $_SESSION['kode_fak'])) || (($lingkup == 'Program Studi') && ($kode_prodi == $_SESSION['kode_prodi'])) || (($lingkup == 'Pengurus') && ($_SESSION['role_id'] < 7) && ($kode_prodi == $_SESSION['kode_prodi']))
                        ) :
                    ?>
                            <div class="col-md-4">
                                <div class="card" style="border:1px solid <?= $color ?>;">
                                    <div class="card-body">
                                        <b><?= $kg['singkatan'] ?></b>
                                        <h4>
                                            <a href="<?= base_url('Dashboard/info_kegiatan/' . $kg['no_kegiatan']) ?>" style="color:<?= $color ?>">
                                                <b>
                                                    <?= $kg['nama_kegiatan']; ?>
                                                </b>
                                            </a>
                                        </h4>
                                        <?= $waktu; ?>
                                        <b>Tempat</b> : <?= $kg['tempat']; ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endif;
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php }  ?>