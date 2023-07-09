<div class="row">
    <div class="col-md-12">

        <a class="btn btn-block btn-lg btn-info mb-2" href="#" data-toggle="modal" data-target="#myModal" id="addCtrlr">Tambah Controller</a>

        <table width="100%" class="table table-bordered table-hover table-sm" id="dataTables-sihima">
            <thead>
                <tr>
                    <th>Controller</th>
                    <th>Fitur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($controllers as $row) { ?>
                    <tr>
                        <td><?= $row['nama_controller'] ?></td>
                        <td><?= $row['fitur'] ?></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-info mb-1" onclick="editCtrlr(<?= $row['id_ctr'] ?>)" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger" onclick="delCtrlr(<?= $row['id_ctr'] ?>,'<?= $row['nama_controller'] ?>')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>


        <script type="text/javascript">
            var base_url = "<?= base_url('Admin/ctrlr') ?>";

            function editCtrlr(id) {
                $('#nama_controller').removeClass('border border-danger');
                $('#exampleModalLabel').html('Form Edit Controller');
                $('#submitAdd').hide();
                $('#submitEdit').show();
                $.ajax({
                    url: base_url + "/get",
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#nama_controller').val(res.nama_controller);
                        $('#fitur').html(res.fitur);
                        $('#id_ctr').val(res.id_ctr);
                    },
                });
            }

            function delCtrlr(id, nama_ctr) {
                if (confirm('Apakah anda yakin ingin menghapus data ' + nama_ctr + ' ini ?')) {
                    $.ajax({
                        url: base_url + "/delete",
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        dataType: 'json',
                        success: function(res) {
                            toastr.success('Berhasil Menghapus Data ' + nama_ctr);
                            setTimeout(function() {
                                window.location.replace(base_url);
                            }, 1000);
                        },
                    });
                }
            }

            $(function() {
                $('#dataTables-sihima').DataTable();

                $('#addCtrlr').click(function() {
                    $('#exampleModalLabel').html('Form Tambah Controller');
                    $('#nama_controller').removeClass('border border-danger');
                    $('#nama_controller').val('');
                    $('#fitur').html('');
                    $('#submitAdd').show();
                    $('#submitEdit').hide();
                });

                $('#submitAdd').click(function() {
                    if ($('#nama_controller').val() == '') {
                        $('#nama_controller').addClass('border border-danger');
                        toastr.error("Nama controller masih kosong");
                        return false;
                    }
                    if ($('#fitur').val() == '') {
                        $('#nama_controller').removeClass('border border-danger');
                        $('#fitur').addClass('border border-danger');
                        toastr.error("Nama Fitur masih kosong");
                        return false;
                    }

                    $.ajax({
                        url: base_url + '/insert',
                        type: 'POST',
                        data: {
                            nama_controller: $('#nama_controller').val(),
                            fitur: $('#fitur').val(),
                        },
                        dataType: 'json',
                        success: function(res) {
                            // console.log(res);
                            if (res.kode == 1) {
                                toastr.success('Berhasil Menambahkan Controller Baru');
                                setTimeout(function() {
                                    window.location.replace(base_url);
                                }, 1000);
                            } else {
                                $('#controller').addClass('border border-danger');
                                toastr.error(res.error);
                            }
                        }
                    });
                });

                $('#submitEdit').click(function() {
                    if ($('#nama_controller').val() == '') {
                        $('#nama_controller').addClass('border border-danger');
                        toastr.error("Nama controller masih kosong");
                        return false;
                    }
                    if ($('#fitur').val() == '') {
                        $('#nama_controller').removeClass('border border-danger');
                        $('#fitur').addClass('border border-danger');
                        toastr.error("Nama Fitur masih kosong");
                        return false;
                    }
                    $.ajax({
                        url: base_url + '/update',
                        type: 'POST',
                        data: {
                            id_ctr: $('#id_ctr').val(),
                            nama_controller: $('#nama_controller').val(),
                            fitur: $('#fitur').val(),
                        },
                        dataType: 'json',
                        success: function(res) {
                            // console.log(res);
                            if (res.kode == '1') {
                                toastr.success('Berhasil Mengubah Data Controller');
                                setTimeout(function() {
                                    window.location.replace(base_url);
                                }, 1000);
                            } else {
                                $('#nama_controller').addClass('border border-danger');
                                toastr.error(res.error);
                            }
                        }
                    });
                });
            });
        </script>


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
                            <label for="nama_controller" class="col-md-4 col-form-label">Nama Controller</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" name="nama_controller" id="nama_controller" class="form-control" autofocus>
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
                                <input type="hidden" name="id_ctr" id="id_ctr">
                                <button type="button" id="submitAdd" class="btn btn-primary btn-md">Simpan</button>
                                <button type="button" id="submitEdit" class="btn btn-primary btn-md">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>