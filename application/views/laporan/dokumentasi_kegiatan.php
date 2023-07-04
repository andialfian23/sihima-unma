<?php $this->load->view('laporan/template/head') ?>

<?php $this->load->view('laporan/template/header') ?>

<div style="text-align:center;">
    <h2>DOKUMENTASI KEGIATAN</h2>
    <h2><?= $col['nama_kegiatan'] ?></h2>
    <h2><?= strtoupper($col['nama_hima']) ?></h2>
</div>
<br>

<div style="text-align:center;">

    <?php foreach ($dokumentasi['result'] as $foto) : ?>

        <img src="<?= base_url('media_library/dokumentasi/' . $foto['image']) ?>" alt="" width="70%"><br>
        <p style="text-align:center;margin-top:0px;">
            <b>

                <?= $foto['caption'] ?>
            </b>
        </p>

    <?php endforeach; ?>
</div>


<?php $this->load->view('laporan/template/footer') ?>