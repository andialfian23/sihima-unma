<table class="table table-borderless">
    <tr>
        <td>Nama Peserta</td>
        <th>: <?= $row['nama'] ?></th>
    </tr>
    <tr>
        <td>Alamat</td>
        <th>: <?= $row['alamat'] ?></th>
    </tr>
    <tr>
        <td>Telepon</td>
        <th>: <?= $row['telp'] ?></th>
    </tr>
    <tr>
        <td>Email</td>
        <th>: <?= $row['email'] ?></th>
    </tr>

    <?php if ($row['status'] == 'Hadir') : ?>

        <tr>
            <td>Status Kehadiran</td>
            <th>: <b class="text-success"></b><?= $row['status'] ?></b></th>
        </tr>

    <?php endif; ?>
</table>