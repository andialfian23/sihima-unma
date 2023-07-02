<div class="row">
    <div class="col-md-10">

        <a class="btn btn-block btn-lg btn-info mb-2" href="#" data-toggle="modal" data-target="#myModal">Tambah Role</a>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Role Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="detail-data">
                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label">Level</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="level" id="level" class="form-control" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label">Nama Role</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="role" id="role" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 offset-md-5">
                                <input type="submit" value="Simpan" id="addRole" class="btn btn-primary btn-md" />
                                <input type="reset" value="Ulangi" class="btn btn-danger btn-md" />
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#addRole').click(function() {
                                    if ($('#level').val() == '') {
                                        $('#level').addClass('border border-danger');
                                        toastr.error("Level masih kosong");
                                        return false;
                                    }
                                    if ($('#role').val() == '') {
                                        $('#level').removeClass('border border-danger');
                                        $('#role').addClass('border border-danger');
                                        toastr.error("Nama role masih kosong");
                                        return false;
                                    }
                                    var dataset = new FormData();
                                    dataset.append('level', $('#level').val());
                                    dataset.append('role', $('#role').val());
                                    $.ajax({
                                        url: '<?= base_url('Admin/i_role') ?>',
                                        type: 'POST',
                                        data: dataset,
                                        contentType: false,
                                        processData: false,
                                        success: function(res) {
                                            // console.log(res);
                                            if (res == '1') {
                                                toastr.success('Berhasil Menambahkan Role Baru');
                                                setTimeout(function() {
                                                    window.location.replace("<?= base_url('Admin/role') ?>");
                                                }, 1000);
                                            } else {
                                                $('#level').addClass('border border-danger');
                                                $('#role').removeClass('border border-danger');
                                                toastr.error(res);
                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <table width="100%" class="table table-bordered table-hover table-sm nowrap" id="dataTables-sihima">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Nama Role</th>
                    <th>--</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tampil as $t) { ?>
                    <tr>
                        <td class="text-center"><?= $t['level'] ?></td>
                        <td><?= $t['role'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('Admin/menu_access/' . $t['level']) ?>" class="btn btn-sm btn-warning">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                            <a href="<?= base_url('Admin/e_role/' . $t['level']) ?>" class="btn btn-sm btn-info">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>

                            <!-- <a href="<?= base_url('Admin/del_role/' . $t['level']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="fa fa-trash fa-lg"></i>
                            </a> -->

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTables-sihima').DataTable();
            });
        </script>

    </div>
</div>