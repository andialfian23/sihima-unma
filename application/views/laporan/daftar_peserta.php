<?php $this->load->view('laporan/template/head') ?>

<?php $this->load->view('laporan/template/header') ?>

<div style="text-align:center;">
    <h2>DAFTAR PESERTA KEGIATAN</h2>
    <h2><?= $col['nama_kegiatan'] ?></h2>
    <h2><?= strtoupper($col['nama_hima']) ?></h2>
</div>
<br>

<?php if ($tampil['num_rows'] > 0) : ?>

    <table id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>--</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($tampil['result'] as $t) :
                if ($t['status'] == 'Hadir') :
            ?>
                    <tr>
                        <td scope="row" width="50px" align="center"><?= $no; ?></td>
                        <td><?= $t['nm_pd'] ?></td>
                        <td><?= $t['keterangan'] ?></td>
                    </tr>
            <?php endif;
                $no++;
            endforeach; ?>
        </tbody>
    </table>

<?php
else :
    echo '<h4>Belum ada data peserta!!!</h4>';
endif;
$this->load->view('laporan/template/footer') ?>