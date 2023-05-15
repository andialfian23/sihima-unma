<?php
$UA = akses('Jabatan');
if ($UA->num_rows() > 0) { ?>
    <a class="btn btn-block btn-lg btn-info mb-2" href="<?= base_url('Jabatan/i_jabatan') ?>">Tambah Jabatan</a>
<?php } ?>
<div class="table-responsive">
    <table width="100%" class="table responsive table-bordered table-hover table-sm nowrap" id="dataTables-pemilih">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Jabatan</th>
                <th>Lvl - Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($tampil as $t) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $t['jabatan'] ?></td>
                    <td><?= $t['level'] . ' - ' . $t['role'] ?></td>
                    <td>
                        <a href="<?= base_url('Admin/e_jabatan/' . $t['id_jabatan']) ?>" class="btn btn-sm btn-info">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?= base_url('Admin/del_jabatan/' . $t['id_jabatan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $t['jabatan'] ?> ini?')">
                            <i class="fa fa-trash"></i>
                        </a>
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
        $('#dataTables-pemilih').DataTable();
    });
</script>