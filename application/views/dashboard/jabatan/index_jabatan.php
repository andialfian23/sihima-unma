<a class="btn btn-block btn-lg btn-info mb-2" href="#" data-toggle="modal" data-target="#myModal" id="addJabatan">Tambah Jabatan</a>

<div class="table-responsive">
    <table width="100%" class="table responsive table-bordered table-hover table-sm nowrap" id="dataTables-sihima">
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
            foreach ($jabatans as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['jabatan'] ?></td>
                    <td><?= $row['level'] . ' - ' . $row['role'] ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info" onclick="editJabatan(<?= $row['id_jabatan'] ?>)" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger" onclick="delJabatan(<?= $row['id_jabatan'] ?>,'<?= $row['jabatan'] ?>')">
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_jabatan" class="col-md-4 col-form-label">Nama Jabatan</label>
                    <div class="col-md-8">
                        <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="level" class="col-md-4 col-form-label">Level Jabatan</label>
                    <div class="col-md-8">
                        <select name="level" id="level" class="form-control">
                            <option value="">-- Pilih Role --</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['level'] ?>"><?= $role['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_jabatan" id="id_jabatan">
                <input type="hidden" name="old_nama_jabatan" id="old_nama_jabatan">
                <button type="button" id="submitAdd" class="btn btn-primary btn-md">Simpan</button>
                <button type="button" id="submitEdit" class="btn btn-primary btn-md">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var base_url = "<?= base_url('Admin/jabatan') ?>";

    function editJabatan(id) {
        $('#nama_jabatan').removeClass('border border-danger');
        $('#exampleModalLabel').html('Form Edit Jabatan');
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
                $('#nama_jabatan').val(res.jabatan);
                $('#old_nama_jabatan').val(res.jabatan);
                $('#id_jabatan').val(res.id_jabatan);
                $('#level').val(res.level);
            },
        });
    }

    function delJabatan(id, nama_jabatan) {
        if (confirm('Apakah anda yakin ingin menghapus jabatan ' + nama_jabatan + ' ini ?')) {
            $.ajax({
                url: base_url + "/delete",
                type: 'POST',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(res) {
                    toastr.success('Berhasil Menghapus Data ' + nama_jabatan);
                    setTimeout(function() {
                        window.location.replace(base_url);
                    }, 1000);
                },
            });
        }
    }

    $(function() {
        $('#dataTables-sihima').DataTable();

        $('#addJabatan').click(function() {
            $('#exampleModalLabel').html('Form Tambah Jabatan');
            $('#nama_jabatan').removeClass('border border-danger');
            $('#nama_jabatan').val('');
            $('#level').val('');
            $('#submitAdd').show();
            $('#submitEdit').hide();
        });

        $('#submitAdd').click(function() {
            if ($('#nama_jabatan').val() == '') {
                $('#nama_jabatan').addClass('border border-danger');
                toastr.error("Nama jabatan masih kosong");
                return false;
            }
            if ($('#level').val() == '') {
                $('#nama_jabatan').removeClass('border border-danger');
                $('#level').addClass('border border-danger');
                toastr.error("Level belum dipilih");
                return false;
            }

            $.ajax({
                url: base_url + '/insert',
                type: 'POST',
                data: {
                    nama_jabatan: $('#nama_jabatan').val(),
                    level: $('#level').val(),
                },
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    if (res.kode == 1) {
                        toastr.success('Berhasil Menambahkan Jabatan Baru');
                        setTimeout(function() {
                            window.location.replace(base_url);
                        }, 1000);
                    } else {
                        $('#nama_jabatan').addClass('border border-danger');
                        toastr.error(res.error);
                    }
                }
            });
        });

        $('#submitEdit').click(function() {
            if ($('#nama_jabatan').val() == '') {
                $('#nama_jabatan').addClass('border border-danger');
                toastr.error("Nama jabatan masih kosong");
                return false;
            }
            if ($('#level').val() == '') {
                $('#nama_jabatan').removeClass('border border-danger');
                $('#level').addClass('border border-danger');
                toastr.error("Level belum dipilih");
                return false;
            }

            $.ajax({
                url: base_url + '/update',
                type: 'POST',
                data: {
                    id_jabatan: $('#id_jabatan').val(),
                    nama_jabatan: $('#nama_jabatan').val(),
                    old_nama_jabatan: $('#old_nama_jabatan').val(),
                    level: $('#level').val(),
                },
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    if (res.kode == '1') {
                        toastr.success('Berhasil Mengubah Data Jabatan');
                        setTimeout(function() {
                            window.location.replace(base_url);
                        }, 1000);
                    } else {
                        $('#nama_jabatan').addClass('border border-danger');
                        toastr.error(res.error);
                    }
                }
            });
        });
    });
</script>