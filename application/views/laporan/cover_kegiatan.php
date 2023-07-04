<?php $this->load->view('laporan/template/head') ?>

<div style="text-align:center">
    <h2> LAPORAN KEGIATAN</h2>
    <h2> <?= $col['nama_kegiatan'] ?></h2>
    <h2> <?= strtoupper($col['nama_hima']) ?></h2>
    <h2> PERIODE <?= $col['periode'] ?></h2>
    <br><br><br><br><br><br><br><br><br><br>
    <img src="<?= base_url('images/logo/' . $col['logo']) ?>" alt="" width="188px">
    <br><br><br><br><br><br><br><br><br><br>
    <h2><?= strtoupper($col['nama_hima']) ?></h2>
    <h2>UNIVERSITAS MAJALENGKA</h2>
    <h2><?= substr($col['mulai'], 0, 4); ?></h2>
</div>

<?php $this->load->view('laporan/template/footer') ?>