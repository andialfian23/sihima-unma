<?php $this->load->view('laporan/head') ?>

<?php $this->load->view('laporan/header') ?>
<p><?= $col['deskripsi']; ?></p>

<div>
    <strong>PELAKSANAAN</strong></br>
</div>
<br>
<table id="waktu">
    <tr>
        <td>Hari/ Tanggal</td>
        <td>: </td>
    </tr>
    <tr>
        <td>Tempat</td>
        <td>: <?= $col['tempat'] ?></td>
    </tr>
</table>
<br>

<?php if ($panitia['num_rows'] > 0) : ?>
    <div>
        <strong>
            <?php
                $jml_panitia = $panitia['num_rows'];
                $cek_jml_panitia = $this->absen->cek_sebagai($col['no_kegiatan'], 'Panitia');
                echo ($cek_jml_panitia == $jml_panitia) ? 'DAFTAR PANITIA' : 'SUSUSAN PANITIA';
                ?>
        </strong></br>
    </div>
    <br>
    <div><i>(Terlampir)</i></div><br>
<?php endif;
if ($tampil['num_rows'] > 0) : ?>
    <div>
        <strong>DAFTAR PESERTA</strong></br>
    </div>
    <br>
    <div><i>(Terlampir)</i></div><br>
<?php
endif;

if ($biaya['num_rows'] > 0) :
    ?>
    <div>
        <strong>REALISASI BIAYA</strong></br>
    </div>
    <br>
    <div><i>(Terlampir)</i></div><br>

<?php
endif;
if ($dokumentasi['num_rows'] > 0) :

    ?>
    <div>
        <strong>DOKUMENTASI KEGIATAN</strong></br>
    </div>
    <br>
    <div><i>(Terlampir)</i></div>

<?php endif; ?>

<?php $this->load->view('laporan/footer'); ?>