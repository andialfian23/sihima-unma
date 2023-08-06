<div class="row">
    <div class="col-md-10">

        <a class="btn btn-block btn-lg btn-info mb-2" href="#" data-toggle="modal" data-target="#myModal" id="addRole">Tambah Role</a>

        <table width="100%" class="table table-bordered table-hover table-sm nowrap" id="dataTables-sihima">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Nama Role</th>
                    <th>--</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $row) { ?>
                    <tr>
                        <td class="text-center"><?= $row['level'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-warning" onclick="viewAkses(<?= $row['level'] ?>)" data-toggle="modal" data-target="#modal-aksesmenu">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-info" onclick="editRole(<?= $row['level'] ?>)" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>

                            <a href="#" class="btn btn-sm btn-danger" onclick="delRole(<?= $row['level'] ?>,'<?= $row['role'] ?>')">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <script type="text/javascript">
            var base_url = "<?= base_url('Admin/role') ?>";
            var base_url2 = "<?= base_url('Admin/menu_akses') ?>";

            function viewAkses(level) {
                var tabel_akses_menu = $('#tabel-menu-akses');
                tabel_akses_menu.DataTable().destroy();
                tabel_akses_menu.find('tbody').empty();
                $.ajax({
                    url: base_url2 + "/get",
                    type: 'POST',
                    data: {
                        level: level,
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#modal-aksesmenu').find('.modal-title').html('Akses Role : [' + res.role['level'] + '] ' + res.role['role']);

                        var tr = [];
                        $.each(res.controller, function(i, row) {
                            tr[i] = `<tr>
                            <td>` + row.nama_controller + `</td>
                            <td>` + row.fitur + `</td>
                            <td class="text-center">
                                    <input class="form-check-input" type="checkbox" onclick="changeAkses(` + res.role['level'] + `,` + row.id_ctr + `)" ` + row.akses_menu + ` />
                               
                            </td>
                            </tr>`;

                        });
                        tabel_akses_menu.find('tbody').append(tr.join(''));

                        tabel_akses_menu.DataTable({
                            lengthMenu: [
                                [5, 10, 25],
                                ['5', '10', '25']
                            ],
                        });
                    },
                });
            }

            function editRole(level) {
                $('#role').removeClass('border border-danger');
                $('#level').removeClass('border border-danger');
                $('#exampleModalLabel').html('Form Edit Role');
                $('#submitAdd').hide();
                $('#submitEdit').show();
                $.ajax({
                    url: base_url + "/get",
                    type: 'POST',
                    data: {
                        level: level,
                    },
                    dataType: 'json',
                    success: function(res) {
                        // console.log(res);
                        $('#role').val(res.role);
                        $('#level').val(res.level);
                        $('#old_level').val(res.level);
                    },
                });
            }

            function delRole(level, role) {
                if (confirm('Apakah anda yakin ingin menghapus data ' + role + ' ini ?')) {
                    $.ajax({
                        url: base_url + "/delete",
                        type: 'POST',
                        data: {
                            level: level,
                        },
                        dataType: 'json',
                        success: function(res) {
                            toastr.success('Berhasil Menghapus Data ' + role);
                            setTimeout(function() {
                                window.location.replace(base_url);
                            }, 1000);
                        },
                    });
                }
            }

            function changeAkses(roleId, menuId) {
                $.ajax({
                    url: base_url2 + "/change",
                    type: 'POST',
                    data: {
                        roleId: roleId,
                        menuId: menuId,
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        if (res.status == '1') {
                            toastr.success("Berhasil Mengaktifkan Akses ke Controller " + res.controller);
                        } else {
                            toastr.success("Berhasil Me-nonaktifkan Akses ke Controller " + res.controller);
                        }
                    },
                });
            }

            $(function() {
                $('#dataTables-sihima').DataTable();

                $('#addRole').click(function() {
                    $('#exampleModalLabel').html('Form Tambah Role');
                    $('#level').removeClass('border border-danger');
                    $('#role').removeClass('border border-danger');
                    $('#level').val('');
                    $('#old_level').val('');
                    $('#role').val('');
                    $('#submitAdd').show();
                    $('#submitEdit').hide();
                });

                $('#submitAdd').click(function() {
                    if ($('#level').val() == '') {
                        $('#level').addClass('border border-danger');
                        toastr.error("Level masih kosong");
                        return false;
                    }
                    if ($('#role').val() == '') {
                        $('#level').removeClass('border border-danger');
                        $('#role').addClass('border border-danger');
                        toastr.error("Nama Role masih kosong");
                        return false;
                    }

                    $.ajax({
                        url: base_url + '/insert',
                        type: 'POST',
                        data: {
                            level: $('#level').val(),
                            role: $('#role').val(),
                        },
                        dataType: 'json',
                        success: function(res) {
                            // console.log(res);
                            if (res.kode == '1') {
                                toastr.success('Berhasil Menambahkan Role Baru');
                                setTimeout(function() {
                                    window.location.replace(base_url);
                                }, 1000);
                            } else {
                                $('#level').addClass('border border-danger');
                                $('#role').removeClass('border border-danger');
                                toastr.error(res.error);
                            }
                        }
                    });
                });

                $('#submitEdit').click(function() {
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

                    $.ajax({
                        url: base_url + '/update',
                        type: 'POST',
                        data: {
                            level: $('#level').val(),
                            old_level: $('#old_level').val(),
                            role: $('#role').val(),
                        },
                        dataType: 'json',
                        success: function(res) {
                            // console.log(res);
                            if (res.kode == '1') {
                                toastr.success('Berhasil Mengubah Data Role');
                                setTimeout(function() {
                                    window.location.replace(base_url);
                                }, 1000);
                            } else {
                                $('#level').addClass('border border-danger');
                                $('#role').removeClass('border border-danger');
                                toastr.error(res.error);
                            }
                        }
                    });
                });
            });
        </script>
    </div>
</div>

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
            </div>
            <div class="modal-footer">
                <input type="hidden" name="old_level" id="old_level">
                <button type="button" class="btn btn-primary btn-md" id="submitAdd">Simpan</button>
                <button type="button" class="btn btn-primary btn-md" id="submitEdit">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-aksesmenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table responsive table-sm table-striped table-bordered" id="tabel-menu-akses">
                    <thead>
                        <tr>
                            <th>Controller</th>
                            <th>Fitur</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>