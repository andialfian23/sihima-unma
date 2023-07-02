<a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Himpunan/i_hima') ?>">Tambah Himpunan</a>
<div class="table-responsive">
    <table width="100%" class="table responsive table-striped table-bordered table-sm table-hover no-wrap" id="dataTables-sihima">
        <thead>
            <tr>
                <th>Kode Prodi</th>
                <th>Singkatan</th>
                <th>Nama Himpunan</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($tampil as $t) { ?>
                <tr>
                    <td><?= $t['kode_prodi'] ?></td>
                    <td>
                        <a href="<?= base_url('Dashboard/himpunan/' . $t['id_hima']) ?>">
                            <?= $t['singkatan'] ?>
                        </a>
                    </td>
                    <td><?= $t['nama_hima'] ?></td>
                    <td>
                        <!-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" data-hima='<?= $t['id_hima'] ?>' data-status='<?= ($t['status_hima'] == '1') ? '0' : '1'; ?>' <?= ($t['status_hima'] == '1') ? 'checked' : ''; ?>>
                        </div> -->

                        <?php if ($t['status_hima'] == '1') { ?>
                            <a href="<?= base_url('Himpunan/status_hima/0/' . $t['id_hima']) ?>" class="btn btn-success btn-sm">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        <?php } else { ?>
                            <a href="<?= base_url('Himpunan/status_hima/1/' . $t['id_hima']) ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-minus-circle"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <?php $UA = akses('Himpunan');
                            if ($UA->num_rows() > 0) { ?>
                            <a href="<?= base_url('Himpunan/e_hima/' . $t['id_hima']) ?>" class="btn btn-sm btn-info mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                        <?php } ?>

                        <!-- <a href="<?= base_url('Himpunan/del_hima/' . $t['id_hima']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $t['nama_hima'] ?> ini?')">
                            <i class="fa fa-trash"></i>
                        </a> -->
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-sihima').DataTable();

        // $('.form-check-input').on('click', function() {
        //     var id_hima = $(this).data('hima');
        //     var status_hima = $(this).data('status');
        //     $.ajax({
        //         url: "<?= base_url('Himpunan/is_active_hima') ?>",
        //         type: 'POST',
        //         data: {
        //             id_hima: id_hima,
        //             status_hima: status_hima
        //         },
        //         success: function(response) {
        //             toastr.success(response);
        //             setTimeout(function() {
        //                 window.location.replace("<?= base_url('Himpunan/index') ?>");
        //             }, 2000);
        //         },
        //     });
        // });
    });
</script>