<div class="row">
    <div class="col-md-12">


        <table width="100%" class="table responsive table-sm table-striped table-bordered table-hover" id="dataTables-sihima">
            <thead>
                <tr>
                    <th>Controller</th>
                    <th>Fitur</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tampil as $t) {
                    if ($t['id_ctr'] > '1') {
                ?>
                        <tr>
                            <td><?= $t['nama_controller'] ?></td>
                            <td><?= $t['fitur'] ?></td>
                            <td class="text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" <?= check_access($col['level'], $t['id_ctr']) ?> data-role="<?= $col['level'] ?>" data-menu="<?= $t['id_ctr'] ?>">
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTables-sihima').DataTable();
            });
            $('.form-check-input').on('click', function() {
                const menuId = $(this).data('menu');
                const roleId = $(this).data('role');
                $.ajax({
                    url: "<?= base_url('Admin/changeaccess'); ?>",
                    type: 'post',
                    data: {
                        menuId: menuId,
                        roleId: roleId
                    },
                    success: function() {
                        document.location.href = "<?= base_url('Admin/menu_access/'); ?>" + roleId;
                    }
                });
            });
        </script>

    </div>
</div>