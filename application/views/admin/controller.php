<div class="row">
    <div class="col-md-12">
        <a class="btn btn-block btn-lg btn-info mb-2" href="#" data-toggle="modal" data-target="#myModal">Tambah Controller</a>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Controller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="detail-data">
                        <div class="form-group row">
                            <label for="controller" class="col-md-4 col-form-label">Nama Controller</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="controller" id="controller" class="form-control" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fitur" class="col-md-4 col-form-label">Fitur Controller</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <textarea name="fitur" id="fitur" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7 offset-md-5">
                                <input type="submit" value="Simpan" id="addController" class="btn btn-primary btn-md" />
                                <input type="reset" value="Ulangi" class="btn btn-danger btn-md" />
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#addController').click(function() {
                                    if ($('#controller').val() == '') {
                                        $('#controller').addClass('border border-danger');
                                        toastr.error("Nama controller masih kosong");
                                        return false;
                                    }
                                    if ($('#fitur').val() == '') {
                                        $('#controller').removeClass('border border-danger');
                                        $('#fitur').addClass('border border-danger');
                                        toastr.error("Nama Fitur masih kosong");
                                        return false;
                                    }
                                    var dataset = new FormData();
                                    dataset.append('controller', $('#controller').val());
                                    dataset.append('fitur', $('#fitur').val());
                                    $.ajax({
                                        url: '<?= base_url('Admin/i_ctr') ?>',
                                        type: 'POST',
                                        data: dataset,
                                        contentType: false,
                                        processData: false,
                                        success: function(res) {
                                            // console.log(res);
                                            if (res == '1') {
                                                toastr.success('Berhasil Menambahkan Controller Baru');
                                                setTimeout(function() {
                                                    window.location.replace("<?= base_url('Admin/controller') ?>");
                                                }, 1000);
                                            } else {
                                                $('#controller').addClass('border border-danger');
                                                $('#fitur').removeClass('border border-danger');
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

        <table width="100%" class="table table-bordered table-hover table-sm" id="dataTables-pemilih">
            <thead>
                <tr>
                    <th>Controller</th>
                    <th>Fitur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tampil as $t) { ?>
                    <tr>
                        <td><?= $t['nama_controller'] ?></td>
                        <td><?= $t['fitur'] ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('Admin/e_ctr/' . $t['id_ctr']) ?>" class="btn btn-sm btn-info mb-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="<?= base_url('Admin/del_ctr/' . $t['id_ctr']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $t['nama_controller'] ?> ini?')">
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

        <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTables-pemilih').DataTable();
            });
        </script>
    </div>
</div>