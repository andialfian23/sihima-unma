<?php
$kegiatan = akses('Kegiatan')->num_rows();
if ($kegiatan > 0) : ?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Kegiatan/i_kg') ?>">Tambah Kegiatan</a>
<?php endif;
if ($tampil->num_rows() > 0) :
?>
    <table width="100%" class="table responsive table-striped table-bordered no-wrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Lingkup</th>
                <?php if ($kegiatan > 0) : ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tampil->result_array() as $t) { ?>
                <tr>
                    <td><?= $t['tgl_kegiatan'] ?> </td>
                    <td>
                        <a href="<?= base_url('Dashboard/info_kegiatan/' . $t['no_kegiatan']) ?>" target="_black">
                            <?= $t['nama_kegiatan'] ?>
                        </a>
                    </td>
                    <td><?= $t['lingkup'] ?> </td>
                    <?php if ($kegiatan > 0) : ?>
                        <td>
                            <a href="<?= base_url('Kegiatan/e_kg/' . $t['no_kegiatan']) ?>" class="btn btn-sm btn-info mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url('Kegiatan/del_kg/' . $t['no_kegiatan']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $t['nama_kegiatan'] ?> ini?')">
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