<table class="table table-borderless">
    <tr>
        <td>Nama Peserta</td>
        <th>: <?= $data_mhs['nm_pd'] ?></th>
    </tr>
    <tr>
        <td>NPM</td>
        <th>: <?= $data_mhs['id_mahasiswa_pt'] ?></th>
    </tr>
    <tr>
        <td>Prodi</td>
        <th>: <?= $data_mhs['nama_prodi'] ?></th>
    </tr>
    <tr>
        <td>Fakultas</td>
        <th>: <?= $data_mhs['nama_fak'] ?></th>
    </tr>

    <?php if ($status == 'Hadir') : ?>

        <tr>
            <td>Status Kehadiran</td>
            <th>: <b class="text-success"></b><?= $status ?></b></th>
        </tr>

    <?php endif; ?>
</table>