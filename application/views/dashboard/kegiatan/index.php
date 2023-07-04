<?php
$akses_kg = akses('Kegiatan')->num_rows();
if ($akses_kg > 0) : ?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Kegiatan/i_kg') ?>">Tambah Kegiatan</a>
<?php endif;
if ($kegiatan->num_rows() > 0) :
?>
    <table width="100%" class="table responsive table-striped table-bordered no-wrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Lingkup</th>
                <?php if ($akses_kg > 0) : ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($kegiatan->result_array() as $row) { ?>
                <tr>
                    <td><?= $row['tgl_kegiatan'] ?> </td>
                    <td>
                        <a href="<?= base_url('Dashboard/info_kegiatan/' . $row['no_kegiatan']) ?>" target="_black">
                            <?= $row['nama_kegiatan'] ?>
                        </a>
                    </td>
                    <td><?= $row['lingkup'] ?> </td>
                    <?php if ($akses_kg > 0) : ?>
                        <td>
                            <a href="<?= base_url('Kegiatan/e_kg/' . $row['no_kegiatan']) ?>" class="btn btn-sm btn-info mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url('Kegiatan/delete/' . $row['no_kegiatan']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $row['nama_kegiatan'] ?> ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-sihima').DataTable({
                language: {
                    url: "<?= base_url('assets/ID.json') ?>",
                },
                pageLength: 10,
                order: [0, 'desc']
            });
        });
    </script>
<?php
else :
    echo "<h4 class='text-center'>Belum ada agenda kegiatan yang dibuat</h4>";
endif;
?>